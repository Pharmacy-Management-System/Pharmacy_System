<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'pharmacy_name',
        'avatar_image',
        'area_id',
        'priority',
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'id' => 'integer',
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d',
        'deleted_at' => 'date:Y-m-d'
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
        return $this->hasMany(Doctor::class);
    }

    public function orders()
    {
       return $this->hasMany(Order::class);
    }

}