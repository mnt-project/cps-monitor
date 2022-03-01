<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class
Album extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'group_id',
        'user_id',
        'name',
        'visible',
        'dir',
        'location',
        'description',
        'public',
        'open',
        'lock',
        'lock_key',
        'rate',
        'avatar',
        'hash_name',
        'patch',
    ];

    protected $dates = ['deleted_at'];

    public function  albumunit()
    {
        return $this->hasMany(AlbumUnit::class,'album_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
