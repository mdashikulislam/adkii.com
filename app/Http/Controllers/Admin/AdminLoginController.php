<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController as FortifyLogin;


class AdminLoginController extends FortifyLogin
{
    public function create(Request $request): LoginViewResponse
    {

        return new class($request) implements LoginViewResponse {
            public function __construct(protected $request) {}

            public function toResponse($request)
            {
                return view('admin.auth.login');
            }
        };
    }
}
