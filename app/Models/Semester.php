<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'start_date',
        'end_date',
        'registration_deadline',
        'exam_start',
        'exam_end',
        'is_current',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'registration_deadline' => 'datetime',
            'exam_start' => 'date',
            'exam_end' => 'date',
            'is_current' => 'boolean',
        ];
    }

    public static function current(): ?self
    {
        return static::where('is_current', true)->first();
    }

    public static function forSlug(string $slug): ?self
    {
        return static::where('slug', $slug)->first();
    }

    public function isRegistrationOpen(): bool
    {
        if (! $this->registration_deadline) {
            return true;
        }
        return now()->lte($this->registration_deadline);
    }
}
