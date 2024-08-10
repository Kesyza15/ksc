<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{
    use HasFactory;

    protected $fillable = [
        'pinjaman_id',
        'jumlah_angsuran',
        'tanggal_angsuran',
        'denda'
    ];

    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class);
    }
}
