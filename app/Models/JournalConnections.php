<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalConnections extends Model
{
    use HasFactory;
    protected $fillable = [
        'visitor',
        'status',
        'dirname',
        'basename',
        'filename',
        'agent',
    ];
}
