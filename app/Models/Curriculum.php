<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curriculum extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'course_id',
        'section_name',
        'section_title',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function contents() : HasMany
    {
        return $this->hasMany(Content::class, 'curricula_id');
    }
}
