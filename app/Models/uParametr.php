<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class uParametr extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',//Идентификатор пользователя
        'muted',//Флаг мута
        'admin',//
        'sort',//
        'banned',
        'viewid',
        'notifications',
        'language',
        'private_profile',
        'status',
        'smessage',
        'reputation',
        'interests',
        'about',
        'notes',//Заметка о пользователе
        'connected_at',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
        'admin',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
