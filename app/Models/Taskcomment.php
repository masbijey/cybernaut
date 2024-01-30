<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Taskcomment extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = [
        'task_id',
        'file',
        'comment',
        'created_by'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
