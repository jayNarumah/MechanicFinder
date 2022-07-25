<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaSpecialization extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization_area_id',
        'car_product_id',
    ];

    protected $casts = [
        'user_id' => 'integer',
    ];

    /**
     * The specializationAreas that belong to the AreaSpecialization
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function specializationArea()//: BelongsTo
    {
        return $this->belongsTo(SpecializationArea::class, 'specialization_area_id', 'id');
    }

    /**
     * Get the user that owns the AreaSpecialization
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()//: BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * The carProducts that belong to the AreaSpecialization
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carProduct()//: BelongsToMany
    {
        return $this->belongsTo(CarProduct::class, 'car_product_id', 'id');
    }

}
