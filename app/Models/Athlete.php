<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'description',
        'avatar',
        'active'
    ];
}
