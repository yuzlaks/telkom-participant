<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosModel extends Model
{
    use HasFactory;
    protected $table = 'pos';
    protected $fillable = [
        'regional',
        'witel',
        'datel',
        'order_name',
        'order_email',
        'notel',
        'alamat',
        'kecamatan',
        'kabupaten',
        'tgl_order',
        'pos_id',
        'pos_name'
    ];
}
