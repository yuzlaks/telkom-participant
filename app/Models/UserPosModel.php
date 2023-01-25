<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserPosModel extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'user_pos';
    protected $fillable = [
        'nama',
        'email',
        'password',
        'notel',
        'pic_id',
        'pic_name',
        'alamat',
        'kecamatan',
        'kabupaten',
        'url',
        'last_login'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
