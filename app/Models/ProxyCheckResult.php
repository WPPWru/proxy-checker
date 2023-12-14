<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProxyCheckResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'proxy',
        'is_worked_status',
        'type',
        'country',
        'city',
        'speed',
        'external_ip',
    ];
}
