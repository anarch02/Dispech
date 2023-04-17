<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DronsModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (DronsModel $drons_model)
        {
            $drons_model->slug = $drons_model->slug ?? str($drons_model->title)->slug();
        });
    }

    /**
     * Get all of the drones forHasManyonsModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function drones(): HasMany
    {
        return $this->hasMany(Drones::class)->orderBy('organization_id');
    }
}
