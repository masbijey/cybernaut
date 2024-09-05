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

    public function approval1()
    {
        return $this->belongsTo(User::class, 'approved_1_by');
    }

    public function approval2()
    {
        return $this->belongsTo(User::class, 'approved_2_by');
    }

    public function approval3()
    {
        return $this->belongsTo(User::class, 'approved_3_by');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
