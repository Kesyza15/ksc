<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simpanan;
use App\Models\Anggota;
use Carbon\Carbon;

class SimpananWajibController extends Controller
{
    public function index()
    {
        $simpanans = Simpanan::selectRaw('anggota_id, sum(jumlah) as total_simpanan_wajib, max(tanggal) as last_paid_at, min(tanggal) as first_paid_at')
                            ->where('jenis_simpanan', 'wajib')
                            ->groupBy('anggota_id')
                            ->with('anggota') // Load relationships to avoid N+1 queries
                            ->get();

        return view('user.simpanan.wajib.index', compact('simpanans'));
    }

    public function create()
    {
        $anggotas = Anggota::all();

        $simpanans = Simpanan::selectRaw('anggota_id, max(tanggal) as last_paid_at')
                            ->where('jenis_simpanan', 'wajib')
                            ->groupBy('anggota_id')
                            ->get();

        return view('user.simpanan.wajib.create', compact('anggotas', 'simpanans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'jumlah' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        $requestDate = Carbon::parse($request->tanggal);

        $existingPayment = Simpanan::where('anggota_id', $request->anggota_id)
                                ->where('jenis_simpanan', 'wajib')
                                ->whereYear('tanggal', $requestDate->year)
                                ->whereMonth('tanggal', $requestDate->month)
                                ->exists();

        if ($existingPayment) {
            $anggota = Anggota::find($request->anggota_id);
            return redirect()->back()->with('error', 'Anggota ' . $anggota->nama . ' sudah melakukan Simpanan Wajib pada bulan ini.');
        }

        $lastPayment = Simpanan::where('anggota_id', $request->anggota_id)
                               ->where('jenis_simpanan', 'wajib')
                               ->orderBy('tanggal', 'desc')
                               ->first();

        if ($lastPayment) {
            $lastPaymentDate = Carbon::parse($lastPayment->tanggal);

            if ($requestDate->diffInMonths($lastPaymentDate) > 1) {
                return redirect()->back()->with('error', 'Simpanan Wajib bulan ' . $lastPaymentDate->addMonth()->translatedFormat('F Y') . ' belum dibayar.');
            }
        }

        Simpanan::create([
            'anggota_id' => $request->anggota_id,
            'jenis_simpanan' => 'wajib',
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('simpanan-wajib.index')->with('success', 'Simpanan Wajib berhasil ditambahkan.');
    }
}
