<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = 'areas';

    protected $fillable = [
        'id',
        'name',
        'address',
        'country_id'
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    public function pharmacies(){
        return $this->hasMany(Pharmacy::class ,'area_id');
    }
    
    public function address()
    {
        return $this->hasMany(Address::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}