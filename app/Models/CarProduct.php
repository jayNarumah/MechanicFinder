<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];
    /**
     * Get all of the areaSpecializations for the CarProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function areaSpecializations()//: HasMany
    {
        return $this->hasMany(AreaSpecialization::class, 'car_product_id', 'id');
    }

    /**
     * Get all of the request for the CarProduct
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function request()//: HasMany
    {
        return $this->hasOne(Request::class, 'car_products', 'id');
    }
}
