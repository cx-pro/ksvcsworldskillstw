<?php

namespace Database\Seeders;

use App\Models\AthleteExperience;
use App\Models\Collection;
use App\Models\User;
use App\Models\Athlete;
use App\Models\Announcement;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Athlete::create([
            "id" => "1",
            "name" => "測試選手",
            "description" => "測試描述",
            "avatar" => "/imgs/athletes/example.jpg",
        ]);

        for ($i = 1; $i <= 10; $i++) {
            AthleteExperience::create([
                "name" => "測試競賽" . $i,
                "rank" => "第一名",
                "athlete_id" => "1",
            ]);
        }

        Announcement::create([
            "title" => "測試標題",
            "content" => "測試內文",
            "author_id" => 0
        ]);
        Collection::create([
            "filename" => "測試作品1",
            "path" => "/files/測試作品.html",
            "author" => "系統測試"
        ]);
        Collection::create([
            "filename" => "測試作品2",
            "path" => "/files/測試作品.zip",
            "author" => "系統測試"
        ]);
    }
}
