@extends('user.dashboard')

@section('content')
    <style>
        h1 {
            font-family: "Acme", sans-serif;
        }

        .detail-box {
            margin-bottom: 20px;
        }

        h2 {
            font-family: "Acme", sans-serif;
        }

        .detail-box h2 {
            margin-top: 20px;
        }

        .keterangan {
            text-align: center;
            color: black; /* Warna teks hitam untuk keterangan */
        }

        .kredit {
            color: black; /* Warna teks hitam untuk keterangan kredit */
        }
    </style>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card detail-box">
                    <div class="card-header">
                        <h1>Detail Tabungan</h1>
                    </div>
                    <div class="card-body">
                        @if ($tabungans->isEmpty())
                            <p>Belum ada tabungan yang ditambahkan.</p>
                        @else
                            <table class="table table-bordered">
                                <thead style="text-align: center">
                                    <tr>
                                        <th>No</th>
                                        <th>Jumlah</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tabungans as $tabungan)
                                        <tr>
                                            <td style="text-align: center">{{ $loop->iteration }}</td>
                                            <td style="text-align: center">
                                                @if ($tabungan->jumlah < 0)
                                                    <span class="kredit">Rp {{ number_format(-$tabungan->jumlah, 0, ',', '.') }}</span>
                                                @else
                                                    Rp {{ number_format($tabungan->jumlah, 0, ',', '.') }}
                                                @endif
                                            </td>
                                            <td style="text-align: center">{{ \Carbon\Carbon::parse($tabungan->tanggal)->translatedFormat('d F Y') }}</td>
                                            <td style="text-align: center" class="keterangan {{ $tabungan->jumlah < 0 ? 'kredit' : '' }}">
                                                {{ $tabungan->jumlah < 0 ? 'Kredit' : 'Debit' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p><strong>Total Tabungan:</strong> Rp {{ number_format($tabungans->sum('jumlah'), 0, ',', '.') }}</p>
                        @endif
                    </div>
                </div>

                <a href="{{ route('tabungan.index') }}" class="btn btn-secondary" title="Kembali">Kembali</a>
            </div>
        </div>
    </div>
@endsection
