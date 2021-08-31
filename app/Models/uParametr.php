<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
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
        'hidden',
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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
