<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guard = 'admin';

    protected $fillable = ['username', 'password', 'name', 'birthday', 'avatar', 'email',];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
