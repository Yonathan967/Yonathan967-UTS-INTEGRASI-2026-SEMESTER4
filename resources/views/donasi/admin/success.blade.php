@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-header text-center">
                <div class="success-icon mb-4">
                    <i class="fas fa-check-circle fa-5x text-success"></i>
                </div>
                <h1>Donasi Berhasil!</h1>
                <p>Terima kasih atas dukungan Anda untuk pengembangan pertanian kami</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body text-center">
                    <h4 class="mb-4">Bukti Donasi</h4>
                    
                    @if($donasi)
                    <div class="donation-summary">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Order ID</p>
                                <h6 class="text-primary">{{ $donasi->order_id }}</h6>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Tanggal</p>
                                <h6>{{ $donasi->tanggal_donasi ? $donasi->tanggal_donasi->format('d M Y H:i') : now()->format('d M Y H:i') }}</h6>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Donatur</p>
                                <h6>{{ $donasi->nama_donatur }}</h6>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-1">Metode Pembayaran</p>
                                <h6>{{ $donasi->metode_label }}</h6>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-12">
                                <p class="text-muted mb-1">Jumlah Donasi</p>
                                <h3 class="text-success">Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}</h3>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="impact-section mb-4">
                        <h5><i class="fas fa-heart text-danger"></i> Dampak Donasi Anda</h5>
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <div class="impact-stat">
                                    <i class="fas fa-seedling text-success fa-2x"></i>
                                    <h6>{{ $donasi ? floor($donasi->jumlah / 10000) : 0 }} Bibit</h6>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="impact-stat">
                                    <i class="fas fa-hand-holding-water text-info fa-2x"></i>
                                    <h6>{{ $donasi ? floor($donasi->jumlah / 25000) : 0 }} Liter Air</h6>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="impact-stat">
                                    <i class="fas fa-sun text-warning fa-2x"></i>
                                    <h6>{{ $donasi ? floor($donasi->jumlah / 50000) : 0 }} Hari Panen</h6>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="impact-stat">
                                    <i class="fas fa-users text-primary fa-2x"></i>
                                    <h6>{{ $donasi ? floor($donasi->jumlah / 100000) : 0 }} Petani</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="next-steps mb-4">
                        <h5><i class="fas fa-info-circle"></i> Langkah Selanjutnya</h5>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-success"></i> Email konfirmasi telah dikirim ke {{ $donasi->email ?? 'email Anda' }}</li>
                            <li><i class="fas fa-check text-success"></i> Donasi akan segera kami alokasikan untuk program pertanian</li>
                            <li><i class="fas fa-check text-success"></i> Anda akan menerima update perkembangan program secara berkala</li>
                        </ul>
                    </div>

                    <div class="action-buttons">
                        <div class="d-flex gap-2 justify-content-center">
                            <button onclick="window.print()" class="btn btn-outline-info">
                                <i class="fas fa-print"></i> Cetak Bukti
                            </button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-home"></i> Kembali ke Dashboard
                            </a>
                        </div>
                    </div>

                    <!-- Social Share -->
                    <div class="social-share mt-4">
                        <h6>Bagikan kebaikan Anda:</h6>
                        <div class="btn-group" role="group">
                            <button class="btn btn-outline-primary btn-sm">
                                <i class="fab fa-facebook"></i>
                            </button>
                            <button class="btn btn-outline-info btn-sm">
                                <i class="fab fa-twitter"></i>
                            </button>
                            <button class="btn btn-outline-success btn-sm">
                                <i class="fab fa-whatsapp"></i>
                            </button>
                            <button class="btn btn-outline-danger btn-sm">
                                <i class="fab fa-instagram"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.success-icon {
    animation: scaleIn 0.5s ease-in-out;
}

@keyframes scaleIn {
    0% {
        transform: scale(0);
        opacity: 0;
    }
    100% {
        transform: scale(1);
        opacity: 1;
    }
}

.donation-summary {
    background: #f8f9fa;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 30px;
}

.impact-stat {
    padding: 15px;
    border-radius: 10px;
    background: #f8f9fa;
    margin-bottom: 15px;
    transition: transform 0.3s;
}

.impact-stat:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.impact-stat h6 {
    margin-top: 10px;
    font-weight: 600;
}

.next-steps {
    background: #e8f5e8;
    padding: 20px;
    border-radius: 10px;
    border-left: 4px solid #28a745;
}

.next-steps ul li {
    padding: 5px 0;
}

.social-share {
    padding: 20px;
    border-top: 1px solid #e9ecef;
}

@media print {
    .action-buttons,
    .social-share {
        display: none !important;
    }
}
</style>
@endsection
