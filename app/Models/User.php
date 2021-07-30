<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Cache;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login',
        'group',
        'role',
        'email',
        'age',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function setPasswordAttribute($password){

        $this->attributes['password'] = Hash::make($password);
    }
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function  uparametr()
    {
        return $this->hasOne(uParametr::class,'user_id');
    }
    public function  avatar()
    {
        return $this->hasOne(Avatar::class,'user_id');
    }
    public function  posts()
    {
        return $this->hasOne(Post::class,'user_id');
    }
    public function  groups()
    {
        return $this->hasOne(Group::class,'user_id');
    }
    public function  follow()
    {
        return $this->hasMany(Follow::class,'user_id');
    }
}
