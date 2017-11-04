<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class SchoolClass extends Model
{
    protected $fillable = ['teacher_id', 'subject_id' , 'semester',];

    public function teacher()
    {
        $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        $this->belongsTo(Subject::class);
    }

    public function students()
    {
        $this->belongsToMany(Student::class)->withTimestamps();
    }
}
