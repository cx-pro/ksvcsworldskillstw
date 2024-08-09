<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function login()
    {
        return view("auth.login");
    }
    public function logout()
    {
        return view("auth.logout");
    }
    public function register()
    {
        return view("auth.register");
    }
    public function forgot_password()
    {
        return view("auth.forgot_password");
    }
}
