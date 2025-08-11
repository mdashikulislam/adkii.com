<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Random\RandomException;

class SendOtpController extends Controller
{
    /**
     * @throws RandomException
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            toast('User not found!', 'warning');
        }
        $token = Str::random(64);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => hash('sha256', $token),
                'created_at' => Carbon::now(),
            ]
        );

        $otp = generateOtpCode();
        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(15);
        $user->save();

        $user->notify(new \App\Notifications\SendPasswordResetOtp($otp,$token));

        toast('OTP sent successfully. Check your email!','success');
        return redirect()->route('password.reset', ['token' => $token, 'email' => $user->email]);
    }
}
