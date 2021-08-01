<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Messages extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'user_id',
        'sender_id',
        'subject',
        'type',
        'hidden',
        'text',
        'readed',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'sender_id');
    }
    public function checkRecipientUser()
    {

        return $this->user_id === Auth::id();
    }
}
