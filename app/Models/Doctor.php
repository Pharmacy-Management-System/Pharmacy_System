<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $primaryKey = 'national_id';

    protected $fillable = [
        'national_id',
        'avatar',
        'pharmacy_id',
        'is_banned'
    ];

    protected $hidden = [
        'password'
    ];
    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class, 'pharmacy_id', 'pharmacy_id');
    }

    public function user()
    {
        return $this->belongsTo(related: User::class);
    }

}
