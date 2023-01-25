<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserPicModel extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'user_pic';
    protected $fillable = [
        'name',
        'email',
        'password',
        'notel',
        'regional',
        'witel',
        'datel',
        'url',
        'last_login',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
