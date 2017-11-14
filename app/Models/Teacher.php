<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class Teacher extends Authenticatable
{
    protected $guard = 'teacher';

    protected $fillable = ['teacher_id', 'password', 'name', 'birthday', 'avatar', 'email',];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function schoolClasses(){
        return $this->hasMany(SchoolClass::class);
    }
}
