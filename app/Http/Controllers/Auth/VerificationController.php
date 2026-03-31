<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
        $this->middleware('auth')->only('resend');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }


    public function success(Request $request)
    {
        if (!session('verified')) {

            $user = $request->user();

            if ($user) {
                return $user->hasVerifiedEmail()
                    ? redirect('/home')
                    : redirect()->route('verification.notice');
            }

            return redirect('/login');
        }

        return view('auth.verification');
    }

        public function resend(Request $request)
    {
        $user = $request->user();

        if ($request->user()->hasVerifiedEmail()) {
            return $request->wantsJson()
                        ? new JsonResponse([], 204)
                        : redirect($this->redirectPath());
        }

        $request->user()->sendEmailVerificationNotification();
        
        app_log('EMAIL_CONFIRMATION', $user, "Usuário solicitou reenvio de email de confirmação para: {$user->email}");

        return $request->wantsJson()
                    ? new JsonResponse([], 202)
                    : back()->with('resent', true);
    }
    

    protected function verified()
    {
        return redirect()
            ->route('verification.success')
            ->with('verified', true);
    }
}
