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
                        <h1>Daftar Anggota</h1>
                        <a href="{{ route('anggota.create') }}" class="btn btn-primary btn-sm float-end" title="Tambah Data"><i class="fas fa-plus"></i> Tambah Anggota</a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <table class="table table-bordered">
                            <thead style="text-align: center">
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Pekerjaan</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anggotas as $anggota)
                                    <tr>
                                        <td style="text-align: center">{{ $loop->iteration }}</td>
                                        <td>{{ $anggota->nik }}</td>
                                        <td>{{ $anggota->nama }}</td>
                                        <td>{{ $anggota->pekerjaan }}</td>
                                        <td style="text-align: center">{{ $anggota->jenis_kelamin }}</td>
                                        <td style="text-align: center">
                                            <a href="{{ route('anggota.show', $anggota->id) }}" class="btn btn-info btn-sm" title="Detail Anggota"><i class="fa fa-info-circle"></i></a>
                                            <a href="{{ route('anggota.edit', $anggota->id) }}" class="btn btn-warning btn-sm" title="Edit Anggota"><i class="fas fa-pen"></i></a>
                                            <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')" title="Hapus Anggota"><i class="fas fa-trash"></i></button>
                                            </form>
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
