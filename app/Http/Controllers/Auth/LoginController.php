<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    private $request_url;
    public function __construct()
    {
        $this->request_url = Request::url();
    }

    public function login()
    {

        return view(
            "auth.login",
            [
                "request_url" => $this->request_url,
            ]
        );
    }
}
