<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AnnouncementCategory;

class AnnouncementCategoryController extends Controller
{
    public function list(Request $request)
    {
        return view(
            "admin.announcement_categories.list",
            [
                "categories" => AnnouncementCategory::where("active", true)->get()
            ]
        );
    }
    public function create(Request $request)
    {
        return view("admin.announcement_categories.create");
    }
    public function store(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => ['required', "max:255"],
            'color' => ['required', "max:255"],
        ], [
            "name.required" => "標題不可為空",
            "color.required" => "顏色不可為空",
            "name.max" => "標題不可超過255字",
            "color.max" => "顏色不可超過255字",
        ]);
        $category = AnnouncementCategory::create([
            "name" => $request->name,
            "color" => $request->color,
            "active" => true,
        ]);
        return redirect(route("admin.announcement_categories.list") . "#$category->id");
    }

    public function edit(Request $request, $id)
    {
        return view(
            "admin.announcement_categories.create",
            [
                "category" => AnnouncementCategory::findOrFail($id)
            ]
        );
    }
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $category = AnnouncementCategory::findOrFail($id);
        $request->validate([
            'name' => ['required', "max:255"],
            'color' => ['required', "max:255"],
        ], [
            "name.required" => "標題不可為空",
            "color.required" => "顏色不可為空",
            "name.max" => "標題不可超過255字",
            "color.max" => "顏色不可超過255字",
        ]);
        $category->update([
            "name" => $request->name,
            "color" => $request->color,
            "active" => true,
        ]);

        return redirect(route("admin.announcement_categories.list") . "#$category->id");
    }
    public function destory(Request $request, $id)
    {
        $category = AnnouncementCategory::findOrFail($id);
        $category->update([
            "active" => false
        ]);
        return redirect(route("admin.announcement_categories.list"));
    }
}
