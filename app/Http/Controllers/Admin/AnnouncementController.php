<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function create(Request $request)
    {
        return view("admin.announcements.create");
    }
    public function store(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'title' => ['required', "max:255"],
            'content' => ['required'],
        ], [
            "title.required" => "標題不可為空",
            "content.required" => "內容不可為空",
            "title.max" => "標題不可超過255字",
        ]);
        $announcement = Announcement::create([
            "title" => $request->title,
            "content" => $request->content,
            "author_id" => $user->id,
            "active" => true,
        ]);
        return redirect(route("announcements.show", ["id" => $announcement->id]));
    }

    public function edit(Request $request, $id)
    {
        return view(
            "admin.announcements.create",
            [
                "announcement" => Announcement::findOrFail($id)
            ]
        );
    }
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $announcement = Announcement::findOrFail($id);
        $request->validate([
            'title' => ['required', "max:255"],
            'content' => ['required'],
        ], [
            "title.required" => "標題不可為空",
            "content.required" => "內容不可為空",
            "title.max" => "標題不可超過255字",
        ]);
        $announcement->update([
            "title" => $request->title,
            "content" => $request->content
        ]);

        return redirect(route("announcements.show", ["id" => $id]));
    }
    public function destory(Request $request, $id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->update([
            "active" => false
        ]);
        return redirect(route("announcements.list"));
    }
}
