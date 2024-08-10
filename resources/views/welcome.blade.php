@extends('user.dashboard')

@section('content')
    <style>
        .card-header {
            font-family: "Acme", sans-serif;
        }
        
        .card-body {
            padding: 1.5rem; 
        }
        
        .card-body a.btn {
            width: 100%; 
        }
        
        .card-header-icon {
            font-size: 1.5rem; 
            margin-right: 0.5rem; 
        }
        
        .card-title {
            font-size: 1.1rem; 
            margin-bottom: 0; 
        }
    </style>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <p>Selamat datang, {{ Auth::user()->name }}!</p>
        
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-success">
                    <div class="card-header">
                        <i class="fas fa-coins card-header-icon"></i>
                        <span class="card-title">Simpanan Pokok</span>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('simpanan-pokok.index') }}" class="btn btn-outline-light">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-primary">
                    <div class="card-header">
                        <i class="fas fa-piggy-bank card-header-icon"></i>
                        <span class="card-title">Simpanan Wajib</span>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('simpanan-wajib.index') }}" class="btn btn-outline-light">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-warning">
                    <div class="card-header">
                        <i class="fas fa-wallet card-header-icon"></i>
                        <span class="card-title">Tabungan</span>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('tabungan.index') }}" class="btn btn-outline-light">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-4">
                <div class="card text-white bg-info">
                    <div class="card-header">
                        <i class="fas fa-money-bill card-header-icon"></i>
                        <span class="card-title">Pinjaman</span>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('pinjaman.index') }}" class="btn btn-outline-light">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tabel Data {{ Auth::user()->name }}</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ Auth::user()->name }}</td>
                                        <td>{{ Auth::user()->email }}</td>
                                        <td>Admin</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
