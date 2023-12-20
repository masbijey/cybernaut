<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employeeinventory extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = [
        'employee_id',
        'start',
        'end',
        'description',
        'file'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

}
