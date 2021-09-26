<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() // route pages.login.show
    {
        if (auth('web')->check()) return redirect()->route('pages.modules');

        return view('pages.auth.index');
    }

    public function check(Request $request) // route pages.auth.login.check
    {
        //$data = $request->only(['login', 'password', 'remember']);

        // $validate = $request->validate([
        //     'login' => ['required', 'string'],
        //     'password' => ['required'],
        // ]);

        $login = $request->input('login');
        $password = $request->input('password');
        $remember = $request->boolean('remember');
        //$file = $request->file('photo');

        $user = User::whereRaw("(name='$login' OR email='$login') AND active=1")->first();

        if (!empty($user) && Hash::check($password, $user->password)) {
            if (Auth::guard('web')->attempt(['email' => $login, 'password' => $password], $remember)) {
                return redirect()->route('pages.modules');
            }
        }

        session(['alert' => __('Ошибка авторизации')]);
        return redirect()->back()->withInput(); //->withErrors(['login'=>'Пользователь не найден']);
    }

    public function logout()
    {
        auth('web')->logout();
        return redirect()->route('pages.home');
    }
}