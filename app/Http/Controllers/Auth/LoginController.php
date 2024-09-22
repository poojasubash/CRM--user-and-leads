<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use PragmaRX\Google2FA\Google2FA;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();


            Auth::logout();

            session(['2fa:user:id' => $user->id]);
            return redirect()->route('login.verify.otp');
        }

        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function verifyOtp(Request $request)
        {
        $request->validate([
            'otp' => 'required|string',
        ]);

        $user = User::find(session('2fa:user:id'));

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not authenticated.');
        }

        $google2fa = new Google2FA();

        $secret = Crypt::decryptString($user->two_factor_secret);
        $valid = $google2fa->verifyKey($secret, $request->otp);

        if ($valid) {

            //$user->two_factor_confirmed_at = now();
            $user->save();
            Auth::login($user);

            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->withErrors(['otp' => 'The OTP you entered is invalid.']);
        }
    }
}
