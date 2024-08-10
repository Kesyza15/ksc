<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - KSC</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Acme&family=Karla:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800&family=Leckerli+One&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: "Merriweather", sans-serif;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      background-color: #f8f9fa;
    }
    .wrapper {
      display: flex;
      flex: 1;
    }
    .sidebar {
      width: 250px;
      background-color: #343a40;
      color: #fff;
      flex-shrink: 0;
      padding: 15px;
      min-height: 100vh; /* Ensure the sidebar fills the height */
      height: auto; /* Adjust to content */
      transition: width 0.3s;
      display: flex;
      flex-direction: column;
      align-items: flex-start; /* Align items to the left */
    }
    .sidebar.collapsed {
      width: 0;
      padding: 0;
      overflow: hidden;
    }
    .sidebar a {
      color: #adb5bd;
      text-decoration: none;
      display: block;
      padding: 10px;
      border-radius: 5px;
      transition: background 0.3s, color 0.3s;
      width: 100%; /* Make links take full width */
      text-align: left; /* Align text to the left */
    }
    .sidebar a:hover {
      background-color: #495057;
      color: #fff;
    }
    .content {
      flex: 1;
      padding: 20px;
      background-color: #ffffff;
      border-left: 1px solid #dee2e6;
    }
    .navbar .navbar-brand {
      font-family: "Acme", sans-serif;
      font-size: 27px;
    }
    .navbar-custom {
      background-color: #28a745;
      color: #fff;
    }
    .navbar-custom .navbar-brand,
    .navbar-custom .navbar-brand:hover {
      color: #fff;
    }
    .footer {
      background-color: #343a40;
      color: #adb5bd;
      text-align: center;
      padding: 10px;
      width: 100%;
      margin-top: auto;
    }
    .toggle-sidebar-btn {
      cursor: pointer;
      background: none;
      border: none;
      color: #fff;
    }
    .navbar-nav .nav-item .nav-link {
      color: #fff;
    }
    .profile-sidebar {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
      justify-content: center;
      border-bottom: 1px solid #ddd;
    }
    .profile-userpic img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #fff; /* Optional: add a border around the image */
      margin-left: 10px;
      margin-bottom: 10px;
    }
    .profile-usertitle {
      margin-top: 5px;
      margin-left: 15px;
      margin-bottom: 10px;
    }
    .profile-usertitle-name {
      font-size: 18px;
      margin-bottom: 5px;
    }
    .profile-usertitle-status {
      font-size: 14px;
      color: #6c757d;
    }
    .sidebar a.submenu-toggle {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .submenu-toggle .fas.fa-caret-down {
      margin-left: auto;
    }
    .submenu {
      display: none;
      padding-left: 20px;
    }
    .submenu a {
      padding-left: 10px; /* Adjust to align submenu items */
    }
    .submenu.active {
      display: block;
    }
    .indicator {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      display: inline-block;
      margin-right: 5px;
    }
    .label-success {
      background-color: #28a745;
    }
    .label-warning {
      background-color: #ffc107;
    }
    /* Styling for Modal */
    .modal-content {
    font-family: 'Montserrat', sans-serif;
    }

    .modal-header {
    background-color: #28a745; /* Warna latar header */
    color: #fff; /* Warna teks header */
    border-bottom: none; /* Hapus garis bawah header */
    padding: 15px 20px; /* Padding header */
    }

    .modal-title {
    font-family: 'Acme', sans-serif; /* Font untuk judul modal */
    font-size: 24px; /* Ukuran font judul */
    }

    .modal-body {
    padding: 20px; /* Padding konten modal */
    }

    .modal-body h5 {
    font-family: 'Merriweather', serif; /* Font untuk judul konten */
    font-size: 20px; /* Ukuran font judul konten */
    font-weight: bold; /* Tebal font judul konten */
    margin-bottom: 15px; /* Jarak bawah judul konten */
    }

    .modal-body ul {
    list-style-type: disc; /* Gaya bullet list */
    padding-left: 20px; /* Padding kiri list */
    }

    .modal-body ul li {
    margin-bottom: 10px; /* Jarak antar item list */
    }

    .modal-footer {
    border-top: none; /* Hapus garis atas footer */
    padding: 15px 20px; /* Padding footer */
    background-color: #f8f9fa; /* Warna latar footer */
    }

    .btn-secondary {
    background-color: #6c757d; /* Warna latar tombol Tutup */
    color: #fff; /* Warna teks tombol Tutup */
    }

    .btn-secondary:hover {
    background-color: #495057; /* Warna latar tombol Tutup saat hover */
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-custom">
    <button class="toggle-sidebar-btn" onclick="toggleSidebar()">
      <i class="fas fa-bars"></i>
    </button>
    <a class="navbar-brand ml-2" href="#">Key Savings Coop.</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="#" data-toggle="modal" data-target="#aturanModal">
            <i class="fas fa-question-circle fa-lg"></i>
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Wrapper for Sidebar and Content -->
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <div class="profile-sidebar">
        <div class="profile-userpic">
          <img src="{{ asset('img/logo.png') }}" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
          @if (Auth::check())
            <div class="profile-usertitle-name">{{ Auth::user()->name }}</div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
          @else
            <div class="profile-usertitle-name">Guest</div>
            <div class="profile-usertitle-status"><span class="indicator label-warning"></span>Offline</div>
          @endif
        </div>
        <div class="clear"></div>
      </div>
      <a href="welcome"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
      <a href="{{ route('anggota.index') }}"><i class="fas fa-users"></i> Anggota</a>
      <a href="#" class="submenu-toggle"><i class="fas fa-cogs"></i> Simpanan <i class="fas fa-caret-down"></i></a>
      <div class="submenu" id="submenu">
        <a href="{{ route('simpanan-pokok.index') }}"><i class="fas fa-coins"></i> Simpanan Pokok</a>
        <a href="{{ route('simpanan-wajib.index') }}"><i class="fas fa-piggy-bank"></i> Simpanan Wajib</a>
        <a href="{{ route('tabungan.index') }}"><i class="fas fa-wallet"></i> Tabungan</a>
      </div>
      <a href="{{ route('pinjaman.index') }}"><i class="fas fa-money-bill"></i> Pinjaman</a>
      <a href="{{ route('login') }}">Logout <i class="fas fa-sign-out-alt"></i></a>
      <!-- Add more sidebar links here -->
    </div>

    <!-- Content -->
    <div class="content">
      @yield('content')
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <p style="margin-top: 15px">&copy; {{ date('Y') }} Key Savings Coop. All rights reserved.</p>
  </footer>

  <!-- Modal Aturan Koperasi -->
  <div class="modal fade" id="aturanModal" tabindex="-1" aria-labelledby="aturanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="aturanModalLabel">Aturan Koperasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h5>Syarat dan Ketentuan Koperasi:</h5>
            <ul>
              <li>Saat mendaftar, setiap anggota wajib membayar simpanan pokok sebesar 50.000 IDR yang tidak dapat ditarik.</li>
              <li>Anggota wajib membayar simpanan wajib sebesar 50.000 IDR setiap bulan yang tidak dapat ditarik.</li>
              <li>Anggota dapat melakukan tabungan secara bebas yang dapat ditarik kapan pun dibutuhkan.</li>
              <li>Pinjaman tersedia dengan minimal 1.000.000 IDR dan maksimal 9.000.000 IDR tanpa bunga. Keterlambatan pembayaran akan dikenakan denda sebesar 500.000 IDR untuk keterlambatan satu bulan, dengan penalti yang berlipat-lipat untuk keterlambatan yang lebih lama.</li>
              <li>Angsuran pinjaman dilakukan setiap bulan sebesar 1.000.000 IDR.</li>
            </ul>
        </div>          
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" title="Tutup">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    
  <script>
    $(document).ready(function() {
        $('#anggota_id').select2({
            placeholder: 'Pilih Anggota',
            allowClear: true
        });
    });
  </script>
  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('collapsed');
    }
    $(document).ready(function () {
      $('.submenu-toggle').click(function () {
        $(this).next('.submenu').toggleClass('active');
      });
    });
  </script>
</body>
</html>
