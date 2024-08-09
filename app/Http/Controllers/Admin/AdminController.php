<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function home()
    {
        return view("admin.index");
    }
    public function hard_delete()
    {
        return view("admin.hard_deletes.list");
    }
}
