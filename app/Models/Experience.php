<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'period',
        'role',
        'company',
        'logo',
        'image',
        'attachment_title',
        'description',
        'color',
        'order',
    ];

    public function attachments()
    {
        return $this->hasMany(ExperienceAttachment::class)->orderBy('id', 'desc');
    }
}
