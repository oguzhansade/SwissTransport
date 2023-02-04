<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'offerteId',
        'taskDate',
        'taskTime',
        'taskTotalPrice'
    ];

    static function countTask($id)
    {
        $count = Task::where('workerId',$id)->count();
        return $count;
    }
}
