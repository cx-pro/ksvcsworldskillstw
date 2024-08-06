<?php

namespace App\Http\Controllers\Web;

use App\Models\Athlete;
use Request;
use App\Http\Controllers\Controller;

class AthleteController extends Controller
{
    private $request_url;
    public function __construct()
    {
        $this->request_url = Request::url();
    }

    public function list()
    {
        return view(
            "web.athletes.list",
            [
                "request_url" => $this->request_url,
                "athletes" => Athlete::all()
            ]
        );
    }
}
