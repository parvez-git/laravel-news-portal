<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    }


    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $guser = Socialite::driver('google')->user();

        $existuser = User::where('email',$guser->getEmail())->first();

        if ($existuser) {

            Auth::login($existuser);

            return redirect()->route('dashboard');

        } else {

            $user = User::create([
                'name'      => $guser->getName(),
                'email'     => $guser->getEmail(),
                'password'  => Hash::make('123456'),
                'role_id'   => 3,
                'status'    => 1
            ]);

            Auth::login($user);

            return redirect()->route('dashboard');
        }
    }
}
