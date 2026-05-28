<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'eyebrow',
        'subtitle',
        'content',
        'button_label',
        'button_url',
        'image_path',
        'items',
        'metadata',
        'is_enabled',
        'sort_order',
    ];

    protected $casts = [
        'items' => 'array',
        'metadata' => 'array',
        'is_enabled' => 'boolean',
    ];
}
