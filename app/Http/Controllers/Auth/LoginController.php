<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LoginViewResponse;

class LoginController extends Controller
{
    public function login(Request $request): LoginViewResponse
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
