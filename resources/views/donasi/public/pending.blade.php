<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menunggu Pembayaran - TANI</title>
  <link rel="stylesheet" href="{{ asset('css/donation-public.css') }}">
  <link rel="stylesheet" href="{{ asset('css/donation-status.css') }}">
</head>
<body>

<div class="status-wrap">

  <a href="{{ route('donasi.public.index') }}" class="status-brand">
    <div class="status-brand__logo status-brand__logo--amber"></div>
    <span class="status-brand__name">TANI</span>
  </a>

  <div class="status-card">
    <div class="status-card__header status-card__header--amber">
      <div class="status-card__icon-wrap status-card__icon-wrap--spin"><span>⏳</span></div>
      <h1 class="status-card__title">Menunggu Pembayaran</h1>
      <p class="status-card__subtitle">Silakan selesaikan pembayaran Anda</p>
    </div>

    <div class="status-card__body">

      <p class="status-card__msg">
        Donasi Anda sedang menunggu konfirmasi pembayaran. Setelah pembayaran selesai, donasi akan otomatis diproses.
      </p>

      <div class="status-steps">
        <div class="status-step">
          <div class="status-step__dot"></div>
          Selesaikan pembayaran melalui metode yang Anda pilih
        </div>
        <div class="status-step">
          <div class="status-step__dot" style="animation-delay:.5s"></div>
          Pembayaran akan dikonfirmasi dalam 1–5 menit
        </div>
        <div class="status-step">
          <div class="status-step__dot" style="animation-delay:1s"></div>
          Donasi Anda akan segera disalurkan ke petani lokal
        </div>
      </div>

      <a href="{{ route('donasi.public.index') }}" class="status-btn-primary status-btn-primary--amber">
         Kembali ke Halaman Donasi
      </a>
      <a href="{{ route('donasi.public.create') }}" class="status-btn-ghost status-btn-ghost--amber">
        ← Donasi Baru
      </a>

    </div>
  </div>

</div>

</body>
</html>