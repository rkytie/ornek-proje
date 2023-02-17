<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
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
    protected $redirectTo = "/";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $credentials = [
            "email" => $request->email,
            "password" => $request->password
        ];

        $request->validate([
            "email" => "required",
            "password" => "required"
        ], [
            "email.required" => "Lütfen eposta adresinizi gir.",
            "password.required" => "Lütfen parolanızı gir."
        ]);

        $remember_me = isset($request["remember_token"]);

        if (Auth::attempt($credentials, $remember_me)) {
            return redirect("/");
        };

        return back()->withErrors(["errorLogin" => "Kullanıcı adı veya parola yanlış."]);
    }
}
