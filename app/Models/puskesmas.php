<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class puskesmas extends Model
{
    protected $table = "tbl_puskesmas";
    protected $fillable = [
        'kode_puskesmas',
        'nama',
        'alamat',
        'admin_id'
    ];

    use HasFactory;
}
