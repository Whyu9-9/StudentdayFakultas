<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Sarav\Multiauth\Foundation\AuthenticatesAndRegistersUsers;
use Hash;

class AuthController extends Controller
{
    protected $redirectPath = '/beranda-sd';

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    //mengubah username kolom
    protected $username = 'nim';

    public function __construct()
    {
        $this->user = "user";
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    public function getLogin()
    {
        if (view()->exists($this->user().'.authenticate')) {
            return view($this->user().'.authenticate');
        }

        return view($this->user().'.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $this->hasTooManyLoginAttempts($request)) {
            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);
        
        if (Auth::attempt($this->user(), $credentials, $request->has('remember'))) {
            Log::create([
                'mahasiswa_id' => Auth::user()->id,
                'tipe' => 1,
                'konten' => 'Log In'
            ]);

            if(Auth::user()->mahasiswa_baru == 2){
                Auth::logout($this->user());
                return redirect('/login')->withErrors(['nim' => 'Sesi Mahasiswa Lama Belum dimulai']);
            }
            if(Auth::user()->mahasiswa_baru == 1 && Auth::user()->lengkap == 0){
                $date = date("d-m-Y H:i:s");
                $batas = "16-08-2020 16:00:00";
                $depan = "16-08-2020 09:00:00";
                $datebatas = date("d-m-Y H:i:s", strtotime($batas));
                $datedepan = date("d-m-Y H:i:s", strtotime($depan));
                // dd($date,$datebatas);
                // if($date < $datedepan){
                //     Auth::logout($this->user());
                //     return redirect('/login')->withErrors(['nim' => 'Sesi Mahasiswa Lama Belum Dimulai']);
                // }
                if($date > $datebatas){
                    Auth::logout($this->user());
                    return redirect('/login')->withErrors(['nim' => 'Sesi Mahasiswa Baru Telah Selesai']);
                }

            }

            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        if ($redirectUrl = $this->loginPath()) {
            // dd($this->getFailedLoginMessage());
            return redirect($redirectUrl)
                ->withInput($request->only($this->loginUsername(), 'remember'))
                ->withErrors([
                    $this->loginUsername() => $this->getFailedLoginMessage(),
                ]);
        } else {
            // dd($this->getFailedLoginMessage(),'x');
            return back()
                ->withInput($request->only($this->loginUsername(), 'remember'))
                ->withErrors([
                    $this->loginUsername() => $this->getFailedLoginMessage(),
                ]);
        }
    }

    public function getLogout()
    {
        Log::create([
            'mahasiswa_id' => Auth::user()->id,
            'tipe' => 2,
            'konten' => 'Log Out'
        ]);
        Auth::logout($this->user());
        
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
    }
}
