<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Reece Farm</title>

    <link rel="stylesheet" href="{{ asset('halaman_login/Login.css') }}">
</head>
<body>

<div class="container">

    <!-- LEFT SIDE -->
    <div class="left-side">
        <img src="{{ asset('halaman_depan/images/background.jpeg') }}" class="bg-image" alt="">
        <img src="{{ asset('halaman_depan/images/icons/logo_reece.ico') }}" class="logo" alt="">
    </div>

    <!-- RIGHT SIDE -->
    <div class="right-side">

        <h1 class="title">MASUK</h1>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="input-group">
                <span class="icon">👤</span>
                <input type="Nama Pengguna" name="Nama Pengguna" placeholder="Nama Pengguna" required>
            </div>

            <div class="input-group">
                <span class="icon">🔒</span>
                <input type="Kata Sandi" name="Kata Sandi" placeholder="Kata Sandi" required>
            </div>

            <a href="{{ route('login') }}">
    <button type="button" class="btn-masuk">Masuk</button>
</a>


        </form>

        
        

    </div>

</div>

</body>
</html>
