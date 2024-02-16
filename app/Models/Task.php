<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'task_title',
        'task_desc',
        'task_status',
        'task_type',
        'task_date',
        'task_price',
        'task_remark',
        'task_priority',
        'task_vendor',
        'task_vendor_phone'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function file()
    {
        return $this->hasMany(File::class, 'task_id');
    }

    public function member()
    {
        return $this->hasMany(Taskmember::class, 'task_id');
    }

    public function locationMany()
    {
        return $this->hasMany(Tasktag::class, 'task_id');
    }

    public function assetMany()
    {
        return $this->hasMany(Tasktag::class, 'task_id');
    }

    public function commentMany()
    {
        return $this->hasMany(Taskcomment::class, 'task_id');
    }

}
