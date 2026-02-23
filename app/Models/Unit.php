<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'semester',
        'capacity',
        'credits',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'capacity' => 'integer',
            'credits' => 'integer',
        ];
    }

    public function lecturers(): BelongsToMany
    {
        return $this->belongsToMany(Lecturer::class, 'unit_lecturer')
            ->withPivot('semester')
            ->withTimestamps();
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class);
    }

    public function timetableSlots(): HasMany
    {
        return $this->hasMany(TimetableSlot::class);
    }

    public function isFull(string $semester = null): bool
    {
        if ($this->capacity === 0) {
            return false;
        }
        $query = $this->enrollments()->where('status', 'enrolled');
        if ($semester) {
            $query->where('semester', $semester);
        }
        return $query->count() >= $this->capacity;
    }
}
