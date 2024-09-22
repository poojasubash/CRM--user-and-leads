<?php
namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        // Redirect to the 2FA setup page if 2FA is not enabled
        if (!$user->two_factor_secret) {
            return redirect()->intended('/two-factor-setup');
        }


    }
}
