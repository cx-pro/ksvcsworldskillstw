<?php

namespace App\Http\Controllers\Web;

use Request;
use App\Http\Controllers\Controller;
use App\Models\Athlete;
use App\Models\Announcement;
use App\Models\Collection;

class WebController extends Controller
{
    private $request_url;
    public function __construct()
    {
        $this->request_url = Request::url();
    }
    public function home()
    {
        return view(
            "web.index",
            [
                "request_url" => $this->request_url,
                "announcements" => Announcement::orderBy("created_at", "desc")->limit(5)->get(),
                "athletes" => Athlete::orderBy("id", "desc")->limit(3)->get(),
                "collections" => Collection::orderBy("created_at", "desc")->limit(3)->get()
            ]
        );
    }
}
