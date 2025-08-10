<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomResetPasswordController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'otp' => ['required', 'string'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            toast('User not found!', 'warning');
        }

        if (!isset($input['otp']) || $input['otp'] != $user->otp) {
            toast('Invalid OTP', 'error');
        }

        if ($user->otp_expires_at && now()->greaterThan($user->otp_expires_at)) {
            toast('OTP has expired', 'error');
        }

        $record = \Illuminate\Support\Facades\DB::table('password_reset_tokens')
            ->where('email', $user->email)
            ->first();

        if (!$record || !hash_equals($record->token, hash('sha256', $request->token))) {
            toast("This password reset token is invalid.", 'error');
        }

        $user->forceFill([
            'password' => Hash::make($request->password),
            'otp' => null,
            'otp_expires_at' => null,
        ])->save();

        \Illuminate\Support\Facades\DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        toast('Password Reset Successfully', 'success');

        return redirect()->route('adb-login');
    }
}
