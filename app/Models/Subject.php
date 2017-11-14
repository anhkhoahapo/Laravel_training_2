<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $updated_at
 */
class Subject extends Model
{
    protected $fillable = ['name', 'credit',];

    public function schoolClasses(){
        return $this->hasMany(SchoolClass::class);
    }
}
