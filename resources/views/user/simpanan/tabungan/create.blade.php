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
                        <h1>Tambah Tabungan - {{ $anggota->nama }}</h1>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form action="{{ route('tabungan.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="anggota_id" value="{{ $anggota->id }}">
                            <div class="form-group">
                                <label for="jumlah">Jumlah Tabungan</label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" required>
                                @error('jumlah')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                            <button type="submit" class="btn btn-primary" title="Simpan">Simpan</button>
                            <button type="reset" class="btn btn-danger" title="Reset">Reset</button>
                            <a href="{{ route('tabungan.index') }}" class="btn btn-secondary" title="Kembali">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
