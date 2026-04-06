<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'nomor_telp',
        'nomor_identitas',
        'nama_instansi',
        'email',
        'pengaduan',
        'status',
    ];
}
