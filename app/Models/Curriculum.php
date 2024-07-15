<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curriculum extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_id', 
        'title', 
        'content', 
        'video_url', 
        'file_url'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
