<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    private function form_validation(Request $request, $is_editing = false, $id = null)
    {
        if ($is_editing && empty($id))
            return;
        $validator = Validator::make($request->all(), [
            'name' => ['required', "max:255"],
            'level' => ['required'],
        ], [
            "name.required" => "名稱不可為空",
            "level.required" => "權限等級不可為空",
            "name.max" => "名稱不可超過255字",
        ]);
        $validator->after(function ($validator) use ($request, $is_editing, $id) {
            if (!$is_editing && Permission::where("name", $request->name)->count()) {
                $validator->errors()->add(
                    'name',
                    '此名稱已被使用'
                );
            }
            if (Permission::where("level", $request->level)->count()) {
                if (!$is_editing)
                    $validator->errors()->add(
                        'level',
                        '此等級權限已存在'
                    );
                else if (Permission::where("level", $request->level)->first()->id != $id)
                    $validator->errors()->add(
                        'level',
                        '此等級權限已存在'
                    );
            }
            if (!auth()->user()->level_smaller($request->level)) {
                $validator->errors()->add(
                    'level',
                    '您的權限不足'
                );
            }
        });
        return $validator;
    }
    public function list()
    {
        return view(
            "admin.permissions.list",
            [
                "permissions" => Permission::where("level", ">=", auth()->user()->level())->orderBy("level")->orderBy("name")->get()
            ]
        );
    }
    public function create()
    {
        return view("admin.permissions.create");
    }
    public function store(Request $request)
    {
        $validator = $this->form_validation($request);
        if ($validator->fails()) {
            return redirect(route("admin.permissions.create", [], false))
                ->withErrors($validator->errors())
                ->withInput($request->all());
        }

        $permission = Permission::create([
            "name" => $request->name,
            "level" => $request->level,
        ]);
        return redirect(route("admin.permissions.list") . "#permission" . $permission->id);
    }
    public function edit(Request $request, $id)
    {
        return view(
            "admin.permissions.create",
            [
                "permission" => Permission::findOrFail($id),
            ]
        );
    }
    public function update(Request $request, $id)
    {
        $validator = $this->form_validation($request, true, $id);
        if ($validator->fails()) {
            return redirect(route("admin.permissions.edit", ["id" => $id], false))
                ->withErrors($validator->errors())
                ->withInput($request->all());
        }
        $permission = Permission::findOrFail($id)->update([
            "name" => $request->name,
            "level" => $request->level,
        ]);

        return redirect(route("admin.permissions.list") . "#permissions" . $id);
    }
    public function update_levels(Request $request)
    {
        $min_level = min(Permission::where("level", ">=", auth()->user()->level())->pluck("level")->toArray());
        foreach ($request->input("new_id", []) as $index => $id) {
            Permission::findOrFail(str_replace("permission", "", $id))->update([
                "level" => $min_level + $index
            ]);
        }
        return response()->json(["status" => "success"]);
    }
    public function destory(Request $request, $id)
    {
        Permission::findOrFail($id)->delete();
        return redirect(route("admin.permissions.list"));
    }
}
