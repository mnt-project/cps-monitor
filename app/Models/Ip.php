<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ip extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'ip',
        'name',
        'user_id',
        'rights',
        'description',
        'ban',
        'bandate',
    ];
    protected $dates = ['bandate','deleted_at'];

    public function connect()
    {
        return $this->hasMany(Connect::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function ipCreate($ip,$user_id)
    {
        return Ip::create([
            'ip'=>$ip,
            'user_id'=>$user_id,
        ]);
    }
}
