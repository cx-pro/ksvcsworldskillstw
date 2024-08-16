<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name',
        'cls',
        'grade',
        'description',
        'avatar',
        'active'
    ];
    public function collections()
    {
        return Collection::where("athlete_id", $this->id);
    }
}
