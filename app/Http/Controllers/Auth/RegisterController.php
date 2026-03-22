<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */


    protected function validator(array $data)
    {
        // As regras de validação
        $rules = [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'surname' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'birth' => ['required', 'date'],
            'gender' => ['required', 'string','max:50'],
            'password' => ['required', 'string', 'min:8', 'max:255','confirmed'],
        ];

        // As mensagens de erro personalizadas
        $messages = [

            // Mensagens genérica =>        required' => 'O campo [:attribute] é obrigatório.',             
            // Mensagens específicas para .required
            'name' => 'O campo [nome] é obrigatório.', 
            'surname' => 'O campo [sobrenome] é obrigatório.', 
            'email' => 'O campo [e-mail] é obrigatório.', 
            'birth' => 'O campo [data_de_aniversario] é obrigatório.', 
            'gender' => 'O campo [gênero] é obrigatório.', 
            'password' => 'O campo [senha] é obrigatório.', 

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

        // Retorna o validador com as regras e as mensagens
        return Validator::make($data, $rules, $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        switch ($data['gender']) {
            case '1':
                $data['gender'] = "Masculino";
                break;

            case '2':
                $data['gender'] = "Feminino";
                break;
            
            default:
                $data['gender'] = "Não Informar";
                break;
        }

        return User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'birth' => $data['birth'],
            'gender' => $data['gender'],
            'password' => Hash::make($data['password']),
            'last_login' => Carbon::now(),
        ]);
    }
}
