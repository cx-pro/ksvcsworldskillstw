<?php

namespace App\Http\Controllers\Web;

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
                "collections" => Collection::all()
            ]
        );
    }
}
