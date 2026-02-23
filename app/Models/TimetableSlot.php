<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TimetableSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_id',
        'day_of_week',
        'start_time',
        'end_time',
        'room',
        'semester',
    ];

    // start_time, end_time stored as time (e.g. "09:00:00") — use as string or Carbon::parse()

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
