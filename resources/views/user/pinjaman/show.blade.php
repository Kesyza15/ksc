@extends('user.dashboard')

@section('content')
<style>
    h1,
    h2 {
        font-family: "Acme", sans-serif;
    }
</style>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Detail Pinjaman</h1>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table table-striped">
                        <tr>
                            <th>Anggota</th>
                            <td>{{ $pinjaman->anggota->nama }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Pinjaman</th>
                            <td>Rp {{ number_format($pinjaman->jumlah_pinjaman, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Pinjaman</th>
                            <td>{{ \Carbon\Carbon::parse($pinjaman->tanggal_pinjaman)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Jatuh Tempo</th>
                            <td>{{ \Carbon\Carbon::parse($pinjaman->tanggal_jatuh_tempo)->translatedFormat('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Status Pinjaman</th>
                            <td>{{ $pinjaman->status_pinjaman }}</td>
                        </tr>
                    </table>

                    <h2>Daftar Angsuran</h2>
                    <table class="table table-striped">
                        <thead style="text-align: center">
                            <tr>
                                <th>Angsuran Ke-</th>
                                <th>Jumlah Angsuran</th>
                                <th>Tanggal Angsuran</th>
                                <th>Denda</th>
                                <th>Total Bayar</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center">
                            @php
                                $totalPaid = 0;
                            @endphp
                            @foreach ($pinjaman->angsurans as $angsuran)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>Rp {{ number_format($angsuran->jumlah_angsuran, 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($angsuran->tanggal_angsuran)->translatedFormat('d F Y') }}</td>
                                    <td>Rp {{ number_format($angsuran->denda ?? 0, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($angsuran->jumlah_angsuran + ($angsuran->denda ?? 0), 0, ',', '.') }}</td>
                                </tr>
                                @php
                                    $totalPaid += $angsuran->jumlah_angsuran + ($angsuran->denda ?? 0);
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4"><strong>Total Pinjaman Dibayarkan:</strong></td>
                                <td><strong>Rp {{ number_format($totalPaid, 0, ',', '.') }}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="4"><strong>Total Pinjaman Tersisa:</strong></td>
                                <td><strong>Rp {{ number_format($pinjaman->jumlah_pinjaman - $pinjaman->angsurans->sum('jumlah_angsuran'), 0, ',', '.') }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    
                    <a href="{{ route('pinjaman.index') }}" class="btn btn-secondary" title="Kembali">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection