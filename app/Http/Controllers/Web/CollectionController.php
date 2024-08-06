<?php

namespace App\Http\Controllers\Web;

use App\Models\Collection;
use Request;
use App\Http\Controllers\Controller;

class CollectionController extends Controller
{
    private $request_url;
    public function __construct()
    {
        $this->request_url = Request::url();
    }

    public function list()
    {

        return view(
            "web.collections.list",
            [
                "request_url" => $this->request_url,
                "collections" => Collection::all()
            ]
        );
    }
}
