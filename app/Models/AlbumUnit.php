<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlbumUnit extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'album_id',
        'post_id',
        'user_id',
        'name',
        'format',
        'discription',
        'rate',
        'hash_name',
        'patch',
    ];

    protected $dates = ['deleted_at'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
