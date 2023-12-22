<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workordertag extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = [
        'workorder_id',
        'location_id',
        'asset_id',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function asset()
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }


}
