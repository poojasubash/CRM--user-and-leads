<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    public function showResetForm($token)
    {
        return view('auth.password.reset', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required',
        ]);

        $response = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });

        return $response == Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', __($response))
                    : back()->withErrors(['email' => [__($response)]]);
    }
}
