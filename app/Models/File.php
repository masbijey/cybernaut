<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class File extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = [
        'filenmaintenance_idame',
        'file',
        'remark',
        'task_id',
        'workorder_id',
    ];
}
