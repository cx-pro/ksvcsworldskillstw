<?php

namespace App\Http\Controllers\Admin;

use App\Models\Athlete;
use App\Models\AthleteExperience;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AthleteController extends Controller
{

    public function create(Request $request)
    {
        $view_data = [
            "athletes" => Athlete::all()
        ];

        $old_exp = old("experience");
        if (!empty($old_exp)) {
            $view_data["experience"] = json_decode($old_exp, true);
        }
        return view(
            "admin.athletes.create",
            $view_data
        );
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', "max:255"],
            'cls' => ['required', "max:255"],
            'grade' => ['required', "max:255"],
            'description' => ['required', "max:255"],
            'avatar' => ['required', "file"],
        ], [
            "name.required" => "標題不可為空",
            "cls.required" => "班級不可為空",
            "grade.required" => "屆數不可為空",
            "description.required" => "描述不可為空",
            "avatar.required" => "必須選擇頭像",
            "name.max" => "標題不可超過255字",
            "cls.max" => "班級不可超過255字",
            "grade.max" => "屆數不可超過255字",
            "description.max" => "描述不可超過255字",
        ]);

        if ($request->avatar->isValid()) {
            $filePath = $request->avatar->store('imgs/athletes');
        }
        if (empty($filePath))
            return redirect(route("admin.athletes.create"));

        $athlete = Athlete::create([
            "name" => $request->name,
            "cls" => $request->cls,
            "grade" => $request->grade,
            "description" => $request->description,
            "avatar" => "/public/$filePath",
            "active" => true,
        ]);
        foreach ($request->collection ?? [] as $c)
            Collection::find($c)->update(["athlete_id" => $athlete->id]);

        foreach (json_decode($request->experience, true) as $experience) {
            AthleteExperience::create([
                "name" => $experience[0],
                "rank" => $experience[1],
                "athlete_id" => $athlete->id,
            ]);
        }

        return redirect(route("athletes.list") . "#athlete" . $athlete->idF);
    }

    public function edit(Request $request, $id)
    {
        $athlete = Athlete::findOrFail($id);
        $old_exp = old("experience");
        if (empty($old_exp)) {
            $raw_experiences = AthleteExperience::where("athlete_id", $athlete->id)->get()->map->only(["name", "rank"])->values();
            $experiences = [];
            foreach ($raw_experiences as $experience)
                array_push($experiences, array_values($experience));
        } else {
            $experiences = empty($old_exp) ?: $experiences = json_decode($old_exp, true);
        }
        return view(
            "admin.athletes.create",
            [
                "athlete" => $athlete,
                "experience" => $experiences,
            ]
        );
    }
    public function update(Request $request, $id)
    {
        $athlete = Athlete::findOrFail($id);
        $request->validate([
            'name' => ['required', "max:255"],
            'cls' => ['required', "max:255"],
            'grade' => ['required', "max:255"],
            'description' => ['required', "max:255"],
        ], [
            "name.required" => "標題不可為空",
            "cls.required" => "班級不可為空",
            "grade.required" => "屆數不可為空",
            "description.required" => "描述不可為空",
            "name.max" => "標題不可超過255字",
            "cls.max" => "班級不可超過255字",
            "grade.max" => "屆數不可超過255字",
            "description.max" => "描述不可超過255字",
        ]);


        if ($request->avatar && $request->avatar->isValid()) {
            $filePath = $request->avatar->store('imgs/athletes');
        }
        $update = [
            "name" => $request->name,
            "cls" => $request->cls,
            "grade" => $request->grade,
            "description" => $request->description,
            "active" => true,
        ];
        if (!empty($filePath))
            $update["avatar"] = $filePath;
        $athlete->update($update);

        Collection::where("athlete_id", $athlete->id)->update(["athlete_id" => null]);
        foreach ($request->collection as $c)
            Collection::find($c)->update(["athlete_id" => $athlete->id]);

        AthleteExperience::where("athlete_id", $athlete->id)->delete();
        foreach (json_decode($request->experience, true) as $experience) {
            AthleteExperience::create([
                "name" => $experience[0],
                "rank" => $experience[1],
                "athlete_id" => $athlete->id
            ]);
        }

        return redirect(route("athletes.list") . "#athlete" . $id);
    }
    public function destory(Request $request, $id)
    {
        $athlete = Athlete::findOrFail($id);
        $athlete->update([
            "active" => false
        ]);
        return redirect(route("athletes.list"));
    }
}
