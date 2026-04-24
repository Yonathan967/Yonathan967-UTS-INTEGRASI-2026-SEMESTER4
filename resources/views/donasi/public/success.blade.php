<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donasi Berhasil - TANI</title>
  <link rel="stylesheet" href="{{ asset('css/donation-public.css') }}">
  <link rel="stylesheet" href="{{ asset('css/donation-status.css') }}">
</head>
<body>

<div class="status-wrap">

  <a href="{{ route('donasi.public.index') }}" class="status-brand">
    <div class="status-brand__logo"></div>
    <span class="status-brand__name">TANI</span>
  </a>

  <div class="status-card">
    <div class="status-card__header status-card__header--green">
      <div class="status-card__icon-wrap status-card__icon-wrap--pop"></div>
      <h1 class="status-card__title">Donasi Berhasil!</h1>
      <p class="status-card__subtitle">Terima kasih atas kebaikan hati Anda</p>
    </div>

    <div class="status-card__body">

      <div class="confetti">
        <span></span><span></span><span></span><span></span><span></span>
      </div>

      <p class="status-card__msg">
         Donasi Anda telah diterima dan akan segera disalurkan kepada petani lokal yang membutuhkan. Setiap rupiah Anda berarti besar!
      </p>

      @if($donasi)
      <div class="status-detail">
        <div class="status-detail__row">
          <span class="status-detail__label">Order ID</span>
          <span class="status-detail__val">{{ $donasi->order_id }}</span>
        </div>
        <div class="status-detail__row">
          <span class="status-detail__label">Nama Donatur</span>
          <span class="status-detail__val">{{ $donasi->nama_donatur }}</span>
        </div>
        <div class="status-detail__row">
          <span class="status-detail__label">Jumlah Donasi</span>
          <span class="status-detail__val">Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}</span>
        </div>
        <div class="status-detail__row">
          <span class="status-detail__label">Status</span>
          <span class="status-detail__val status-detail__val--green">✓ Berhasil</span>
        </div>
      </div>
      @endif

      <a href="{{ route('donasi.public.index') }}" class="status-btn-primary status-btn-primary--green">
        Kembali ke Halaman Donasi
      </a>
      <a href="{{ route('donasi.public.create') }}" class="status-btn-ghost">
         Donasi Lagi
      </a>

    </div>
  </div>

</div>

</body>
</html>