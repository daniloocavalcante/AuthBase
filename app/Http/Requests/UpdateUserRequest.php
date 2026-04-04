<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->user()->id;
        return [
            'name' => 'required|string|max:255|min:3',
            'surname' => 'required|string|max:255|min:3',            
            'birth' => 'required|date|before:today',
            'gender' => 'required|max:50|in:Masculino,Feminino,Outro',

        ];
    }

    public function messages(): array
    {
        return [
           
        ];
    }

}
