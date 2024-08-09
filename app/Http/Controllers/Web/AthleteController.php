<?php

namespace App\Http\Controllers\Web;

use App\Models\Athlete;
use Request;
use App\Http\Controllers\Controller;

class AthleteController extends Controller
{

    public function list()
    {
        return view(
            "web.athletes.list",
            [
                "athletes" => Athlete::where("active",true)->get()
            ]
        );
    }
}
