<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connect extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip_id',
        'user_id',
        'visitor',
        'agent',
        'route',
    ];
    public function ip()
    {
        return $this->belongsTo(Ip::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function connectCreate($ip_id, $user_id, $visitor, $agent, $route)
    {
        return Connect::create([
            'ip_id'=>$ip_id,
            'user_id'=>$user_id,
            'visitor'=>$visitor,
            'agent'=>$agent,
            'route'=>$route,
        ]);
    }
}
