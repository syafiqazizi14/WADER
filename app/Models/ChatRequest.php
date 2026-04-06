<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ChatRequest extends Model
{
    protected $fillable = [
        'requester_name',
        'email',
        'phone',
        'gender',
        'age',
        'institution',
        'address',
        'service_type',
        'status',
        'form_data',
        'conversation_data',
        'submitted_at',
    ];

    protected function casts(): array
    {
        return [
            'form_data' => 'array',
            'conversation_data' => 'array',
            'submitted_at' => 'datetime',
        ];
    }

    public function getServiceAnswersAttribute(): array
    {
        $formData = collect($this->form_data ?? []);

        return $formData
            ->except([
                'name',
                'age',
                'gender',
                'institution',
                'address',
                'email',
                'phone',
                'service',
            ])
            ->filter(function ($value) {
                return ! is_null($value) && $value !== '';
            })
            ->mapWithKeys(function ($value, $key) {
                $label = Str::of($key)->replace('_', ' ')->title()->toString();
                return [$label => $value];
            })
            ->all();
    }

    public function getServiceAnswersTextAttribute(): string
    {
        $items = collect($this->service_answers)
            ->map(function ($value, $label) {
                return $label.': '.$value;
            })
            ->values();

        return $items->isEmpty() ? '-' : $items->implode('; ');
    }
}
