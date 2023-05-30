<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'quittungId',
        'expenseName',
        'expenseValue',
    ];
    use HasFactory;
}
