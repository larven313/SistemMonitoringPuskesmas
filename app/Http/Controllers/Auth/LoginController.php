<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


    protected $redirectTo;
    // protected $redirectTo = RouteServiceProvider::INDEX;

    public function redirectTo()
    {
        switch (Auth::user()->roles) {
            case '["ADMIN"]':
                $this->redirectTo = '/dashboard';
                return $this->redirectTo;
                break;
            case '["USER"]':
                $this->redirectTo = '/';
                break;

            default:
                $this->redirectTo = '/login';
                return $this->redirectTo;
                break;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // protected function credentials(Request $request)
    // {
    //     // return $request->only($this->username(), 'password');

    //     // cek juga status nya ACTIVE/INACTIVE

    //     return ['email' => $request->{$this->username()}, 'password' => $request->password, 'status' => 'ACTIVE'];
    // }

    // protected function authenticated(Request $request, $user)
    // {
    //     return response(['email' => $request->{$this->username()}, 'password' => $request->password, 'status' => 'ACTIVE']);
    // }
}
