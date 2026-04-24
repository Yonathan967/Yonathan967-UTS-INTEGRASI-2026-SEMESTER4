<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donasi Gagal - TANI</title>
  <link rel="stylesheet" href="{{ asset('css/donation-public.css') }}">
  <link rel="stylesheet" href="{{ asset('css/donation-status.css') }}">
</head>
<body>

<div class="status-wrap">

  <a href="{{ route('donasi.public.index') }}" class="status-brand">
    <div class="status-brand__logo status-brand__logo--red">
      <img src="{{ asset('images/logo.png') }}" alt="TANI Logo">
    </div>
    <span class="status-brand__name">TANI</span>
  </a>

  <div class="status-card">
    <div class="status-card__header status-card__header--red">
      <div class="status-card__icon-wrap status-card__icon-wrap--shake">
      </div>
      <h1 class="status-card__title">Donasi Gagal</h1>
      <p class="status-card__subtitle">Terjadi kesalahan dalam proses donasi</p>
    </div>

    <div class="status-card__body">

      <p class="status-card__msg">
        Maaf, pembayaran Anda tidak dapat diproses. Jangan khawatir — tidak ada dana yang ditarik dari akun Anda.
      </p>

      <div class="status-reasons">
        <div class="status-reasons__title">Kemungkinan penyebab:</div>
        <ul class="status-reasons__list">
          <li>Saldo atau limit kartu tidak mencukupi</li>
          <li>Koneksi internet terputus saat proses</li>
          <li>Waktu pembayaran habis (expired)</li>
          <li>Pembayaran dibatalkan</li>
        </ul>
      </div>

      <a href="{{ route('donasi.public.create') }}" class="status-btn-primary status-btn-primary--green">
        🔄 Coba Donasi Lagi
      </a>
      <a href="{{ route('donasi.public.index') }}" class="status-btn-ghost">
        ← Kembali ke Halaman Donasi
      </a>

    </div>
  </div>

</div>

</body>
</html>