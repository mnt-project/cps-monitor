<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_id',
        'post_id',
        'user_id',
        'format',
        'discription',
        'rate',
        'hash_name',
        'patch',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class, 'albumid', 'album_id');
    }
}
