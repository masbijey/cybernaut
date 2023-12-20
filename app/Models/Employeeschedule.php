<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employeeschedule extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = [
        'employee_id', 
        'day', 
        'start_time', 
        'end_time'
    ];
}
