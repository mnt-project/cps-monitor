<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
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
        'connects',
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
    public function checkCurrentPassword($password)
    {
        return Hash::check($password, $this->password);
    }
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }
    public function getNotifications()
    {
        return $this->uparametr->notifications === 1;
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
    public function  ratinguser()
    {
        return $this->hasMany(RatingUser::class,'user_id');
    }
    public function messages()
    {
        return $this->hasMany(Messages::class,'user_id');
    }
}
