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

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'plus_one_allowed',
        'guest_type',
        'plus_one_of',
        'is_child',
        'unique_code',
        'invite_sent_on',
    ];

    public function plusOneParent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'plus_one_of');
    }

    public function plusOneChild(): HasOne
    {
        return $this->hasOne(self::class, 'plus_one_of');
    }

    public function receivedInvite(): HasOne
    {
        return $this->hasOne(ReceivedInvite::class);
    }
}
