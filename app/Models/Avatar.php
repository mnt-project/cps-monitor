<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class Avatar extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'hash_name',
        'patch',
    ];

    protected $hidden = [
        'hash_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function parametr()
    {
        return $this->belongsTo(Settings::class, 'user_id');
    }
}
