<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reece Farm</title>

    <link rel="stylesheet" href="{{ asset('halaman_depan/HalamanDepan.css') }}">
</head>
<body>

<div class="container">

    <div class="left-side">
        <img src="{{ asset('halaman_depan/images/background.jpeg') }}" class="bg-image" alt="Background">
        <img src="{{ asset('halaman_depan/images/icons/logo_reece.png') }}" class="logo" alt="Logo Reece Farm">
    </div>

    <div class="right-side">
        <h1 class="title">Reece Farm</h1>

        <p class="subtitle">
            Selamat bekerja! Jadikan hari ini sebagai kesempatan baru untuk berkembang,
            melangkah maju, dan memberikan yang terbaik.
        </p>

        <a href="{{ route('login') }}" class="btn-masuk">Masuk</a>
    </div>

</div>

</body>
</html>
