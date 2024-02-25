<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guest extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'guests';

    public const GUEST_TYPES = [
        'all_day',
        'evening',
    ];

    public function plusOneParent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'plus_one_of');
    }

    public function plusOneChild(): HasOne
    {
        return $this->hasOne(self::class, 'plus_one_of');
    }

    public function receivedInvite(): BelongsTo
    {
        return $this->belongsTo(ReceivedInvite::class);
    }
}
