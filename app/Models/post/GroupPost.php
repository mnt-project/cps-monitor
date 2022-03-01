<?php

namespace App\Models\post;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupPost extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable= [
        'post_id',
        'user_id',
        'group_id',
        'resource',
        'recource_id',
        'checked',
        'public',
        'blocked',
        'path',
        'style',
        'titel',
        'text',
    ];
    protected $dates = ['deleted_at','created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
