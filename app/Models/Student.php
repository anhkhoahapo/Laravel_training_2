<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class Student extends Model
{
    protected $fillable = ['name', 'birthday', 'address', 'phone', 'email',];

    public function schoolClasses()
    {
        $this->belongsToMany(SchoolClass::class,'class_student', 'class_id', 'student_id')
            ->withPivot('score')->withTimestamps();
    }
}
