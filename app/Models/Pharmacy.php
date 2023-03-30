<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

    protected $fillable = [
        'pharmacy_id',
        'avatar',
        'area_id',
        'priority'
    ];

    protected $casts = [
        'pharmacy_id' => 'integer',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class,'pharmacy_id');
    }

    public function orders()
    {
       return $this->hasMany(Order::class,'pharmacy_id');
    }

}
