<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailConfiguration extends Model
{
    protected $fillable = [
        'host','port','ssl','username','password','display_name','reply_address','companyId'
        
    ];
    use HasFactory;


}
