<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceLink extends Model
{
    protected $fillable = [
        'name',
        'url',
        'category',
        'icon',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
