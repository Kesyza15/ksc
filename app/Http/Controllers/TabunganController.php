<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simpanan;
use App\Models\Anggota;

class TabunganController extends Controller
{
    public function index()
    {
        $anggotas = Anggota::all();
        $totalTabungan = [];

        foreach ($anggotas as $anggota) {
            $totalSimpananWajib = Simpanan::totalSimpananWajibPerAnggota($anggota->id);

            $totalTabunganAnggota = Simpanan::where('anggota_id', $anggota->id)
                ->where('jenis_simpanan', 'tabungan')
                ->sum('jumlah');

            $totalTabungan[$anggota->id] = [
                'totalTabungan' => $totalTabunganAnggota,
            ];
        }

        return view('user.simpanan.tabungan.index', compact('anggotas', 'totalTabungan'));
    }

    public function create($anggota_id)
    {
        $anggota = Anggota::findOrFail($anggota_id); 
        return view('user.simpanan.tabungan.create', compact('anggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        Simpanan::create([
            'anggota_id' => $request->anggota_id,
            'jenis_simpanan' => 'tabungan',
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('tabungan.index')
            ->with('success', 'Tabungan berhasil ditambahkan.');
    }

    public function show($anggota_id)
    {
        $tabungans = Simpanan::where('anggota_id', $anggota_id)
            ->where('jenis_simpanan', 'tabungan')
            ->get();
        
        return view('user.simpanan.tabungan.show', compact('tabungans'));
    }

    public function withdraw($anggota_id)
    {
        $anggota = Anggota::findOrFail($anggota_id);
        return view('user.simpanan.tabungan.withdraw', compact('anggota'));
    }

    public function processWithdraw(Request $request, $anggota_id)
    {
        $request->validate([
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        $anggota = Anggota::findOrFail($anggota_id);
        $totalTabunganAnggota = Simpanan::where('anggota_id', $anggota_id)
            ->where('jenis_simpanan', 'tabungan')
            ->sum('jumlah');

        if ($request->jumlah > $totalTabunganAnggota) {
            return redirect()->back()->with('error', 'Tabungan Anda tidak mencukupi untuk melakukan penarikan.');
        }

        Simpanan::create([
            'anggota_id' => $anggota_id,
            'jenis_simpanan' => 'tabungan',
            'jumlah' => -$request->jumlah, 
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('tabungan.index')
            ->with('success', 'Penarikan tabungan berhasil dilakukan.');
    }
}
