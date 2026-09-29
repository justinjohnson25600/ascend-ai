<?php

declare(strict_types=1);

use App\Mail\ContactFormMail;
use App\Mail\EnquiryReceivedMail;
use App\Models\Contact;
use App\Services\Assistant\AssistantModel;
use App\Services\Assistant\ModelReply;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

/**
 * Scripted stand-in for Claude: returns queued replies and records every request it was sent.
 */
final class ScriptedAssistantModel implements AssistantModel
{
    /** @var list<list<array<string, mixed>>> */
    public array $requests = [];

    /** @param list<ModelReply|Throwable> $replies */
    public function __construct(private array $replies) {}

    public function reply(array $messages): ModelReply
    {
        $this->requests[] = $messages;
        $next = array_shift($this->replies) ?? new ModelReply('end_turn', 'No more scripted replies.', [], []);

        if ($next instanceof Throwable) {
            throw $next;
        }

        return $next;
    }
}

function scriptAssistant(array $replies): ScriptedAssistantModel
{
    $model = new ScriptedAssistantModel($replies);
    app()->instance(AssistantModel::class, $model);

    return $model;
}

function textReply(string $text): ModelReply
{
    return new ModelReply('end_turn', $text, [], [['type' => 'text', 'text' => $text]]);
}

function handOff(array $input): ModelReply
{
    $call = ['id' => 'toolu_1', 'name' => 'pass_to_justin', 'input' => $input];

    return new ModelReply('tool_use', 'Passing that on now.', [$call], [
        ['type' => 'text', 'text' => 'Passing that on now.'],
        ['type' => 'tool_use', 'id' => 'toolu_1', 'name' => 'pass_to_justin', 'input' => $input],
    ]);
}

function validLead(array $overrides = []): array
{
    return array_merge([
        'name' => 'Sam Taylor',
        'email' => 'sam@example.com',
        'business' => 'Taylor Plumbing',
        'enquiry_type' => 'audit',
        'summary' => 'Two-person plumbing firm drowning in quote chasing; wants the free audit.',
    ], $overrides);
}

beforeEach(function () {
    config(['services.anthropic.key' => 'test-key', 'ascend.assistant.enabled' => true, 'ascend.assistant.daily_limit' => 300]);
    Mail::fake();
    Cache::flush();
});

test('the assistant is hidden until an AI provider key is set', function () {
    config(['services.anthropic.key' => null]);

    $this->get('/')->assertOk()->assertDontSee('Ask a question');
    $this->postJson('/assistant/messages', ['message' => 'Hello'])->assertNotFound();
});

test('the assistant button appears on every page once configured', function (string $path) {
    $this->get($path)->assertOk()->assertSee('Ask a question')->assertSee('An example of what we build');
})->with(['/', '/solutions', '/contact']);

test('a question gets an answer and the conversation is remembered for the visit', function () {
    $model = scriptAssistant([textReply('We automate enquiries, quotes, diaries and more.'), textReply('Yes, anywhere in the UK.')]);

    $this->postJson('/assistant/messages', ['message' => 'What do you automate?'])
        ->assertOk()->assertJson(['reply' => 'We automate enquiries, quotes, diaries and more.']);

    $this->postJson('/assistant/messages', ['message' => 'Do you work outside Essex?'])
        ->assertOk()->assertJson(['reply' => 'Yes, anywhere in the UK.']);

    expect($model->requests[1])->toBe([
        ['role' => 'user', 'content' => 'What do you automate?'],
        ['role' => 'assistant', 'content' => 'We automate enquiries, quotes, diaries and more.'],
        ['role' => 'user', 'content' => 'Do you work outside Essex?'],
    ]);

    $this->getJson('/assistant/history')->assertOk()->assertJsonCount(4, 'messages');
});

test('a visitor who wants a person is passed to Justin like a contact form enquiry', function () {
    $model = scriptAssistant([handOff(validLead()), textReply('Done. Justin will reply within one working day, and a confirmation is on its way to your inbox.')]);

    $this->postJson('/assistant/messages', ['message' => "I'm Sam, sam@example.com, please book the audit"])
        ->assertOk()->assertJson(['reply' => 'Done. Justin will reply within one working day, and a confirmation is on its way to your inbox.']);

    $contact = Contact::sole();
    expect($contact->email)->toBe('sam@example.com')
        ->and($contact->enquiry_type)->toBe('audit')
        ->and($contact->organisation)->toBe('Taylor Plumbing')
        ->and($contact->message)->toStartWith('Via the website assistant:');

    Mail::assertSent(ContactFormMail::class);
    Mail::assertSent(EnquiryReceivedMail::class, fn ($mail) => $mail->hasTo('sam@example.com'));

    $toolResult = $model->requests[1][2]['content'][0];
    expect($toolResult['type'])->toBe('tool_result')
        ->and($toolResult['toolUseID'])->toBe('toolu_1')
        ->and($toolResult['isError'])->toBeFalse();
});

test('details that do not check out are sent back to the assistant instead of stored', function (array $lead) {
    $model = scriptAssistant([handOff($lead), textReply('Could you check that email address?')]);

    $this->postJson('/assistant/messages', ['message' => 'Book me in'])->assertOk();

    expect(Contact::count())->toBe(0)
        ->and($model->requests[1][2]['content'][0]['isError'])->toBeTrue();
    Mail::assertNothingSent();
})->with([
    'bad email' => [validLead(['email' => 'not-an-email'])],
    'no name' => [validLead(['name' => ''])],
    'unknown type' => [validLead(['enquiry_type' => 'investment'])],
]);

test('one chat can pass details on at most twice', function () {
    scriptAssistant([
        handOff(validLead(['email' => 'a@example.com'])), textReply('Done.'),
        handOff(validLead(['email' => 'b@example.com'])), textReply('Done.'),
        handOff(validLead(['email' => 'c@example.com'])), textReply('I have already passed your details on.'),
    ]);

    foreach (range(1, 3) as $i) {
        $this->postJson('/assistant/messages', ['message' => "Contact me, attempt {$i}"])->assertOk();
    }

    expect(Contact::count())->toBe(2);
});

test('if the AI service fails the visitor is pointed to the contact form', function () {
    scriptAssistant([new RuntimeException('overloaded')]);

    $this->postJson('/assistant/messages', ['message' => 'Hello'])
        ->assertOk()
        ->assertJson(['reply' => "Sorry, I can't answer right now. You can use the contact form or email contact@ascend-ai.co.uk."]);
});

test('a declined request gets a polite redirect', function () {
    scriptAssistant([new ModelReply('refusal', '', [], [])]);

    $this->postJson('/assistant/messages', ['message' => 'Something off-topic'])
        ->assertOk()
        ->assertJson(['reply' => "Sorry, I can't help with that one. If it's about your business, Justin can answer through the contact form."]);
});

test('messages must be present and reasonably short', function (mixed $message) {
    scriptAssistant([]);

    $this->postJson('/assistant/messages', ['message' => $message])->assertUnprocessable();
})->with(['', str_repeat('x', 801)]);

test('once the daily limit is reached the assistant stops calling the AI service', function () {
    config(['ascend.assistant.daily_limit' => 1]);
    $model = scriptAssistant([textReply('First answer.')]);

    $this->postJson('/assistant/messages', ['message' => 'One'])->assertJson(['reply' => 'First answer.']);
    $this->postJson('/assistant/messages', ['message' => 'Two'])
        ->assertJson(['reply' => "Sorry, I can't answer right now. You can use the contact form or email contact@ascend-ai.co.uk."]);

    expect($model->requests)->toHaveCount(1);
});

test('a long conversation is steered to the audit rather than running on', function () {
    $model = scriptAssistant([]);
    session(['assistant.history' => array_fill(0, 40, ['role' => 'user', 'content' => 'x'])]);

    $this->postJson('/assistant/messages', ['message' => 'And another thing'])
        ->assertOk()->assertJsonFragment(['limit' => true]);

    expect($model->requests)->toBeEmpty();
});

test('start again clears the conversation', function () {
    scriptAssistant([textReply('Hello.')]);
    $this->postJson('/assistant/messages', ['message' => 'Hi'])->assertOk();

    $this->postJson('/assistant/reset')->assertOk();

    $this->getJson('/assistant/history')->assertJsonCount(0, 'messages');
});

test('the assistant is rate limited per visitor', function () {
    scriptAssistant(array_fill(0, 25, textReply('Answer.')));

    foreach (range(1, 20) as $i) {
        $this->postJson('/assistant/messages', ['message' => "Question {$i}"])->assertOk();
    }

    $this->postJson('/assistant/messages', ['message' => 'One more'])->assertStatus(429);
});

test('the briefing keeps the assistant to the website and away from invented figures', function () {
    $prompt = file_get_contents(resource_path('assistant/system-prompt.md'));

    expect($prompt)
        ->toContain('Use only the information between the <website> tags')
        ->toContain('Never invent prices')
        ->toContain('pass_to_justin')
        ->toContain('Matrix House');
});
