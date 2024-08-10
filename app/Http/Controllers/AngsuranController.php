<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjaman;
use App\Models\Angsuran;
use Carbon\Carbon;

class AngsuranController extends Controller
{
    public function create($pinjaman_id)
    {
        $pinjaman = Pinjaman::findOrFail($pinjaman_id);
        $jumlah_pinjaman = $pinjaman->jumlah_pinjaman;
        $tanggal_pinjaman = Carbon::parse($pinjaman->tanggal_pinjaman);
        $tanggal_jatuh_tempo = Carbon::parse($pinjaman->tanggal_jatuh_tempo);
        $bulan_harus_lunas = $tanggal_pinjaman->diffInMonths($tanggal_jatuh_tempo);
        $jumlah_angsuran = $bulan_harus_lunas > 0 ? $jumlah_pinjaman / $bulan_harus_lunas : 0;

        return view('user.angsuran.create', compact('pinjaman', 'jumlah_angsuran'));
    }

    public function store(Request $request, $pinjaman_id)
    {
        $request->validate([
            'jumlah_angsuran' => 'required|numeric',
            'tanggal_angsuran' => 'required|date',
            'denda' => 'nullable|numeric',
        ]);

        $pinjaman = Pinjaman::findOrFail($pinjaman_id);

        $tanggal_jatuh_tempo = Carbon::parse($pinjaman->tanggal_jatuh_tempo);

        $tanggal_angsuran = Carbon::parse($request->tanggal_angsuran);

        $bulan_telat = $tanggal_angsuran>$tanggal_jatuh_tempo;

        $denda = 0;

        if ($bulan_telat > 0) {
            // Denda 500,000 per bulan telat
            $denda = $bulan_telat * 500000;
        }

        if ($request->has('denda')) {
            $denda = $request->denda;
        }

        $tanggal_pinjaman = Carbon::parse($pinjaman->tanggal_pinjaman);
        $tanggal_jatuh_tempo = Carbon::parse($pinjaman->tanggal_jatuh_tempo);
        $bulan_harus_lunas = $tanggal_pinjaman->diffInMonths($tanggal_jatuh_tempo);
        $jumlah_angsuran = $pinjaman->jumlah_pinjaman / $bulan_harus_lunas;

        $angsuran = new Angsuran();
        $angsuran->pinjaman_id = $pinjaman->id;
        $angsuran->jumlah_angsuran = $request->jumlah_angsuran;
        $angsuran->tanggal_angsuran = $request->tanggal_angsuran;
        $angsuran->denda = $denda;
        $angsuran->save();

        if ($pinjaman->status_pinjaman != 'lunas' && $pinjaman->isLunas()) {
            $pinjaman->status_pinjaman = 'lunas';
            $pinjaman->save();
        }

        return redirect()->back()->with('success', 'Angsuran berhasil ditambahkan.');
    }
}