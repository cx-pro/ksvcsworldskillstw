<?php

namespace App\Http\Controllers\Web;

use Request;
use App\Http\Controllers\Controller;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    private $request_url;
    public function __construct()
    {
        $this->request_url = Request::url();
    }

    public function list()
    {
        return view(
            "web.announcements.list",
            [
                "request_url" => $this->request_url,
                "announcements" => Announcement::all()
            ]
        );
    }
    public function show(Request $request, $id)
    {
        return view(
            "web.announcements.show",
            [
                "request_url" => $this->request_url,
                "announcement_detail" => Announcement::where("id", $id)->first()
            ]
        );
    }
}
