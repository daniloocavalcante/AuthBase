<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmailRequest extends FormRequest
{
    public function authorize(): bool
    {
        // permite apenas usuários logados
        return true;
    }

    public function rules(): array
    {
        $userId = $this->user()->id;

        return [
            'email' => [
                'required',
                'email',
                'max:255',
                'confirmed', // precisa digitar email_confirmation
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'password' => ['required', 'current_password'], // garante identidade
        ];
    }
}