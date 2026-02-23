<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'unit_id',
        'scope',
        'type',
    ];

    public const SCOPE_UNIT = 'unit';
    public const SCOPE_GLOBAL = 'global';
    public const TYPE_NEWS = 'news';
    public const TYPE_NOTICE = 'notice';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
