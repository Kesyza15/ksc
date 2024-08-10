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
                        <h1>Daftar Pinjaman</h1>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <a href="{{ route('pinjaman.create') }}" class="btn btn-primary mb-3" title="Ajukan Pinjaman Baru"><i class="fas fa-plus"></i>  Ajukan Pinjaman Baru</a>

                        <table class="table table-bordered table-striped">
                            <thead style="text-align: center">
                                <tr>
                                    <th>No</th>
                                    <th>Anggota</th>
                                    <th>Jumlah Pinjaman</th>
                                    <th>Tanggal Jatuh Tempo</th>
                                    <th>Angsuran per Bulan</th> 
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pinjamans as $pinjaman)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pinjaman->anggota->nama }}</td>
                                        <td style="text-align: center">Rp {{ number_format($pinjaman->jumlah_pinjaman, 0, ',', '.') }}</td>
                                        <td style="text-align: center">{{ \Carbon\Carbon::parse($pinjaman->tanggal_jatuh_tempo)->translatedFormat('d F Y') }}</td>
                                        <td style="text-align: center">
                                            @php
                                                $tanggal_pinjaman = \Carbon\Carbon::parse($pinjaman->tanggal_pinjaman);
                                                $tanggal_jatuh_tempo = \Carbon\Carbon::parse($pinjaman->tanggal_jatuh_tempo);
                                                $bulan_harus_lunas = $tanggal_pinjaman->diffInMonths($tanggal_jatuh_tempo);
                                            @endphp
                                            @if ($bulan_harus_lunas > 0)
                                                Rp {{ number_format($pinjaman->jumlah_pinjaman / $bulan_harus_lunas, 0, ',', '.') }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td style="text-align: center">{{ $pinjaman->status_pinjaman }}</td>
                                        <td>
                                            <a href="{{ route('angsuran.create', $pinjaman->id) }}" class="btn btn-success btn-sm" title="Angsuran"><i class="fas fa-plus-circle"></i></a>
                                            <a href="{{ route('pinjaman.show', $pinjaman->id) }}" class="btn btn-info btn-sm" title="Detail Pinjaman"><i class="fa fa-info-circle"></i></a>
                                        </td>
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
