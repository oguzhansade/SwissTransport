<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LagerungService extends Model
{
    protected $fillable = [
        'lagerungDate',
        'lagerungTime',
    ];
    use HasFactory;

    
}
