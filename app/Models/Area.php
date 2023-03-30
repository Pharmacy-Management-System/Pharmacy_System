<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = 'areas';

    protected $fillable = [
        'area_id',
        'name',
        'address',
    ];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    protected $casts = [
        'area_id' => 'integer',
    ];
}
