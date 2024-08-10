<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjaman;
use App\Models\Anggota;
use DateTime;
use Illuminate\Support\Facades\DB;

class PinjamanController extends Controller
{
    public function index()
    {
        $pinjamans = Pinjaman::with('anggota')->get();
        return view('user.pinjaman.index', compact('pinjamans'));
    }

    public function create()
    {
        $anggotas = Anggota::all();
        return view('user.pinjaman.create', compact('anggotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'jumlah_pinjaman' => 'required|numeric|min:1|max:9000000',
            'bulan_angsuran' => 'required|numeric|min:1|max:12',
            'tanggal_pinjaman' => 'required|date_format:Y-m-d',
        ]);

        $anggota = Anggota::findOrFail($request->anggota_id);
        $activeLoan = $anggota->pinjamanAktif();

        if ($activeLoan) {
            return redirect()->back()->withErrors(['error' => 'Anggota ini masih memiliki pinjaman yang aktif.']);
        }

        try {
            DB::beginTransaction();

            $jumlahPinjaman = $request->jumlah_pinjaman;
            $bulanAngsuran = $request->bulan_angsuran;
            $tanggalPinjaman = $request->tanggal_pinjaman;
            
            $tanggalJatuhTempo = new DateTime($tanggalPinjaman);
            $tanggalJatuhTempo->modify("+{$bulanAngsuran} months");
            $formattedTanggalJatuhTempo = $tanggalJatuhTempo->format('Y-m-d');

            Pinjaman::create([
                'anggota_id' => $request->anggota_id,
                'jumlah_pinjaman' => $jumlahPinjaman,
                'tanggal_pinjaman' => $tanggalPinjaman,
                'tanggal_jatuh_tempo' => $formattedTanggalJatuhTempo,
                'status_pinjaman' => 'aktif', 
            ]);

            DB::commit();

            return redirect()->route('pinjaman.index')->with('success', 'Pinjaman berhasil diajukan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);
        return view('user.pinjaman.show', compact('pinjaman'));
    }
}
