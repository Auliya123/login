<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function register()
    {
        $data['title'] = 'Register';
        return view("user/register", $data);
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:user',
            'password' => [
                'required',
                'string',
                'confirmed', Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
            'password_confirmation' => 'required|same:password',
        ]);
        $user = new User([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        $user->save();
        return redirect()->route('login')->with('success', 'Registration Successful. Please Login!');
    }


    public function login()
    {
        $data['title'] = 'Login';
        return view("user/login", $data);
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        } else {
            return back()->withErrors('password', 'Wrong Username or Password!');
        }
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img('math')]);
    }

    public function password()
    {
        $data['title'] = 'Reset Password';
        return view("user/password", $data);
    }

    public function password_action(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => [
                'required',
                'string',
                'confirmed', Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()
            ],
        ]);
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        $user->save();
        $request->session()->regenerate();
        return back()->with('success', 'Password changed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/");
    }
}