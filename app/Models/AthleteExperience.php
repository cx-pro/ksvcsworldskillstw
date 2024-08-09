<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AthleteExperience extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'rank',
        'athlete_id',
    ];
}
