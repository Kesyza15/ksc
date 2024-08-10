@extends('user.dashboard')

@section('content')
    <style>
        h1 {
            font-family: "Acme", sans-serif;
        }
    </style>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Daftar Simpanan Wajib</h1>
                        <a href="{{ route('simpanan-wajib.create') }}" class="btn btn-primary btn-sm" title="Tambah Simpanan Wajib"><i class="fas fa-plus"></i> Tambah Simpanan Wajib</a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <table class="table table-bordered">
                            <thead style="text-align: center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Anggota</th>
                                    <th>Total Simpanan Wajib</th>
                                    <th>Bulan</th>
                                    <th>Tanggal Bayar Awal</th> <!-- Kolom baru -->
                                    <th>Tanggal Bayar Terakhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($simpanans as $simpanan)
                                    <tr>
                                        <td style="text-align: center">{{ $loop->iteration }}</td>
                                        <td>{{ $simpanan->anggota->nama }}</td>
                                        <td>Rp {{ number_format($simpanan->total_simpanan_wajib, 0, ',', '.') }}</td>
                                        <td>{{ floor($simpanan->total_simpanan_wajib / 50000) }} bulan</td>
                                        <td>
                                            @if ($simpanan->first_paid_at)
                                                {{ \Carbon\Carbon::parse($simpanan->first_paid_at)->translatedFormat('d F Y') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($simpanan->last_paid_at)->translatedFormat('d F Y') }}</td>
                                    </tr>
                                @endforeach                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
