<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserRegionalModel extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'user_regional';

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $fillable = [
        'username',
        'email',
        'password',
        'job_title',
        'role',
        'last_login'
    ];
}
