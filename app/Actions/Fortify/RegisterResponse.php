<?php
namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    public function toResponse($request)
    {
        // Redirect to the 2FA setup page
        return redirect()->intended('/two-factor-challenge');
    }
}
