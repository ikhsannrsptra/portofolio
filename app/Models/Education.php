<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';

    protected $fillable = [
        'level',
        'period',
        'title',
        'institution',
        'logo',
        'description',
        'badge_color',
        'order',
    ];
}
