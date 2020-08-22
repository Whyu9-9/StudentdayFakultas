<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Log;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/beranda';

    public function showLoginForm()
    {
        return view('studentday.user.login');
    }

    public function username()
    {
        return 'nim';
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            Log::create([
                'mahasiswa_id' => $request->user()->id,
                'keterangan' => 'Login' 
            ]);
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        Log::create([
            'mahasiswa_id' => $request->user()->id,
            'keterangan' => 'Logout ' 
        ]);
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
