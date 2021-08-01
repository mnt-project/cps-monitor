<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'rated_id',
        'rate',
        'value',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
