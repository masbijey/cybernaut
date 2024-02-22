<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'token',
        'category_id',
        'vendorName',
        'vendorPhone',
        'vendorAddress',
        'merk',
        'type',
        'serialNumber',
        'buyDate',
        'buyPrice',
        'lastProject',
        'lastCheck',
        'lastMaintenance',
        'remark',
        'file',
        'user_id',
        'buyCond'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function category()
    {
        return $this->belongsTo(Assetcat::class, 'category_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function allocation()
    {
        return $this->hasMany(Assetallocation::class, 'asset_id')->latest('created_at');
    }

    public function taskhistory()
    {
        return $this->hasMany(Tasktag::class, 'asset_id');
    }

    public function maintenance()
    {
        return $this->hasMany(Tasktag::class, 'asset_id');
    }


}
