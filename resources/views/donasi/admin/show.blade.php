@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/donasiadmin.css') }}">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <h1>Detail Donasi</h1>
                <p>Informasi lengkap donasi Anda</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><i class="fas fa-receipt"></i> Detail Donasi</h4>
                    <span class="badge bg-{{ $donasi->status_color }} fs-6">
                        {{ $donasi->status_label }}
                    </span>
                </div>
                <div class="card-body">
                    <!-- Order Info -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Order ID</p>
                            <h6 class="text-primary">{{ $donasi->order_id }}</h6>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Tanggal</p>
                            <h6>{{ $donasi->created_at->format('d M Y H:i') }}</h6>
                        </div>
                    </div>

                    <!-- Donatur Info -->
                    <div class="section-title">
                        <h5><i class="fas fa-user"></i> Informasi Donatur</h5>
                        <hr>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Nama Lengkap</p>
                            <h6>{{ $donasi->nama_donatur }}</h6>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Email</p>
                            <h6>{{ $donasi->email ?: '-' }}</h6>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">No. Telepon</p>
                            <h6>{{ $donasi->phone ?: '-' }}</h6>
                        </div>
                    </div>

                    <!-- Donation Info -->
                    <div class="section-title">
                        <h5><i class="fas fa-donate"></i> Detail Donasi</h5>
                        <hr>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Jumlah Donasi</p>
                            <h4 class="text-success">Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}</h4>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1">Metode Pembayaran</p>
                            <h6>{{ $donasi->metode_label }}</h6>
                        </div>
                    </div>

                    @if($donasi->pesan)
                    <div class="row mb-4">
                        <div class="col-12">
                            <p class="text-muted mb-1">Pesan</p>
                            <p>{{ $donasi->pesan }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Payment Status -->
                    @if($donasi->status == 'pending')
                    <div class="alert alert-warning">
                        <h6><i class="fas fa-clock"></i> Menunggu Pembayaran</h6>
                        <p class="mb-2">Silakan selesaikan pembayaran untuk mengkonfirmasi donasi Anda.</p>
                        <a href="{{ route('donasi.payment', $donasi) }}" class="btn btn-primary">
                            <i class="fas fa-credit-card"></i> Bayar Sekarang
                        </a>
                    </div>
                    @endif

                    @if($donasi->status == 'success')
                    <div class="alert alert-success">
                        <h6><i class="fas fa-check-circle"></i> Pembayaran Berhasil</h6>
                        <p class="mb-0">Terima kasih atas donasi Anda! Donasi telah kami terima dan akan digunakan untuk pengembangan pertanian.</p>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('donasi.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-list"></i> Lihat Semua Donasi
                        </a>
                        @if($donasi->status == 'success')
                        <button onclick="window.print()" class="btn btn-outline-info">
                            <i class="fas fa-print"></i> Cetak Bukti
                        </button>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Impact Card -->
            <div class="card mt-4">
                <div class="card-body text-center">
                    <h5><i class="fas fa-heart text-danger"></i> Dampak Donasi Anda</h5>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <div class="impact-item">
                                <i class="fas fa-seedling text-success fa-2x"></i>
                                <h6>{{ floor($donasi->jumlah / 10000) }} Bibit</h6>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="impact-item">
                                <i class="fas fa-hand-holding-water text-info fa-2x"></i>
                                <h6>{{ floor($donasi->jumlah / 25000) }} Liter Air</h6>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="impact-item">
                                <i class="fas fa-sun text-warning fa-2x"></i>
                                <h6>{{ floor($donasi->jumlah / 50000) }} Hari Panen</h6>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="impact-item">
                                <i class="fas fa-users text-primary fa-2x"></i>
                                <h6>{{ floor($donasi->jumlah / 100000) }} Petani</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


