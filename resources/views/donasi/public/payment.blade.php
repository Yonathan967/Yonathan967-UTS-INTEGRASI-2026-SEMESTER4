@extends('layouts.donation')

@section('title', 'Lanjutkan Pembayaran')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <!-- Header -->
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="fas fa-credit-card fa-3x text-primary"></i>
                        </div>
                        <h4 class="fw-bold">Lanjutkan Pembayaran</h4>
                        <p class="text-muted">Selesaikan pembayaran donasi Anda</p>
                    </div>

                    <!-- Detail donasi -->
                    <div class="bg-light rounded p-3 mb-4">
                        <h6 class="fw-bold mb-3">Detail Donasi</h6>
                        <div class="row mb-2">
                            <div class="col-6 text-muted">Order ID:</div>
                            <div class="col-6 text-end fw-bold">{{ $donasi->order_id }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-muted">Nama Donatur:</div>
                            <div class="col-6 text-end fw-bold">{{ $donasi->nama_donatur }}</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6 text-muted">Jumlah:</div>
                            <div class="col-6 text-end fw-bold text-success">Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}</div>
                        </div>
                        <div class="row">
                            <div class="col-6 text-muted">Status:</div>
                            <div class="col-6 text-end">
                                <span class="badge bg-warning">Menunggu Pembayaran</span>
                            </div>
                        </div>
                    </div>

                    <!-- Intruksi pembayaran -->
                    <div class="alert alert-info mb-4">
                        <h6 class="alert-heading"><i class="fas fa-info-circle me-2"></i>Petunjuk Pembayaran</h6>
                        <ol class="mb-0 small">
                            <li>Klik tombol "Bayar Sekarang" di bawah</li>
                            <li>Pilih metode pembayaran yang Anda inginkan</li>
                            <li>Selesaikan pembayaran dalam waktu 24 jam</li>
                            <li>Halaman akan otomatis diperbarui setelah pembayaran</li>
                        </ol>
                    </div>

                    <!-- Tombol bayar -->
                    <div class="d-grid gap-2">
                        <button id="payButton" class="btn btn-primary btn-lg">
                            <i class="fas fa-lock me-2"></i>Bayar Sekarang
                        </button>
                        
                        <button id="checkStatusBtn" class="btn btn-outline-secondary">
                            <i class="fas fa-sync-alt me-2"></i>Cek Status Pembayaran
                        </button>
                        
                        <a href="{{ route('donasi.public.show', $donasi) }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali ke Detail
                        </a>
                    </div>

                    <!-- Status Message -->
                    <div id="statusMessage" class="mt-3"></div>
                </div>
            </div>

            <!-- Help Section -->
            <div class="text-center mt-4">
                <small class="text-muted">
                    <i class="fas fa-question-circle me-1"></i>
                    Butuh bantuan? Hubungi kami atau 
                    <a href="{{ route('donasi.public.index') }}">kembali ke halaman utama</a>
                </small>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const payButton = document.getElementById('payButton');
    const checkStatusBtn = document.getElementById('checkStatusBtn');
    const statusMessage = document.getElementById('statusMessage');
    
    // Tombol bayar midtrans
    payButton.addEventListener('click', function() {
        payButton.disabled = true;
        payButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memuat...';
        
        // Snap token
        const snapScript = document.createElement('script');
        snapScript.src = 'https://app.sandbox.midtrans.com/snap/snap.js';
        snapScript.setAttribute('data-client-key', '{{ config("midtrans.client_key") }}');
        document.head.appendChild(snapScript);
        
        snapScript.onload = function() {
            // popup midtrans
            window.snap.pay('{{ $donasi->payment_token }}', {
                onSuccess: function(result) {
                    showMessage('Pembayaran berhasil! Mengalihkan...', 'success');
                    setTimeout(() => {
                        window.location.href = '{{ route("donasi.public.success") }}?order_id={{ $donasi->order_id }}';
                    }, 2000);
                },
                onPending: function(result) {
                    showMessage('Pembayaran pending. Silakan selesaikan pembayaran.', 'warning');
                    payButton.disabled = false;
                    payButton.innerHTML = '<i class="fas fa-lock me-2"></i>Bayar Sekarang';
                },
                onError: function(result) {
                    showMessage('Pembayaran gagal. Silakan coba lagi.', 'danger');
                    payButton.disabled = false;
                    payButton.innerHTML = '<i class="fas fa-lock me-2"></i>Bayar Sekarang';
                },
                onClose: function() {
                    payButton.disabled = false;
                    payButton.innerHTML = '<i class="fas fa-lock me-2"></i>Bayar Sekarang';
                }
            });
        };
    });
    
    // Tombol check status
    checkStatusBtn.addEventListener('click', function() {
        checkStatusBtn.disabled = true;
        checkStatusBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengecek...';
        
        fetch(`/api/donasi/status/{{ $donasi->order_id }}`)
            .then(response => response.json())
            .then(data => {
                checkStatusBtn.disabled = false;
                checkStatusBtn.innerHTML = '<i class="fas fa-sync-alt me-2"></i>Cek Status Pembayaran';
                
                if (data.success) {
                    if (data.status === 'success') {
                        showMessage('Pembayaran berhasil! Mengalihkan...', 'success');
                        setTimeout(() => {
                            window.location.href = '{{ route("donasi.public.success") }}?order_id={{ $donasi->order_id }}';
                        }, 2000);
                    } else {
                        showMessage(data.message, 'info');
                    }
                } else {
                    showMessage(data.message, 'danger');
                }
            })
            .catch(error => {
                checkStatusBtn.disabled = false;
                checkStatusBtn.innerHTML = '<i class="fas fa-sync-alt me-2"></i>Cek Status Pembayaran';
                showMessage('Gagal mengecek status. Silakan coba lagi.', 'danger');
            });
    });
    
 
    setInterval(() => {
        if (!payButton.disabled) {
            checkStatusBtn.click();
        }
    }, 30000);
    
    function showMessage(message, type) {
        statusMessage.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        // Menghilangkan pesan setelah 5 detik  
        setTimeout(() => {
            const alert = statusMessage.querySelector('.alert');
            if (alert) {
                alert.remove();
            }
        }, 5000);
    }
});
</script>
@endpush
