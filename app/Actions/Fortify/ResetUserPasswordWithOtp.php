<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;


class ResetUserPasswordWithOtp implements ResetsUserPasswords
{

    public function reset($user, array $input)
    {
        Validator::make($input, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'otp' => ['required', 'string'],
        ])->validate();

        if (!isset($input['otp']) || $input['otp'] != $user->otp) {
            toast('Invalid OTP', 'error');
        }

        if ($user->otp_expires_at && now()->greaterThan($user->otp_expires_at)) {
            toast('OTP has expired', 'error');
        }

        $record = DB::table('password_reset_tokens')
            ->where('email', $user->email)
            ->first();

        if (!$record || !hash_equals($record->token, hash('sha256', $input['token']))) {
            toast("This password reset token is invalid.", 'error');
        }

        $user->forceFill([
            'password' => Hash::make($input['password']),
            'otp' => null,
            'otp_expires_at' => null,
        ])->save();

        DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        toast('Password Reset Successfully', 'success');
    }
}
