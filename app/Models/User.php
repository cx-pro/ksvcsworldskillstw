<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'role_id',
        'active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return Role::findOrFail($this->role_id);
    }
    public function permission()
    {
        return $this->role()->permission();
    }
    public function level()
    {
        return $this->role()->permission_level();
    }
    public function isAdmin()
    {
        return $this->permission()->is_admin();
    }
    public function controllable_users()
    {
        return User::whereIn("role_id", auth()->user()->permission()->controllable_roles()->pluck("id"));
    }
    public function role_accessible($role_id)
    {
        return $this->level() <= Role::findOrFail($role_id)->permission_level();
    }
    public function permission_accessible($permission_id)
    {
        return $this->level() <= Permission::findOrFail($permission_id)->level;
    }
    public function level_accessible($level)
    {
        return $this->level() <= $level;
    }
    public function level_smaller($level)
    {
        return $this->level() < $level;
    }
}
