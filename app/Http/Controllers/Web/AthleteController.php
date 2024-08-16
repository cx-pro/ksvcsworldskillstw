<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Group;
use App\Models\Athlete;
use App\Models\Collection;
use Request;
use App\Http\Controllers\Controller;

class AthleteController extends Controller
{

    public function list()
    {
        return view(
            "web.athletes.list",
            [
                "athletes" => Athlete::where("active", true)->orderByDesc("grade")->get()
            ]
        );
    }
    public function show(Request $request, $id)
    {
        return view(
            "web.athletes.show",
            [
                "athlete" => Athlete::findOrFail($id),
                "collections" => Group::collection_group_by_grade(Collection::where("athlete_id", $id)->get())
            ]
        );
    }
}
