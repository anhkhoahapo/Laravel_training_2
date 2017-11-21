<?php

namespace App\Models;

use App\Notifications\TeacherResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class Teacher extends Authenticatable
{
    use Notifiable;

    protected $guard = 'teacher';

    protected $fillable = ['teacher_id', 'password', 'name', 'birthday', 'avatar', 'email',];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function schoolClasses(){
        return $this->hasMany(SchoolClass::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new TeacherResetPasswordNotification($token));
    }
}
