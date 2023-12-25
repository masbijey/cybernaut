<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Workorder extends Model
{
    use HasFactory;
    use SoftDeletes;

    Protected $fillable = [
        'order_no',
        'title',
        'description',
        'priority',
        'status',
        'end_date',
        'due_date',

        'asset_id',
        'location_id',
        'department_id',
        'employee_id',
        'user_id'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function locationMany()
    {
        return $this->hasMany(Workordertag::class, 'workorder_id');
    }

    public function assetMany()
    {
        return $this->hasMany(Workordertag::class, 'workorder_id');
    }

    public function departmentMany()
    {
        return $this->hasMany(Workordertag::class, 'workorder_id');
    }

    public function commentMany()
    {
        return $this->hasMany(Workordercomment::class, 'workorder_id');
    }


}
