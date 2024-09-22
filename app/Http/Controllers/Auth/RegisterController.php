<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;



class RegisterController extends Controller
{

    public function create()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:15',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        session(['2fa:user:id' => $user->id]);
        return redirect()->route('register.2fa');
    }
    public function showTwoFactorSetup(Request $request)
    {

        // $session = Session::get('2fa:user:id');
        // dd($session);

        $user_id = Session::get('2fa:user:id');
        $user = User::where('id',$user_id)->first();
        // Redirect to login if user is not authenticated
       /*  if (!$user) {
            return redirect()->route('login')->with('error', 'User not authenticated.');
        }*/

        // Generate 2FA secret if not already generated
        if (!$user->two_factor_secret) {
            $user->createTwoFactorAuth();
        }

        // Generate QR code
        $qrCode = $user->twoFactorQrCodeSvg();
        $secret = decrypt($user->two_factor_secret, false);
        // dd($qrCode);

        return view('auth.two-factor-register', compact('qrCode', 'secret'));
    }

    public function completeRegistration(Request $request)
    {
        $userId =  Session::get('2fa:user:id');
        //dd($user);
        //Auth::logout();
        //session(['2fa:user:id' => $user->id]);
        $user = User::find($userId);

       /* if (!$user) {
           return redirect()->route('login')->with('error', 'User not authenticated.');
        }*/

        if (!$user->hasTwoFactorEnabled()) {
           $user->enableTwoFactorAuthentication();
           return view('auth.two-factor-register', compact('qrCode', 'secret'));

       }

        return redirect()->route('login.verify.otp');
        }

}

