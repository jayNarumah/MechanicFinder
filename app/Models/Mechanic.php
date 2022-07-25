<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'status',
        'years_experiance',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'mechanic_id' => 'integer',
        'years_experiance' => 'integer',
    ];

    protected $with = [
        'user'
    ];

    /**
     * Get the user that owns the Mechanic
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()//: BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the request associated with the Mechanic
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function request()//: HasOne
    {
        return $this->hasOne(Request::class, 'mechanic_id', 'id');
    }
}
