<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'warnings',
        'public',
        'open',
        'invite',
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
    public function groupFollowCount()
    {
        return $this->follow->count();
    }
}
