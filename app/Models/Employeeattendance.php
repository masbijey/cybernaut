<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employeeattendance extends Model
{
    use HasFactory;

    use softDeteles;

    protected $fillable = ['employee_id', 'attendance_date', 'check_in'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
