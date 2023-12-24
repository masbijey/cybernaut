<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workordercomment extends Model
{
    use HasFactory;
    use softDeletes;
    
    protected $fillable = [
        'workorder_id',
        'employee_id',
        'file',
        'description'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
