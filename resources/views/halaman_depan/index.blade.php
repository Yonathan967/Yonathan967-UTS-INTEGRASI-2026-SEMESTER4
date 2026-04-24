<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reece Farm</title>
    <base href="{{ url('/') }}/">
    <link rel="stylesheet" href="{{ URL::asset('halaman_depan/css/HalamanDepan.css') }}">
</head>
<body>

<div class="container">

    <div class="left-side">
        <img src="{{ URL::asset('halaman_depan/images/background.jpeg') }}" class="bg-image" alt="Background">
        <img src="{{ URL::asset('halaman_depan/images/icons/logo_reece.ico') }}" class="logo" alt="Logo Reece Farm">
    </div>

    <div class="right-side">
        <h1 class="title">Reece Farm</h1>

        <p class="subtitle">
            Selamat bekerja! Jadikan hari ini sebagai kesempatan baru untuk berkembang,
            melangkah maju, dan memberikan yang terbaik.
        </p>

        <div class="button-group">
            <a href="{{ route('login') }}" class="btn-masuk">Masuk</a>
            <a href="{{ route('donasi.public.index') }}" class="btn-donasi">Donasi</a>
        </div>
    </div>

</div>

</body>
</html>
