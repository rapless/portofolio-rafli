<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'group',
        'key',
        'label',
        'type',
        'value',
        'sort_order',
        'is_public',
    ];

    protected $casts = [
        'value' => 'array',
        'is_public' => 'boolean',
    ];

    public static function getValue(string $key, mixed $default = null): mixed
    {
        $setting = static::query()
            ->where('key', $key)
            ->where('is_public', true)
            ->first();

        return $setting?->value['value'] ?? $default;
    }
}
