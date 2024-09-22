<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorController extends Controller
{
    public function showSetupForm()
    {
        $user = Auth::user();
        $google2fa = new Google2FA();
        $secret = $google2fa->generateSecretKey();
        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $secret
        );

        return view('auth.two-factor-setup', [
            'qrCodeUrl' => $qrCodeUrl,
            'secret' => $secret,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $user = Auth::user();
        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey($user->two_factor_secret, $request->input('code'));

        if ($valid) {
            // Enable 2FA for the user
            $user->update([
                'two_factor_secret' => encrypt($request->input('secret')),
                'two_factor_enabled' => true,
            ]);

            return redirect()->route('dashboard')->with('status', 'Two-factor authentication enabled.');
        }

        return redirect()->back()->withErrors(['code' => 'The provided code is invalid.']);
    }
}
