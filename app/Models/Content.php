<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Content extends Model
{
    use HasFactory;

    protected $guarded = [
        'curricula_id',
        'title',
        'video_url',
        'file_url'
    ];

    public function curriculum(): BelongsTo {
        return $this->belongsTo(Curriculum::class);
    }
}
