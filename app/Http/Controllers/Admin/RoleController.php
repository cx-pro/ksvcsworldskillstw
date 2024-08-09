<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    private function form_validation(Request $request, $is_editing = false, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', "max:255"],
        ], [
            "name.required" => "名稱不可為空",
            "name.max" => "名稱不可超過255字",
        ]);
        $validator->after(function ($validator) use ($request, $is_editing, $id) {
            if (!$is_editing && Role::where("name", $request->name)->count()) {
                $validator->errors()->add(
                    'name',
                    '此名稱已被使用'
                );
            }
            if (auth()->user()->role_id != $id && empty($request->permission)) {
                $validator->errors()->add(
                    'permission',
                    '必須選擇權限'
                );
            } else if (!auth()->user()->permission_accessible($request->permission)) {
                $validator->errors()->add(
                    'permission',
                    '您的權限不足'
                );
            }
        });
        return $validator;
    }
    public function list()
    {
        return view(
            "admin.roles.list",
            [
                "roles" => auth()->user()->permission()->controllable_roles()->get()
            ]
        );
    }
    public function create()
    {
        return view("admin.roles.create");
    }
    public function store(Request $request)
    {
        $validator = $this->form_validation($request);
        if ($validator->fails()) {
            return redirect(route("admin.roles.create", [], false))
                ->withErrors($validator->errors())
                ->withInput($request->all());
        }

        $role = Role::create([
            "name" => $request->name,
            "permission_id" => $request->permission,
        ]);
        return redirect(route("admin.roles.list") . "#role" . $role->id);
    }
    public function edit(Request $request, $id)
    {
        return view(
            "admin.roles.create",
            [
                "role" => Role::findOrFail($id),
            ]
        );
    }
    public function update(Request $request, $id)
    {
        $validator = $this->form_validation($request, true, $id);
        if ($validator->fails()) {
            return redirect(route("admin.roles.edit", ["id" => $id], false))
                ->withErrors($validator->errors())
                ->withInput($request->all());
        }
        $update_data = [
            "name" => $request->name,
        ];
        if (auth()->user()->role_id != $id)
            $update_data["permission_id"] = $request->permission;
        Role::findOrFail($id)->update($update_data);

        return redirect(route("admin.roles.list") . "#roles" . $id);
    }
    public function destory(Request $request, $id)
    {
        Role::findOrFail($id)->delete();
        return redirect(route("admin.roles.list"));
    }
}
