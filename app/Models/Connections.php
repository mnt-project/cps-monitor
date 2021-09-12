<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connections extends Model
{
    use HasFactory;
    protected $fillable = ['visitor','visits'];
    public function scopeCountConnections($query,$ip)
    {
        return $query->where('visitor',$ip)->count();
    }
    public function address()
    {
        return $this->hasOne(Address::class , 'ipaddress','visitor');
    }
}
