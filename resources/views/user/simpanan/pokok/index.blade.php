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
                        <h1>Simpanan Pokok</h1>
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
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($simpanans as $simpanan)
                                    <tr>
                                        <td style="text-align: center">{{ $loop->iteration }}</td>
                                        <td>{{ $simpanan->anggota->nama }}</td>
                                        <td style="text-align: center">Rp {{ number_format($simpanan->jumlah, 0, ',', '.') }}</td>
                                        <td style="text-align: center">{{ \Carbon\Carbon::parse($simpanan->first_paid_at)->translatedFormat('d F Y') }}</td>
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
