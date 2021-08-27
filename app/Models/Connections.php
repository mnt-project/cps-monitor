<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Connections extends Model
{
    use HasFactory;
    protected $fillable = ['visitor'];

    public function getCountConnections($ip)
    {
        return $this->where('visitor',$ip)->count();
    }
}
