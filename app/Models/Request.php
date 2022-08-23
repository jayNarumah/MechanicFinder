<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mechanic_id',
        'car_product_id',
        'description',
        'request_date',
        'status',
        'location',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'mechanic_id' => 'integer',
        'car_product_id' => 'integer',
        'request_date' => 'datetime',
    ];

    /**
     * The carProducts that belong to the Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carProduct()//: BelongsToMany
    {
        return $this->belongsTo(CarProduct::class, 'car_product_id', 'id');
    }

    /**
     * Get the user that owns the Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()//: BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the mechanic that owns the Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mechanic()//: BelongsTo
    {
        return $this->belongsTo(Mechanic::class, 'mechanic_id', 'id');
    }

    /**
     * Get the payments associated with the Request
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()//: HasMany
    {
        return $this->hasMany(Payment::class, 'request_id', 'id');
    }
}
