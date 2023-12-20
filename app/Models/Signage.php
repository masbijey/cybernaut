<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Signage extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'signage';
    
    protected $fillable = [
        'meeting_room',
        'event_name'
    ];
}
