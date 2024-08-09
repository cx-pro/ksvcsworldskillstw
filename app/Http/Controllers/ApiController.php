<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function clearMsg(Request $request)
    {
        Session::remove("message");
        return redirect("/");
    }
    public function setTheme(Request $request)
    {
        Session::put("theme", $request->input('theme','light'));
        return redirect()->back();
    }
}
