<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employeetraining extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = [
        'employee_id',
        'description',
        'trainer',
        'date',
        'start',
        'end',
        'duration',
        'venue',
        'file'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    
}
