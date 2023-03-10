<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'street',
        'post_code',
        'city',
        'phone',
        'mobile',
        'contact_person' ,
        'email' ,
        'google-email',
        'website',
    ];
    use HasFactory;

    static function InfoCompany($param)
    {
        $data = Company::first();
        return $data[$param];
    }
    static function getCompany()
    {
        $data = Company::first();
        return $data;
    }
}
