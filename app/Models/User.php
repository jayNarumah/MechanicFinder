<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'address',
        'password',
        'user_type_id',
        'phone_number',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'user_type_id' => 'integer',
    ];

    /**
     * The userType that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function userTypes()//: BelongsToMany
    {
        return $this->belongsToMany(UserType::class, 'user_type_id', 'id');
    }

    /**
     * Get the fedbacks that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function fedbacks()//: BelongsTo
    {
        return $this->belongsTo(Fedback::class, 'user_id', 'id');
    }

    /**
     * Get the mechanic associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function mechanic()//: HasOne
    {
        return $this->hasOne(Mechanic::class, 'user_id', 'id');
    }

    /**
     * Get all of the requests for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function requests()//: HasMany
    {
        return $this->hasMany(Request::class, 'user_id', 'id');
    }

    /**
     * Get all of the araeSpecializes for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function areaSpecializations()//: HasMany
    {
        return $this->hasMany(AreaSpecialization::class, 'user_id', 'id');
    }
}
