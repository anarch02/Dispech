<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organization;
use App\Models\DronsModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Drones extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'organization_id',
        'drons_model_id',
        'id_number',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Drones $drones)
        {
            $drones->slug = $drones->slug ?? str($drones->id_number)->slug();
        });
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }


    /**
     * Get the user that owns the Drones
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function model(): BelongsTo
    {
        return $this->belongsTo(DronsModel::class, 'drons_model_id', 'id');
    }

}
