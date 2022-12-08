<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    use HasFactory;
    protected $table = "pegawai";
    // public $table = "pegawais";
    protected $fillable = [
        'id ',
        'nama',
        'npwp',
        'alamat',
        'gender',
        'telepon',
        'tgl_lahir',
        'jabatan',
        'bidang',
        'avatar',
    ];
}
