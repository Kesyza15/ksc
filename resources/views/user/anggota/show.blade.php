@extends('user.dashboard')

@section('content')
<style>
    h1,
    h2 {
        font-family: "Acme", sans-serif;
    }

    .detail-box {
        margin-bottom: 20px;
    }

    .detail-box h2 {
        margin-top: 20px;
    }
</style>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card detail-box">
                <div class="card-header">
                    <h1>Detail Anggota</h1>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>NIK:</strong> {{ $anggota->nik }}</p>
                            <p><strong>Nama:</strong> {{ $anggota->nama }}</p>
                            <p><strong>Alamat:</strong> {{ $anggota->alamat }}</p>
                            <p><strong>Nomor Telepon:</strong> {{ $anggota->nomor_telepon }}</p>
                            <p><strong>Tanggal Pendaftaran:</strong> {{ \Carbon\Carbon::parse($anggota->tanggal_pendaftaran)->translatedFormat('d F Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Pekerjaan:</strong> {{ $anggota->pekerjaan }}</p>
                            <p><strong>Jenis Kelamin:</strong> {{ $anggota->jenis_kelamin }}</p>
                            @if ($simpananPokok->isEmpty())
                                <p>Belum ada simpanan pokok yang dibayarkan.</p>
                            @else
                                <p><strong>Simpanan Pokok:</strong> Rp {{ number_format($simpananPokok->sum('jumlah'), 0, ',', '.') }}</p>
                            @endif
                            @if ($totalTabungan > 0)
                                <p><strong>Total Tabungan:</strong> Rp {{ number_format($totalTabungan, 0, ',', '.') }}</p>
                            @else
                                <p>Belum ada tabungan yang dilakukan.</p>
                            @endif
                            @if ($totalPinjaman > 0)
                                <p><strong>Total Pinjaman:</strong> Rp {{ number_format($totalPinjaman, 0, ',', '.') }}</p>
                            @else
                                <p>Belum ada pinjaman yang dilakukan.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="card detail-box">
                <div class="card-header">
                    <h2>Detail Simpanan Wajib</h2>
                </div>
                <div class="card-body">
                    @if ($simpananWajib->isEmpty())
                        <p>Belum ada simpanan wajib yang dibayarkan.</p>
                    @else
                        <ul>
                            @foreach ($simpananWajib as $simpanan)
                                <li>Rp {{ number_format($simpanan->jumlah, 0, ',', '.') }} - {{ \Carbon\Carbon::parse($simpanan->tanggal)->translatedFormat('d F Y') }}</li>
                            @endforeach
                        </ul>
                        <p><strong>Total Simpanan Wajib:</strong> Rp {{ number_format($simpananWajib->sum('jumlah'), 0, ',', '.') }}</p>
                    @endif
                </div>
            </div>

            <a href="{{ route('anggota.index') }}" class="btn btn-secondary" title="Kembali">Kembali</a>
        </div>
    </div>
</div>
@endsection
