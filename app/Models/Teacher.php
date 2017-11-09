<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class Teacher extends Model
{
    protected $fillable = ['name', 'birthday', 'address', 'phone', 'email',];

    public function schoolClasses(){
        $this->hasMany(SchoolClass::class);
    }
}
