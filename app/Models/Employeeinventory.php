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
        'user_id',
        'start',
        'end',
        'description',
        'file',
        'asset_id'
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
