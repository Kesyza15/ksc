@extends('user.dashboard')

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#anggota_id').select2({
                placeholder: 'Pilih Anggota',
                allowClear: true
            });

            $('#jumlah_pinjaman').on('input', function() {
                updateTanggalJatuhTempo();
            });

            $('#bulan_angsuran').on('input', function() {
                updateTanggalJatuhTempo();
            });

            $('#tanggal_pinjaman').on('change', function() {
                updateTanggalJatuhTempo();
            });

            // Function to update Tanggal Jatuh Tempo based on Jumlah Pinjaman and Tanggal Pinjaman
            function updateTanggalJatuhTempo() {
                var jumlahPinjaman = parseFloat($('#jumlah_pinjaman').val());
                var bulanAngsuran = parseFloat($('#bulan_angsuran').val());

                // Jika bulan angsuran diisi secara manual, gunakan nilainya
                if (!isNaN(bulanAngsuran) && bulanAngsuran >= 1 && bulanAngsuran <= 12) {
                    $('#bulan_angsuran').val(bulanAngsuran); // Update nilai input bulan_angsuran
                } else {
                    bulanAngsuran = Math.ceil(jumlahPinjaman / 1000000); // Hitung jumlah bulan angsuran dari jumlah pinjaman
                    $('#bulan_angsuran').val(bulanAngsuran); // Update nilai input bulan_angsuran
                }

                if (jumlahPinjaman > 0 && jumlahPinjaman <= 9000000) {
                    var tanggalPinjaman = new Date($('#tanggal_pinjaman').val());
                    if (!isNaN(tanggalPinjaman)) {
                        var jatuhTempo = new Date(tanggalPinjaman);

                        // Setelah mendapatkan bulan angsuran, atur tanggal jatuh tempo
                        jatuhTempo.setMonth(jatuhTempo.getMonth() + bulanAngsuran);
                        $('#tanggal_jatuh_tempo').val(jatuhTempo.toISOString().split('T')[0]);
                    }
                } else {
                    $('#tanggal_jatuh_tempo').val('');
                }
            }
        });
    </script>    

    <style>
        h1 {
            font-family: "Acme", sans-serif;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .select2-container--default .select2-selection--single {
            height: calc(1.5em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 1.5;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(1.5em + 0.75rem + 2px);
        }
    </style>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1>Ajukan Pinjaman Baru</h1>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('pinjaman.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="anggota_id" class="form-label">Anggota</label>
                                <select name="anggota_id" id="anggota_id" class="form-control">
                                    <option></option>
                                    @foreach ($anggotas as $anggota)
                                        <option value="{{ $anggota->id }}">{{ $anggota->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_pinjaman" class="form-label">Jumlah Pinjaman</label>
                                <input type="number" name="jumlah_pinjaman" id="jumlah_pinjaman" class="form-control" min="1000000" max="9000000" required>
                            </div>
                            <div class="form-group">
                                <label for="bulan_angsuran" class="form-label">Bulan Angsuran</label>
                                <input type="number" name="bulan_angsuran" id="bulan_angsuran" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_pinjaman" class="form-label">Tanggal Pinjaman</label>
                                <input type="date" name="tanggal_pinjaman" id="tanggal_pinjaman" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_jatuh_tempo" class="form-label">Tanggal Jatuh Tempo</label>
                                <input type="date" name="tanggal_jatuh_tempo" id="tanggal_jatuh_tempo" class="form-control" readonly>
                            </div>
                            <button type="submit" class="btn btn-primary" title="Ajukan">Ajukan</button>
                            <button type="reset" class="btn btn-danger" title="Reset">Reset</button>
                            <a href="{{ route('pinjaman.index') }}" class="btn btn-secondary" title="Kembali">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
