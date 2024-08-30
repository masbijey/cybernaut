<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employeeleaveapproval extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = 'leaveapproval';

    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'work_date',
        'remark'
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approval()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
