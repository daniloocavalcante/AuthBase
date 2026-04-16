<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth; 
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;
use App\Http\Requests\RegisterUserRequest;

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


    public function store(RegisterUserRequest $request)
    {
        $user = $this->create($request->validated()); 
        
        event(new Registered($user));
        
        Auth::login($user);

        return redirect($this->redirectPath())->with('success_name', Auth::user()->name);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {       

        $user = User::create([
            'name'       => $data['name'],
            'surname'    => $data['surname'],
            'email'      => $data['email'],
            'birth'      => $data['birth'],
            'gender'     => $data['gender'],
            'password'   => Hash::make($data['password']),
            'last_login' => Carbon::now(),
        ]);
        
        $user->assignRole('user');

        return $user;

    }
}
