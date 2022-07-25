<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecializationArea extends Model
{
    use HasFactory;

    protected $fillables = [
        'name',
        'status',
    ];

    /**
     * Get all of the areaSpecializations for the SpecializationArea
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function areaSpecializations()//: HasMany
    {
        return $this->hasMany(AreaSpecialization::class, 'area_specialization_id', 'id');
    }
}
