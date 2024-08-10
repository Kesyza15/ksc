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
                        <h1>Daftar Tabungan</h1>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <table class="table table-bordered">
                            <thead style="text-align: center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Nomor Telepon</th>
                                    <th>Total Tabungan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anggotas as $anggota)
                                    <tr>
                                        <td style="text-align: center">{{ $loop->iteration }}</td>
                                        <td>{{ $anggota->nama }}</td>
                                        <td>{{ $anggota->alamat }}</td>
                                        <td>{{ $anggota->nomor_telepon }}</td>
                                        <td style="text-align: center">
                                            Rp {{ number_format($totalTabungan[$anggota->id]['totalTabungan'], 0, ',', '.') }}
                                        </td>
                                        <td style="text-align: center">
                                            <a href="{{ route('tabungan.create', ['anggota_id' => $anggota->id]) }}" class="btn btn-primary btn-sm" title="Tambah Tabungan">
                                                <i class="fa fa-plus"></i> 
                                            </a>
                                            <a href="{{ route('tabungan.show', ['anggota_id' => $anggota->id]) }}" class="btn btn-info btn-sm" title="Detail Tabungan">
                                                <i class="fa fa-info-circle"></i> 
                                            </a>
                                            <a href="{{ route('tabungan.withdraw', ['anggota_id' => $anggota->id]) }}" class="btn btn-warning btn-sm" title="Tarik Uang">
                                                <i class="fa fa-money-bill"></i> 
                                            </a>                                            
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
