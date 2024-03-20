<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceivedInvite extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'received_invites';

    protected $fillable = [
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
}
