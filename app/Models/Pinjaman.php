<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'anggota_id',
        'jumlah_pinjaman',
        'tanggal_pinjaman',
        'tanggal_jatuh_tempo',
        'status_pinjaman'
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function isLunas()
    {
        return $this->angsurans()->sum('jumlah_angsuran') >= $this->jumlah_pinjaman;
    }

    public function angsurans()
    {
        return $this->hasMany(Angsuran::class);
    }

    const STATUS_BELUM_LUNAS = 'aktif';
    const STATUS_LUNAS = 'lunas';
}
