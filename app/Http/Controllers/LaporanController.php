<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SimpananPokok;
use App\Models\SimpananWajib;
use App\Models\Tabungan;
use App\Models\Pinjaman;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil jenis laporan yang dipilih dari request
        $jenisLaporan = $request->jenis_laporan;

        // Ambil data berdasarkan jenis laporan
        switch ($jenisLaporan) {
            case 'simpanan_pokok':
                $data = SimpananPokok::all();
                break;
            case 'simpanan_wajib':
                $data = SimpananWajib::all();
                break;
            case 'tabungan':
                $data = Tabungan::all();
                break;
            case 'pinjaman':
                $data = Pinjaman::all();
                break;
            default:
                $data = [];
                break;
        }

        // Kirim data ke view laporan
        return view('laporan.index', [
            'data' => $data,
            'jenisLaporan' => $jenisLaporan,
        ]);
    }
}
