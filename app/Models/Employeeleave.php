<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employeeleave extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = [
        'user_id',
        'type',
        'valid_until',
        'pick_date',
        'description'
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
