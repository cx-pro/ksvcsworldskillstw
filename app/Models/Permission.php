<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'level',
    ];

    public static function admin_level()
    {
        return Permission::where("name", "_admin")->first()->level;
    }
    public function roles()
    {
        return Role::where("permission_id", $this->id);
    }
    public function controllable_roles()
    {
        return Role::whereIn("permission_id", $this->lower_permissions()->pluck("id")->toArray());
    }
    public function lower_permissions()
    {
        return Permission::where("level", ">=", $this->level);
    }
    public function is_admin()
    {
        return $this->level <= $this->admin_level();
    }
    public function is_default_admin()
    {
        return $this->name == "_admin";
    }
}
