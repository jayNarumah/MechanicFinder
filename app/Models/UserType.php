<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    private $fillables = ['type'];

    /**
     * Get the user associated with the UserType
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()//: HasOne
    {
        return $this->hasOne(User::class, 'user_type_id', 'id');
    }
}
