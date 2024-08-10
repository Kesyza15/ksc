<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'nomor_telepon',
        'tanggal_pendaftaran',
        'pekerjaan',
        'jenis_kelamin',
    ];

    public function pinjamanAktif()
    {
        return $this->pinjaman()->where('status_pinjaman', Pinjaman::STATUS_BELUM_LUNAS)->exists();
    }
    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class);
    }
}
