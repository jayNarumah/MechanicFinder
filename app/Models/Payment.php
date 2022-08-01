<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'payment_id',
        'amount',
        'status',
    ];

    protected $casts = [
        'request_id' => 'integer',
        'payment_id' => 'integer',
        'amount' => 'float',
    ];

    /**
     * Get the request that owns the Payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function request()// BelongsTo
    {
        return $this->belongsTo(Request::class,);
    }
}
