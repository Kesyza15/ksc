<!DOCTYPE html>
<html>
<head>
    <title>Login - KSC</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Acme&family=Karla:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800&family=Leckerli+One&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: "Merriweather", sans-serif;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center; /* Teks dan logo ditengah */
        }
        .login-container h1 {
            margin-bottom: 20px;
            color: #28a745;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            font-family: "Acme", sans-serif;
        }
        .logo {
            width: 250px;
            height: auto;
            margin-bottom: 20px; /* Jarak antara logo dan form login */
        }
        .btn-custom {
            background-color: #28a745;
            border-color: #28a745;
            color: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #218838;
            border-color: #1e7e34;
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
        }
        .error-list {
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #dc3545;
            border-radius: 5px;
            background-color: #f8d7da;
            color: #721c24;
        }
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        .form-group input {
            padding-left: 40px; /* Jarak ikon ke kiri input */
            border-radius: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }
        .form-group input:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .form-group label {
            position: absolute;
            left: 10px; /* Letakkan label di pojok kiri */
            top: 50%;
            transform: translateY(-50%);
            width: 30px;
            height: 30px;
            background-color: #f8f9fa;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer; /* Tambahkan kursor pointer */
            z-index: 1; /* Tetapkan indeks z untuk label di atas input */
        }
        .form-group .input-group {
            position: relative;
        }
        .form-group .input-group .form-control {
            padding-left: 40px; /* Jarak ikon ke kiri input */
            border-radius: 20px; /* Tambahkan border-radius untuk input */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }
        .form-group .input-group .form-control:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .show-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background-color: #f8f9fa;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer; /* Tambahkan kursor pointer */
        }
        .show-password i {
            font-size: 18px;
            color: #495057; /* Warna ikon */
        }
        .forgot-password-link {
            color: #28a745; /* Warna teks hijau */
            display: block;
            margin-top: 15px; /* Jarak antara button dan link */
        }
        .forgot-password-link:hover {
            color: #28a745; /* Warna teks hijau saat dihover */
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>LOGIN</h1>
        <img src="img/logo.png" alt="Logo" class="logo">
        @if ($errors->any())
            <div class="error-list">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
        <form action="{{ url('/') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email" class="left-icon"><i class="fa fa-envelope"></i></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <label for="password" class="left-icon"><i class="fas fa-lock"></i></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Kata Sandi" required>
                </div>                
                <div class="show-password" id="togglePassword">
                    <i class="fas fa-eye"></i>
                </div>
            </div>
            <button type="submit" class="btn btn-custom btn-block">Login</button>
            {{-- <div class="text-center">
                <a href="" class="forgot-password-link">Lupa Kata Sandi?</a>
            </div> --}}
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        // Script untuk toggle tampilkan kata sandi
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordField = document.getElementById('password');
            const fieldType = passwordField.getAttribute('type');
            if (fieldType === 'password') {
                passwordField.setAttribute('type', 'text');
                this.innerHTML = '<i class="fas fa-eye-slash"></i>';
            } else {
                passwordField.setAttribute('type', 'password');
                this.innerHTML = '<i class="fas fa-eye"></i>';
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
