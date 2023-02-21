<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriPromosiModel extends Model
{
    use HasFactory;
    protected $table = 'materi_promosi';
    protected $fillable = [
        'nama_program',
        'link',
        'periode_rilis',
        'tahun',
        'berlaku_hingga',
        'createdby'
    ];
}
