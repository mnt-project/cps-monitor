<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'warnings',
        'public',
        'open',
        'invite',
        'rate',
        'visits',
        'online',
        'balance',
        'albumid',
        'galleryid',
        'visibility',
        'position',
        'state',
        'user_id',
        'public',
        'notes',
        'about',
        'avatar',
        'hash_name',
        'patch',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function  post()
    {
        return $this->hasMany(Post::class,'group_id');
    }
    public function  follow()
    {
        return $this->hasMany(Follow::class,'group_id');
    }
    public function  album()
    {
        return $this->hasMany(Album::class,'album_id', 'albumid');
    }
    public function groupFollowCount()
    {
        return $this->follow->count();
    }
}
