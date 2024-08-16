<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = [
        'name',
        'grade',
        'quiz',
        'file',
        'sql',
        "project_name",
        'location',
        'path',
        'public_path',
        'db_name',
        'author_id',
        'athlete_id',
    ];
    public function athlete()
    {
        return Athlete::findOrFail($this->athlete_id);
    }
    public function get_grade(): string
    {
        return empty($this->grade) ? $this->athlete()->grade : $this->grade;
    }
    public function group_by_grade()
    {
        $arr = [];
        foreach ($this->get() as $coll) {
            $g = $coll->get_grade();
            if (!array_key_exists($g, $arr))
                $arr[$g] = [];
            array_push($arr[$g], $coll);
        }
        krsort($arr);
        return array_merge(...array_values($arr));
    }
}