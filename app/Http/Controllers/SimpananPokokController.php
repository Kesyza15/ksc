<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simpanan;

class SimpananPokokController extends Controller
{
    public function index()
    {
        $simpanans = Simpanan::where('jenis_simpanan', 'pokok')->get();
        return view('user.simpanan.pokok.index', compact('simpanans'));
    }

    public function create()
    {
        return view('simpanan.pokok.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        Simpanan::create([
            'anggota_id' => $request->anggota_id,
            'jenis_simpanan' => 'pokok',
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('simpanan-pokok.index');
    }
}
