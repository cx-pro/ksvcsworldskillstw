<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Group;
use App\Models\Collection;
use Request;
use App\Http\Controllers\Controller;

class CollectionController extends Controller
{
    public function list()
    {

        return view(
            "web.collections.list",
            [
                "collections" => Group::collection_group_by_grade(Collection::whereNotNull("grade")->whereNull("athlete_id")->get())
            ]
        );
    }
}
