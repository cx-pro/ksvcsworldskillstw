<?php

namespace Database\Seeders;

use App\Models\AthleteExperience;
use App\Models\Collection;
use App\Models\permission;
use App\Models\Role;
use App\Models\User;
use App\Models\Athlete;
use App\Models\Announcement;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

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
            'role_id' => 2,
        ]);
        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('testadmin1234'),
            'role_id' => 1,
        ]);

        Athlete::create([
            "name" => "測試選手",
            "description" => "測試描述",
            "avatar" => asset("public/examples/athletes/example.jpg"),
            "active" => true,
        ]);

        for ($i = 1; $i <= 10; $i++) {
            AthleteExperience::create([
                "name" => "測試競賽" . $i,
                "rank" => "第一名",
                "athlete_id" => 1,
            ]);
        }

        Announcement::create([
            "title" => "測試標題",
            "content" => "測試內文",
            "author_id" => 2,
            "active" => true,
        ]);
        Collection::create([
            "name" => "測試作品1",
            "path" => asset("public/examples/測試作品.html"),
            "author_id" => 2,
        ]);
        Collection::create([
            "name" => "測試作品2",
            "path" => asset("public/examples/測試作品.zip"),
            "author_id" => 2,
        ]);
        Role::create([
            "name" => "admin",
            "permission_id" => 1
        ]);
        Role::create([
            "name" => "user",
            "permission_id" => 2
        ]);
        permission::create([
            "name" => "_admin",
            "level" => 0
        ]);
        permission::create([
            "name" => "user",
            "level" => 1
        ]);

        foreach (['imgs/athletes','files', 'files/collections'] as $dir) {
            File::deleteDirectory(public_path($dir));
            File::makeDirectory(public_path($dir));
        }
    }
}
