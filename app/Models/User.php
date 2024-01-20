<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();
    }

    protected $fillable = [
        'name',
        'email',
        'password',
        'joinDate'
    ];

    protected $dates = ['deleted_at'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function role()
    {
        return $this->hasOne(Userrole::class);
    }

    protected function level()
    {
        return $this->hasMany(Userlevel::class);
    }

    protected function details()
    {
        return $this->hasOne(Employee::class);
    }

    public function contract()
    {
        return $this->hasMany(Employeecontract::class, 'user_id');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function leave()
    {
        return $this->hasMany(Employeeleave::class, 'user_id');
    }
}
