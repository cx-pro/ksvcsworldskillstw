<?php

namespace App\Http\Controllers\Admin;

use App\Models\Collection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

function str_replace_once($search, $replace, $subject)
{
    return implode($replace, explode($search, $subject, 2));
}

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
            'athlete' => ["required"],
            'grade' => ['required_if_declined:athlete', "max:255"],
            "quiz" => ["required", "file"],
            'upload' => ['required', "file", "extensions:zip"],
            'sql_upload' => ["file", "extensions:sql"],
        ], [
            "name.required" => "名稱不可為空",
            "upload.required" => "必須上傳檔案",
            "quiz.required" => "必須上傳檔案",
            "grade.required_if_declined" => "未選擇選手時，屆數不可為空",
            "athlete.required" => "此欄位必須選擇",
            "name.max" => "名稱不可超過255字",
            "grade.max" => "屆數不可超過255字",
            'upload.file' => "檔案格式錯誤",
            'sql_upload.file' => "檔案格式錯誤",
            'sql_upload.mimes' => "檔案格式錯誤",
            'upload.mimes' => "檔案格式錯誤",
        ]);
        $db_index = max(array_merge(Collection::all()->pluck("id")->toArray(), [0]));
        $location = base_path("storage/app/public/sub/{$request->name}_$db_index");
        $public_location = base_path("public/sub/{$request->name}_$db_index");
        $relative_location = "/public/sub/{$request->name}_$db_index";

        if ($request->quiz && $request->quiz->isValid()) {
            $qrp = "$relative_location/file/{$request->name}.{$request->quiz->extension()}";
            $quizPath = $request->quiz->storeAs($qrp);
        }

        if ($request->upload && $request->upload->isValid()) {
            $frp = "$relative_location/file/{$request->name}.zip";
            $filePath = $request->upload->storeAs($frp);
        }

        if ($request->sql_upload && $request->sql_upload->isValid()) {
            $srp = "$relative_location/file/{$request->name}.sql";
            $sqlPath = $request->sql_upload->storeAs($srp);
        }

        if (empty($filePath) || empty($quizPath))
            return redirect(route("admin.collections.create"));

        $is_laravel = $request->boolean("is_laravel");
        $use_sql = !empty($sqlPath);
        if ($use_sql)
            [$new_name, $old_name] = $this->sql_process("$location/file/{$request->name}.sql", $db_index);
        $this->web_process("$location/file/{$request->name}.zip", $public_location);
        $collection = Collection::create([
            "name" => $request->name,
            "grade" => $request->athlete != "no" ? null : $request->grade,
            "quiz" => $quizPath,
            "file" => $filePath,
            "sql" => $sqlPath,
            "project_name" => "{$request->name}_$db_index",
            "location" => "$relative_location/web/" . ($is_laravel ? "public" : ""),
            "path" => $location,
            "public_path" => $public_location,
            "db_name" => $use_sql ? $new_name : null,
            "author_id" => auth()->user()->id,
            "athlete_id" => $request->athlete != "no" ? $request->athlete : null,
        ]);
        if ($is_laravel)
            $this->env_process("$public_location/web/.env", $db_index);
        elseif ($use_sql)
            $this->project_process("$public_location/web", $old_name, $new_name);

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
        $collection = Collection::findOrFail($id);
        $request->validate([
            'name' => ['required', "max:255"],
            'athlete' => ["required"],
            'grade' => ['required_if_declined:athlete', "max:255"],
        ], [
            "name.required" => "名稱不可為空",
            "name.max" => "名稱不可超過255字",
            "athlete.required" => "此欄位必須選擇",
            "grade.required_if_declined" => "未選擇選手時，屆數不可為空",
            "grade.max" => "屆數不可超過255字",
        ]);
        $new_name = "{$request->name}_" . Collection::where("name", $request->name)->count();
        $new_location = str_replace_once("public/sub/$collection->project_name", "public/sub/$new_name", $collection->location);
        $new_path = str_replace_once("public/sub/$collection->project_name", "public/sub/$new_name", $collection->path);
        $new_public_path = str_replace_once("public/sub/$collection->project_name", "public/sub/$new_name", $collection->public_path);
        $new_relative_path = "/" . substr($new_path, strpos($new_path, "public/sub/"));
        rename($collection->public_path, $new_public_path);
        rename($collection->path, $new_path);
        $quiz_ext = pathinfo($collection->quiz)["extension"];
        rename("$new_path/file/$collection->name.$quiz_ext", "$new_path/file/{$request->name}.$quiz_ext");
        rename("$new_path/file/$collection->name.zip", "$new_path/file/{$request->name}.zip");
        rename("$new_path/file/$collection->name.sql", "$new_path/file/{$request->name}.sql");

        $collection->update([
            "name" => $request->name,
            "grade" => $request->athlete != "no" ? null : $request->grade,
            "quiz" => "$new_relative_path/file/$request->name.$quiz_ext",
            "file" => "$new_relative_path/file/$request->name.zip",
            "sql" => "$new_relative_path/file/$request->name.sql",
            "project_name" => $new_name,
            "location" => $new_location,
            "path" => $new_public_path,
            "public_path" => $new_path,
            "athlete_id" => $request->athlete != "no" ? $request->athlete : null
        ]);
        return redirect(route("collections.list") . "#collections" . $id);
    }
    public function destory(Request $request, $id)
    {
        $collection = Collection::findOrFail($id);
        File::deleteDirectory($collection->path);
        File::deleteDirectory($collection->public_path);
        DB::statement("DROP DATABASE `{$collection->db_name}`");
        $collection->delete();
        return redirect(route("collections.list"));
    }
    private function env_process($env_fp, $db_index, $prefix = "kwst_")
    {
        $sub_env = File::get($env_fp);
        $env_target = "DB_DATABASE";
        if (str_contains($sub_env, $env_target)) {
            $db_start = strpos($sub_env, $env_target) + 12;
            $db_name = substr($sub_env, $db_start, strpos($sub_env, "\n", $db_start) - $db_start);
            File::put($env_fp, str_replace($db_name, (str_starts_with($db_name, $prefix) ? $db_name : $prefix . $db_name) . "_$db_index", $sub_env), true);
        }
    }
    private function sql_process($sql_fp, $db_index, $prefix = "kwst_")
    {
        $sub_sql = File::get($sql_fp);
        $sql_target = "CREATE DATABASE IF NOT EXISTS `";
        if (str_contains($sub_sql, $sql_target) && str_contains($sub_sql, "USE")) {
            $name_start = strpos($sub_sql, $sql_target) + strlen($sql_target);
            $sql_name = substr($sub_sql, $name_start, strpos($sub_sql, "` DEFAULT", $name_start) - $name_start);
            $new_sql_name = (str_starts_with($sql_name, $prefix) ? $sql_name : $prefix . $sql_name) . "_$db_index";
            $new_sql = str_replace($sql_name, $new_sql_name, $sub_sql);

            if (!str_starts_with($sql_name, $prefix))
                File::put($sql_fp, $new_sql, true);

            $origin_db_name = env("DB_DATABASE");
            if (!$origin_db_name) {
                $origin_env = File::get(base_path() . "/.env");
                $origin_name_start = strpos($origin_env, "DB_DATABASE") + 12;
                $origin_db_name = substr($origin_env, $origin_name_start, strpos($origin_env, "\n", $origin_name_start) - $origin_name_start);
            }
            DB::unprepared("DROP DATABASE IF EXISTS `$sql_name`;DROP DATABASE IF EXISTS `$new_sql_name`");
            DB::unprepared($new_sql);
            DB::unprepared("USE `$origin_db_name`");

        }
        return [$new_sql_name, $sql_name];
    }
    private function project_process($location, $old_name, $new_name, $prefix = "kwst_")
    {
        if (str_starts_with($old_name, $prefix))
            return;
        foreach (new \RecursiveTreeIterator(new \RecursiveDirectoryIterator($location, \RecursiveDirectoryIterator::SKIP_DOTS)) as $file => $tree) {
            if (!is_file($file))
                continue;
            $f = File::get($file);
            foreach (["'$old_name'", "\"$old_name\""] as $search)
                if (str_contains($f, $search))
                    File::put($file, str_replace($search, str_replace($old_name, $new_name, $search), $f), true);
        }
    }
    private function web_process($fp, $location)
    {
        $zip = new \ZipArchive();
        if ($zip->open($fp) === true)
            $zip->extractTo("$location/web");
        return $location;
    }
}
