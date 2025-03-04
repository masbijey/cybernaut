<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Userrole extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =[
        'user_id', // tambahkan kolom user_id di sini
        'admin',
        'asset',
        'hris',
        'room',
        'maintenance',
        'business'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
