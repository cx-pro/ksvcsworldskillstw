<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    private function form_validation(Request $request, $user, $is_editing = false)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', "max:255"],
            'email' => ['required', "email", "max:255"],
            'password' => ["max:255"],
            'role' => ['required'],
        ], [
            "name.required" => "名稱不可為空",
            "email.required" => "信箱不可為空",
            "role.required" => "必須選擇身分",
            "name.max" => "名稱不可超過255字",
            "email.max" => "信箱不可超過255字",
            "password.max" => "密碼不可超過255字",
            "email.email" => "信箱格式不符",
        ]);
        $validator->after(function ($validator) use ($request, $user, $is_editing) {
            if (!$is_editing && User::where("name", $request->name)->count()) {
                $validator->errors()->add(
                    'name',
                    '此名稱已被使用'
                );
            }
            if (!$is_editing && !$request->password) {
                $validator->errors()->add(
                    'password',
                    '密碼不可為空'
                );
            }
            if (!$is_editing && User::where("email", $request->email)->count()) {
                $validator->errors()->add(
                    'email',
                    '此信箱已被使用'
                );
            }
            if (!$user->role_accessible($request->role)) {
                $validator->errors()->add(
                    'role',
                    '您的權限不足'
                );
            }
        });
        return $validator;
    }
    public function list()
    {
        return view(
            "admin.users.list",
            [
                "users" => auth()->user()->controllable_users()->get()
            ]
        );
    }
    public function create()
    {
        return view("admin.users.create");
    }

    public function store(Request $request)
    {
        $validator = $this->form_validation($request, auth()->user());
        if ($validator->fails()) {
            return redirect(route("admin.users.create", [], false))
                ->withErrors($validator->errors())
                ->withInput($request->all());
        }
        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "email_verified_at" => $request->boolean("email_verified_at") ? now() : null,
            "password" => Hash::make($request->password),
            "role_id" => $request->role,
            "active" => $request->boolean("active"),
        ]);

        return redirect(route("admin.users.list") . "#user" . $user->id);
    }

    public function edit(Request $request, $id)
    {
        return view(
            "admin.users.create",
            [
                "user" => User::findOrFail($id)
            ]
        );
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validator = $this->form_validation($request, auth()->user(), true);
        if ($validator->fails()) {
            return redirect(route("admin.users.edit", ["id" => $id], false))
                ->withErrors($validator->errors())
                ->withInput($request->all());
        }
        $update_data = [
            "name" => $request->name,
            "email" => $request->email,
            "email_verified_at" => $request->boolean("email_verified_at") ? now() : null,
            "role_id" => $request->role,
            "active" => $request->boolean("active"),
        ];

        if ($request->password) {
            $update_data["password"] = Hash::make($request->password);
        }

        $user->update($update_data);
        return redirect(route("admin.users.list") . "#user" . $id);
    }
    public function destory(Request $request, $id)
    {
        User::findOrFail($id)->delete();
        return redirect(route("admin.users.list"));
    }


}
