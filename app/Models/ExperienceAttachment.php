<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'experience_id',
        'title',
        'subtitle',
        'description',
        'image',
        'order',
    ];

    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }
}
