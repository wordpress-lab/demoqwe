<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//Import Activation Service
use App\Lib\ActivationService;


class ActivationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Activation Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

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
        $this->activationService = $activationService;
    }

    /**
     * Activate User.
     */

    public function activateUser($token)
    {
        if ($user = $this->activationService->activateUser($token))
        {
            auth()->login($user);

            return redirect($this->redirectPath());
        }
        
        abort(404);
    }

    /**
     * User registration with email activation feature.
     */
    public function resendActivation($email)
    {
        $user = User::where('email', $email)->first();

        $this->activationService->reSendActivationMail($user);

        return redirect('/login')
            ->with('alert.message', 'We sent you an activation code. Check your email.')
            ->with('alert.status', 'success');
    }
}
