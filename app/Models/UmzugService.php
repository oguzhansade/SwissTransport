<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmzugService extends Model
{
    protected $fillable = [
        'umzugDate',
        'umzugTime',
        'workHours',
        'ma',
        'lkw',
        'anhanger',
    ];
    use HasFactory;
}
