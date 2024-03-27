<?php

namespace App\RsvpResponse\Models;

use App\RsvpResponse\Factories\RsvpResponseFactory;
use App\Guest\Models\Guest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class RsvpResponse extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rsvp_responses';

    protected $fillable = [
        'guest_id',
        'coming',
        'alcohol',
        'dietary_requirements',
    ];

    public function guest(): HasOne
    {
        return $this->hasOne(Guest::class);
    }

    public function scopeAlcoholFree($query): Builder
    {
        return $query->where('alcohol', false);
    }

    public function scopeHasDietaryRequirements($query): Builder
    {
        return $query->whereNotNull('dietary_requirements');
    }

    protected static function newFactory(): RsvpResponseFactory
    {
        return RsvpResponseFactory::new();
    }
}
