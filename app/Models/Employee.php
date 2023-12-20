<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'gender',
        'npwp',
        'nik',
        'religion',
        'bornplace',
        'borndate',
        'address',
        'phone',
        'status_perkawinan',
        'joindate',
        'email',
        'photo',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function education()
    {
        return $this->hasMany(Employeeeducation::class, 'employee_id');
    }

    public function experience()
    {
        return $this->hasMany(Employeeexperience::class, 'employee_id');
    }

    public function contract()
    {
        return $this->hasMany(Employeecontract::class, 'employee_id');
    }

    public function family()
    {
        return $this->hasMany(Employeefamily::class, 'employee_id');
    }

    public function sickness()
    {
        return $this->hasMany(Employeesickness::class, 'employee_id');
    }

    public function inventory()
    {
        return $this->hasMany(Employeeinventory::class, 'employee_id');
    }

    public function rewpun()
    {
        return $this->hasMany(Employeerewpun::class, 'employee_id');
    }

    public function training()
    {
        return $this->hasMany(Employeetraining::class, 'employee_id');
    }

    public function leave()
    {
        return $this->hasMany(Employeeleave::class, 'employee_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // public function schedules()
    // {
    //     return $this->hasMany(Schedule::class);
    // }
    
    // public function attendance()
    // {
    //     return $this->hasMany(Attendance::class);
    // }


}
