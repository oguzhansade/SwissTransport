<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;
    protected $fillable = [
        'userId',
        'name',
        'surname',
        'email',
        'phone',
        'workPrice',
    ];
    static function getWorker($id,$param)
    {
        $data = Worker::where('userId',$id)->first();
        return $data[$param];
    }

    static function getWorker2($id,$param)
    {
        $data = Worker::where('id',$id)->first();
        return $data[$param];
    }

    static function fullName($id)
    {
        $data = Worker::where('id',$id)->first();
        return $data['name'].' '.$data['surname'];
    }
    static function fullName2($id)
    {
        $data = Worker::where('userId',$id)->first();
        return $data['name'].' '.$data['surname'];
    }
}
