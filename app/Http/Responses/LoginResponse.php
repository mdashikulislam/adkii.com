<?php

namespace App\Http\Responses;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        if ($user->role === ADMIN_ROLE) {
            toast('Successfully logged in', 'success');
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }
}
