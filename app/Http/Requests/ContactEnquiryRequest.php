<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Http\Requests\Concerns\DetectsHoneypot;
use Illuminate\Foundation\Http\FormRequest;

final class ContactEnquiryRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'organisation' => ['nullable', 'string', 'max:255'],
            'enquiry_type' => ['required', 'in:investment,partnership,advisory,general'],
            'message' => ['required', 'string', 'min:50', 'max:5000'],
        ];
    }
}
