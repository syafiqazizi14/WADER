<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatistikMojokertoItem extends Model
{
    protected $fillable = [
        'title',
        'image_path',
        'image_base64',
        'image_mime_type',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}
