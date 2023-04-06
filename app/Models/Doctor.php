<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cog\Contracts\Ban\Bannable as BannableInterface;
use Cog\Laravel\Ban\Traits\Bannable;
use Cog\Laravel\Ban\Models\Ban;


class Doctor extends Model implements BannableInterface
{
    use HasFactory, Bannable;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'user_id',
        'avatar_image',
        'pharmacy_id',
        'is_banned',
        'banned_at'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'deleted_at' => 'date:Y-m-d'
    ];

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
