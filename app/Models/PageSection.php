<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = [
        'page_id',
        'type',
        'title',
        'spotlight_text',
        'content',
        'media_id',
        'thumbnail_media_id',
        'button_label',
        'button_url',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function media(): BelongsTo
    {
        return $this->belongsTo(Medium::class, 'media_id');
    }

    public function thumbnailMedia(): BelongsTo
    {
        return $this->belongsTo(Medium::class, 'thumbnail_media_id');
    }
}
