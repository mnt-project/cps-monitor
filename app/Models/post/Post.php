<?php

namespace App\Models\post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'priority',
        'titel',
        'path',
    ];
    protected $dates = ['deleted_at'];

    public function grouppost()
    {
        return $this->hasOne(GroupPost::class,'post_id');
    }
}
