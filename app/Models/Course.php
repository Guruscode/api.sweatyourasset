<?php

namespace App\Models;

use App\Models\Curriculum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'price',
        'overview',
        'language',
        'number_of_lessons',
        'hours',
        'what_you_will_learn'
    ];

    protected $casts = [
        'what_you_will_learn' => 'array',
    ];

    public function curriculums()
    {
        return $this->hasMany(Curriculum::class);
    }

    public function purchase()
    {
        return $this->hasOne(Purchase::class);
    }
}
