<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubDb;
use \Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
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
