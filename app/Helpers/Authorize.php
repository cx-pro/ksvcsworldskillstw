<?php
namespace App\Helpers;

use App\Models\Permission;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;

class Authorize
{
    private function getLevel(user $user)
    {
        return permission::where("id", Role::where("id", $$user->role_id)->first()->permission_id)->first()->level;
    }
    static function ADMIN()
    {
        Gate::allowIf(fn(User $user) => $user->isAdmin(), "存取遭拒");
    }
    static function USER()
    {
        Gate::allowIf(fn(User $user) => $user->isUser(), "存取遭拒");
    }
    static function CHECK(string $permission_name)
    {
        $level = Permission::where("name", $permission_name)->first()->level;
        Gate::allowIf(fn(User $user) => $this->getLevel($user) <= $level, "存取遭拒");
    }

}