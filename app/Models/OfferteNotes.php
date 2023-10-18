<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferteNotes extends Model
{
    protected $fillable = [
        'offerId',
        'note',
    ];
    use HasFactory;
}
