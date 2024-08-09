<?php

namespace App\Http\Controllers\Admin;

use App\Models\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CollectionController extends Controller
{
    public function create()
    {
        return view("admin.collections.create");
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', "max:255"],
            'upload' => ['required', "file"],
        ], [
            "name.required" => "名稱不可為空",
            "upload.required" => "必須上傳檔案",
            "name.max" => "名稱不可超過255字",
        ]);

        if ($request->upload && $request->upload->isValid()) {
            $filePath = $request->upload->store('files');
        }
        if (empty($filePath))
            return redirect(route("admin.collections.create"));

        $collection = Collection::create([
            "name" => $request->name,
            "path" => $filePath,
            "author_id" => auth()->user()->id,
        ]);
        return redirect(route("collections.list") . "#collection" . $collection->id);
    }
    public function edit(Request $request, $id)
    {
        return view(
            "admin.collections.create",
            [
                "collection" => Collection::findOrFail($id),
            ]
        );
    }
    public function update(Request $request, $id)
    {
        $collections = Collection::findOrFail($id);
        $request->validate([
            'name' => ['required', "max:255"],
        ], [
            "name.required" => "名稱不可為空",
            "name.max" => "名稱不可超過255字",
        ]);
        $collections->update([
            "name" => $request->name
        ]);

        return redirect(route("collections.list") . "#collections" . $id);
    }
    public function destory(Request $request, $id)
    {
        $collection = Collection::findOrFail($id);
        File::delete(public_path($collection->path));
        $collection->delete();
        return redirect(route("collections.list"));
    }
}
