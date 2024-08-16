<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Group;
use Request;
use App\Http\Controllers\Controller;
use App\Models\Athlete;
use App\Models\Announcement;
use App\Models\Collection;

class WebController extends Controller
{
    public function home()
    {
        $user = auth()->user();
        $collections = [];
        if (!empty($user) && $user->isUser())
            $collections = Group::collection_group_by_grade(Collection::all());


        return view(
            "web.index",
            [
                "announcements" => Announcement::orderBy("created_at", "desc")->get(),
                "athletes" => Athlete::orderByDesc("grade")->get(),
                "collections" => $collections,
            ]
        );
    }
}
