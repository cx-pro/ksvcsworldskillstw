<?php

namespace App\Http\Controllers\Web;

use Request;
use App\Http\Controllers\Controller;
use App\Models\Announcement;

class AnnouncementController extends Controller
{

    public function list()
    {
        return view(
            "web.announcements.list",
            [
                "announcements" => Announcement::where("active", true)->get()
            ]
        );
    }
    public function show(Request $request, $id)
    {

        $announcement = Announcement::findOrFail($id);
        if (!$announcement->active)
            return redirect(route("web.announcements.list"), 404);
        return view(
            "web.announcements.show",
            [
                "announcement_detail" => Announcement::where("id", $id)->first()
            ]
        );
    }
}
