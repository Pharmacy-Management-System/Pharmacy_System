<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'user_id',
        'avatar_image',
        'pharmacy_id',
        'is_banned'
    ];

    protected $hidden = [
        'password'
    ];
    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }

    public function user()
    {
        return $this->belongsTo( User::class);
    }





    public function order(){
        return $this->hasMany(Order::class,'doctor_id');
    }

}
