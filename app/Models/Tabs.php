<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tabs extends Model
{
    use HasFactory;

    protected $fillable = [
            'user_id',
            'tabid',
            'titel',
            'type',
            'value',
            'route',
            'life',
            'visible',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
