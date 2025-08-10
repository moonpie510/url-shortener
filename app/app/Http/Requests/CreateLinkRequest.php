<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLinkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'link' => ['required']
        ];
    }

    public function messages(): array
    {
        return [
            'link.required' => 'Link is required'
        ];
    }
}
