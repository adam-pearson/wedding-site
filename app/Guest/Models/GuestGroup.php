<?php

namespace App\Guest\Models;

use App\RsvpResponse\Models\RsvpResponse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Guest\Factories\GuestFactory;

class GuestGroup extends Model
{
    use SoftDeletes;

    protected $table = 'guest_groups';

    protected $fillable = [
        'group_name',
    ];

    public function guests(): HasMany
    {
        return $this->hasMany(Guest::class, 'group_id');
    }
}
