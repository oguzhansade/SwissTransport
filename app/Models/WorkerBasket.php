<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerBasket extends Model
{
    use HasFactory;
    protected $fillable = [
        'offerteId',
        'taskId',
        'workerId',
        'userId',
        'workerName',
        'workerPrice',
        'workHour',
        'workerHour',
        'taskDate',
        'taskTime',
        'totalPrice',
        'payStatus'
    ];

    static function getBasket($id)
    {
        $data = WorkerBasket::where('taskId',$id)->get();
        return $data;
    }
}
