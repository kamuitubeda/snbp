<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayaTampung extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode', 'nama_universitas', 'jenjang', 'bidang', 'tahun', 'peminat', 'daya_tampung', 'peluang', 'keketatan'
    ];
}
