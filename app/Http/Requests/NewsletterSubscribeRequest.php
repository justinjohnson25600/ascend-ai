<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Http\Requests\Concerns\DetectsHoneypot;
use Illuminate\Foundation\Http\FormRequest;

final class NewsletterSubscribeRequest extends FormRequest
{
    use DetectsHoneypot;

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'max:255'],
        ];
    }
}
