<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Facades\Crypt;

class User extends Authenticatable
{
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'two_factor_secret',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function createTwoFactorAuth()
    {
        if ($this->two_factor_secret) {
            return;
        }

        $google2fa = new Google2FA();
        $secret = $google2fa->generateSecretKey();

        try {
            $this->update([
                'two_factor_secret' => Crypt::encryptString($secret),
            ]);
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            throw new \Exception('Error encrypting the two-factor secret: ' . $e->getMessage());
        }
    }

    public function twoFactorQrCodeUrl()
    {
        $google2fa = new Google2FA();

        try {
            $secret = Crypt::decryptString($this->two_factor_secret);
        } catch (\Exception $e) {
            // Log the error or handle it as needed
            throw new \Exception('Error decrypting the two-factor secret: ' . $e->getMessage());
        }

        return $google2fa->getQRCodeUrl(
            config('app.name'),
            $this->email,
            $secret
        );
    }

    public function hasTwoFactorEnabled()
    {
        return !is_null($this->two_factor_secret);
    }

    public function enableTwoFactorAuthentication()
    {
        if (!$this->hasTwoFactorEnabled()) {
            $this->createTwoFactorAuth();
        }
    }
}
