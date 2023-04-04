<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Cog\Contracts\Ban\Bannable as BannableInterface;
use Cog\Laravel\Ban\Traits\Bannable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements BannableInterface
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles , Bannable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function owns()
    {
        return $this->hasOne(Pharmacy::class,'user_id');
    }

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class,'user_id');
    }

   public function pharmacy(){
    return $this->hasOne(Pharmacy::class);
   }

   public function doctor()
   {
       return $this->hasOne(Doctor::class);

   }
   public function isAdmin()
   {
       return $this->role === 'admin';
   }

   public function isPharmacy()
   {
       return $this->role === 'pharmacy';
   }

}
