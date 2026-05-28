<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'title',
        'description',
        'thumbnail',
        'url',
        'technologies',
        'is_active',
    ];

    protected $casts = [
        'technologies' => 'array',
        'is_active' => 'boolean',
    ];
}
