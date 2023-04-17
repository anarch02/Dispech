<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Region;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        // 'user_id',
        'region_id',
        'address'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Organization $organization)
        {
            $organization->slug = $organization->slug ?? str($organization->name)->slug();
        });
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class)->orderBy('name');
    }

    public function drones(): HasMany
    {
        return $this->hasMany(Drones::class);
    }

    /**
     * Get all of the pilots for the Organization
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pilots(): HasMany
    {
        return $this->hasMany(Pilots::class)->orderBy('name');
    }
}
