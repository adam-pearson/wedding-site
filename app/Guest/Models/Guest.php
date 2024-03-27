<?php

namespace App\Guest\Models;

use App\RsvpResponse\Models\RsvpResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Guest\Factories\GuestFactory;

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

    public function plusOneOwner(): BelongsTo
    {
        return $this->belongsTo(self::class, 'plus_one_of');
    }

    public function plusOne(): HasOne
    {
        return $this->hasOne(self::class, 'plus_one_of');
    }

    public function rsvpResponse(): HasOne
    {
        return $this->hasOne(RsvpResponse::class);
    }

    protected static function booted () {
        static::deleting(function(Guest $guest) {
            $guest->rsvpResponse?->delete();
            $guest->plusOne?->rsvpResponse()->delete();
            $guest->plusOne?->delete();
        });
    }

    protected static function newFactory(): GuestFactory
    {
        return GuestFactory::new();
    }
}
