<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'gender',
        'date_of_birth',
        'avatar_image',
        'phone',
        'email_verified_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function area()
    {
        return $this->belongsTo(Area::class);
    }


    // public function orders()
    // {
    //     return $this->hasMany(Order::class);
    // }
}
