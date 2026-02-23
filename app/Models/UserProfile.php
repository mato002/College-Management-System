<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    protected $fillable = [
        'phone',
        'phone_alt',
        'date_of_birth',
        'gender',
        'nationality',
        'id_number',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'postal_code',
        'country',
        'emergency_contact_name',
        'emergency_contact_phone',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Whether required biodata fields are filled (college mandatory). */
    public function isComplete(): bool
    {
        return $this->phone
            && $this->date_of_birth
            && $this->gender
            && $this->nationality
            && $this->address_line1
            && $this->city
            && $this->country
            && $this->emergency_contact_name
            && $this->emergency_contact_phone;
    }
}
