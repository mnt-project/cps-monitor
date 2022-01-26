<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable=[
        'ipaddress',
        'titel',
        'note',
    ];

    public function connections()
    {
        return $this->belongsTo(Connections::class,'visitor', 'ipaddress');
    }
    public function journal()
    {
        return $this->belongsTo(JournalConnections::class,'visitor', 'ipaddress');
    }
}
