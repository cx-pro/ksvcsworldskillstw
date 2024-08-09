<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'permission_id',
    ];
    public $timestamps = false;

    public function permission()
    {
        return Permission::findOrFail($this->permission_id);
    }
    public function permission_level(): int
    {
        return $this->permission()->level;
    }
    public function is_admin()
    {
        return $this->permission()->is_admin();
    }
}
