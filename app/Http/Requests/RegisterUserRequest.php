<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'surname' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'birth' => ['required', 'date'],
            'gender' => ['required', 'string','max:50', 'in:Masculino,Feminino,Outro'],
            'password' => ['required', 'string', 'min:8', 'max:255','confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            
            // Mensagens genérica =>        required' => 'O campo [:attribute] é obrigatório.',             
            // Mensagens específicas para .required
            'name.required' => 'O campo [nome] é obrigatório.', 
            'surname.required' => 'O campo [sobrenome] é obrigatório.', 
            'email.required' => 'O campo [e-mail] é obrigatório.', 
            'birth.required' => 'O campo [data_de_aniversario] é obrigatório.', 
            'gender.required' => 'O campo [gênero] é obrigatório.', 
            'password.required' => 'O campo [senha] é obrigatório.', 

            // Mensagens específicas para .max
            'name.max' => 'O campo [nome] deve ter no máximo :max caracteres.',
            'surname.max' => 'O campo [sobrenome] deve ter no máximo :max caracteres.',
            'email.max' => 'O campo [e-mail] deve ter no máximo :max caracteres.',
            'password.max' => 'A senha deve ter no máximo :max caracteres.',
            'gender.max' => 'O campo [gênero] deve ter no máximo :max caracteres.',
            
            // Mensagens específicas para .min
            'name.min' => 'O campo [nome] deve ter no mínimo :min caracteres.',
            'surname.min' => 'O campo [sobrenome] deve ter no mínimo :min caracteres.',
            'password.min' => 'A senha deve ter no mínimo :min caracteres.',

             // Mensagens específicas para .unique
            'email.unique' => 'E-mail indisponível no momento.',

             // Mensagens específicas para .confirmed
            'password.confirmed' => 'A confirmação de senha não corresponde.',

             // Mensagens específicas para .date
            'birth.date' => 'O campo [data de nascimento] deve ser uma data válida.',

            // Mensagens específicas para .date
            'email.email' => 'O campo [e-mail] deve ser um e-mail válido.',

        ];
    }

}
