<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fedback extends Model
{
    use HasFactory;
    protected $fillables = [
        'user_id',
        'message',
        'status',
    ];

    protected $casts = [
        'user_id' => 'integer',
    ];

    /**
     * Get the user that owns the Fedback
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()//: BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
