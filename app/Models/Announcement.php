<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'category_id',
        'author_id',
        'active'
    ];

    public function category()
    {
        return AnnouncementCategory::findOrFail($this->category_id);
    }

}
