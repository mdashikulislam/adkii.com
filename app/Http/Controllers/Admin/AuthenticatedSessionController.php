<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Fortify\Http\Responses\LogoutResponse;

class AuthenticatedSessionController extends Controller
{

    public function destroy(Request $request)
    {

        $request->session()->put('last_role', $request->user()->role);

        auth()->logout();

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        toast('successfully logout!','success');

        return  redirect()->route('adb-login');
    }

}
