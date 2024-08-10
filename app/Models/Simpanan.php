<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'anggota_id',
        'jenis_simpanan',
        'jumlah',
        'tanggal',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public static function totalSimpananWajibPerAnggota($anggotaId)
    {
        return self::where('anggota_id', $anggotaId)
                   ->where('jenis_simpanan', 'wajib')
                   ->sum('jumlah');
    }
}
