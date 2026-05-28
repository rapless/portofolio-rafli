<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'hero_title',
        'hero_subtitle',
        'about',
        'email',
        'phone',
        'profile_image',
    ];
}
