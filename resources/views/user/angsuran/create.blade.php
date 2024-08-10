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
                    <h1>Tambah Angsuran</h1>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('angsuran.store', $pinjaman->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="jumlah_angsuran">Jumlah Angsuran</label>
                            @php
                                $tanggal_pinjaman = \Carbon\Carbon::parse($pinjaman->tanggal_pinjaman);
                                $tanggal_jatuh_tempo = \Carbon\Carbon::parse($pinjaman->tanggal_jatuh_tempo);
                                $bulan_harus_lunas = $tanggal_pinjaman->diffInMonths($tanggal_jatuh_tempo);
                            @endphp
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" name="jumlah_angsuran" id="jumlah_angsuran" class="form-control" value="{{ old('jumlah_angsuran') ?? $pinjaman->jumlah_pinjaman / $bulan_harus_lunas }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_angsuran">Tanggal Angsuran</label>
                            <input type="date" name="tanggal_angsuran" id="tanggal_angsuran" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary" title="Tambah Angsuran">Tambah</button>
                        <button type="reset" class="btn btn-danger" title="Reset">Reset</button>
                        <a href="{{ route('pinjaman.index') }}" class="btn btn-secondary" title="Kembali">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
