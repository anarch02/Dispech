<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_id',
        'user_id',
        'height',
        'radius',
        'place',
        'startDate',
        'finishDate',
        'cause',
        'status',
        'isActive',
        'commit'
    ];

    /**
     * Get all of the drones for the Application
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function drones(): BelongsToMany
    {
        return $this->belongsToMany(Drones::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function organization(): HasOne
    {
        return $this->hasOne(Organization::class, 'id', 'organization_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }


    public function coordinates(): HasMany
    {
        return $this->hasMany(Coordinate::class);
    }
}
