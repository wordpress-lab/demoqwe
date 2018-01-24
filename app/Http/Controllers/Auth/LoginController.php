<?php

namespace App\Http\Controllers\Auth;

use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//Import Activation Service
use App\Lib\ActivationService;


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
    protected $redirectTo = '/dashboard';

    /**
     * Activation service initiator.
     *
     * @var object
     */
    protected $activationService;

    /**
     * Create a new controller instance.
     */
    public function __construct(ActivationService $activationService)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->activationService = $activationService;
    }

    /**
     * Login process.
     *
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        if($user->activated)
        {

            session(['branch_id' => $user->branch_id]);
        }

            if (!$user->activated)
        {
            $this->activationService->sendActivationMail($user);
            auth()->logout();
            Session::flush();
            Session::regenerate();
            $resendLink = route('resend.activation', $user->email);
            return back()
                ->with('alert.message', 'You need to confirm your account first. We have sent you an activation code, please check your email.')
                ->with('alert.status','danger')
                ->with('alert.resend',$resendLink);
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Log the user out of the application using get method.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {

        $this->guard()->logout();

        Session::flush();

        Session::regenerate();

        return redirect('/');
    }

}
