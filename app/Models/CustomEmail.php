<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomEmail extends Model
{
    protected $fillable = [
        'offerId',
        'content',
    ];
    use HasFactory;
}
