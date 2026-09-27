<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\EnquiryType;
use App\Http\Requests\Concerns\DetectsHoneypot;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class ContactEnquiryRequest extends FormRequest
{
    use DetectsHoneypot;

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'organisation' => ['nullable', 'string', 'max:255'],
            'enquiry_type' => ['required', Rule::enum(EnquiryType::class)],
            'message' => ['required', 'string', 'min:20', 'max:5000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'message.min' => 'Tell us a little more, at least 20 characters.',
            'enquiry_type.required' => 'Choose what we can help with.',
        ];
    }
}
