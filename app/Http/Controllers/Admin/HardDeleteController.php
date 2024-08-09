<?php

namespace App\Http\Controllers\Admin;

use App\Models\Announcement;
use App\Models\Athlete;
use App\Models\AthleteExperience;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class HardDeleteController extends Controller
{
    public function list()
    {
        return view("admin.hard_deletes.list");
    }
    public function users()
    {
        User::where("active", 0)->delete();
        return redirect(route("admin.hard_deletes.list"));
    }
    public function athletes()
    {
        $athletes = Athlete::where("active", 0)->get();
        foreach ($athletes as $athlete) {
            AthleteExperience::where("athlete_id", $athlete->id)->delete();
            File::delete(public_path($athlete->avatar));
        }
        Athlete::where("active", 0)->delete();
        return redirect(route("admin.hard_deletes.list"));
    }
    public function announcements()
    {
        $announcements = Announcement::where("active", 0)->get();
        Announcement::where("active", 0)->delete();
        return redirect(route("admin.hard_deletes.list"));
    }
}
