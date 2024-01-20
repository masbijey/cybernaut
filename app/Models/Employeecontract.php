<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employeecontract extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'employeecontracts';

    protected $fillable = [
        'user_id',
        'start',
        'end',
        'department_id',
        'jobtitle',
        'level',
        'remark',
        'file'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

}
