<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class Student extends Authenticatable
{
    protected $guard = 'student';

    protected $fillable = ['mssv', 'password', 'name', 'birthday', 'avatar', 'email',];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function schoolClasses()
    {
        $this->belongsToMany(SchoolClass::class,'class_student', 'class_id', 'student_id')
            ->withPivot('score')->withTimestamps();
    }
}
