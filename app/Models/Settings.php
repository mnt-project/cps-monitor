<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class Settings extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'muted',
        'admin',
        'sort',
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
        'notes',
        'connected_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function avatar()
    {
        return $this->hasOne(Avatar::class,'user_id' , 'user_id');
    }
    public function scopeGetMutedUsers($query)
    {
        return $query->with('user')->where('muted',true);
    }
}
