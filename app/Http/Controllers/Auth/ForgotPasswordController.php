<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use ResetsPasswords;

    public function showLinkRequestForm()
    {
        return view('auth.password.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $response = Password::sendResetLink($request->only('email'));

        return $response == Password::RESET_LINK_SENT
                    ? back()->with('status', __($response))
                    : back()->withErrors(['email' => __($response)]);
    }
}
