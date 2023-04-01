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
        'area_id',
        'street_name',
        'building_no',
        'floor_number',
        'flat_number',
        'is_main',
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
