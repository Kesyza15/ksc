<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Models\Simpanan;
use App\Models\Pinjaman;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = Anggota::all();
        return view('user.anggota.index', compact('anggotas'));
    }

    public function create()
    {
        return view('user.anggota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:anggotas,nik',
            'nama' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'tanggal_pendaftaran' => 'required|date',
            'pekerjaan' => 'required',
            'jenis_kelamin' => 'required',
            'simpanan_pokok' => 'required|numeric',
        ]);

        $anggota = Anggota::create($request->all());

        Simpanan::create([
            'anggota_id' => $anggota->id,
            'jenis_simpanan' => 'pokok',
            'jumlah' => $request->simpanan_pokok,
            'tanggal' => $request->tanggal_pendaftaran,
        ]);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan');
    }

    public function show($id)
    {
        $anggota = Anggota::findOrFail($id);

        $simpananPokok = Simpanan::where('anggota_id', $id)
                                ->where('jenis_simpanan', 'pokok')
                                ->get();

        $simpananWajib = Simpanan::where('anggota_id', $id)
                                ->where('jenis_simpanan', 'wajib')
                                ->get();

        $totalTabungan = Simpanan::where('anggota_id', $id)
                                ->where('jenis_simpanan', 'tabungan')
                                ->sum('jumlah');

        $pinjamans = Pinjaman::where('anggota_id', $anggota->id)->get();

        $totalPinjaman = $pinjamans->sum('jumlah_pinjaman');

        return view('user.anggota.show', compact('anggota', 'simpananPokok', 'simpananWajib', 'totalTabungan', 'totalPinjaman'));
    }

    public function edit(Anggota $anggota)
    {
        return view('user.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $request->validate([
            'nik' => 'required|unique:anggotas,nik,' . $anggota->id,
            'nama' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'tanggal_pendaftaran' => 'required|date',
            'pekerjaan' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        $anggota->update($request->all());

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil diperbarui');
    }

    public function destroy(Anggota $anggota)
    {
        $simpananPokokExists = Simpanan::where('anggota_id', $anggota->id)
                                        ->where('jenis_simpanan', 'pokok')
                                        ->exists();

        if ($simpananPokokExists) {
            return redirect()->route('anggota.index')->with('error', 'Anggota tidak dapat dihapus karena memiliki simpanan pokok.');
        }

        $anggota->delete();
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus');
    }
}
