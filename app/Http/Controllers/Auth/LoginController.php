<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;           
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }    

    protected function authenticated(Request $request, $user){
        // Salva a última vez que o usuário logou em uma variável
        $previousLogin = $user->last_login;

        $user->last_login = Carbon::now();
        $user->save();

        session(['previous_login' => $previousLogin]);
        app_log('Login', Auth::user(), "Usuário conectou ao sistema: {$user->name} {$user->surname} #$user->id");

        return redirect()->route('dashboard.index')->with('success_name', Auth::user()->name);

    }

    public function logout(Request $request)
    {
        // 1. Captura o usuário antes de deslogar
        $user = Auth::user();

        if ($user) {
            app_log('Logout', $user, "Logout realizado: {$user->name} {$user->surname} #$user->id");
        }

        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 4. Chama o método que redireciona o usuário
        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect('/');
    }




}
