<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'status',
        'bio_short',
        'bio_full',
        'location',
        'email',
        'phone',
        'github_url',
        'linkedin_url',
        'contact_intro',
        'avatar',
        'years_exp',
        'projects_completed',
        'certificates_count',
    ];

}
