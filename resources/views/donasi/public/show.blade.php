@extends('layouts.public')

@section('title', 'Detail Donasi - Reece Farms')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/donation.css') }}">
<link rel="stylesheet" href="{{ asset('css/donation-show.css') }}">
@endpush

@section('content')
<div class="donation-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="donation-form-card">
                    <div class="form-header">
                        <h2><i class="fas fa-receipt"></i> Detail Donasi</h2>
                        <p>Terima kasih atas donasi Anda</p>
                    </div>

                    <div class="form-section">
                        <div class="row">
                            <div class="col-md-6">
                                <h4><i class="fas fa-user"></i> Informasi Donatur</h4>
                                <p><strong>Nama:</strong> {{ $donasi->nama_donatur }}</p>
                                @if($donasi->email)
                                    <p><strong>Email:</strong> {{ $donasi->email }}</p>
                                @endif
                                @if($donasi->phone)
                                    <p><strong>Telepon:</strong> {{ $donasi->phone }}</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h4><i class="fas fa-donate"></i> Detail Donasi</h4>
                                <p><strong>Jumlah:</strong> Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}</p>
                                <p><strong>Metode:</strong> {{ ucfirst($donasi->metode_pembayaran) }}</p>
                                <p><strong>Status:</strong> 
                                    @if($donasi->status == 'success')
                                        <span class="badge bg-success">Berhasil</span>
                                    @elseif($donasi->status == 'pending')
                                        <span class="badge bg-warning">Menunggu Pembayaran</span>
                                    @else
                                        <span class="badge bg-danger">Gagal</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        @if($donasi->pesan)
                            <div class="mt-3">
                                <h4><i class="fas fa-comment"></i> Pesan</h4>
                                <p>{{ $donasi->pesan }}</p>
                            </div>
                        @endif

                        <div class="mt-3">
                            <p><strong>Order ID:</strong> {{ $donasi->order_id }}</p>
                            <p><strong>Tanggal:</strong> {{ $donasi->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="form-actions">
                        @if($donasi->status == 'pending')
                            <a href="{{ route('donasi.public.payment', $donasi) }}" class="btn-donate-submit">
                                <i class="fas fa-credit-card"></i> Lanjutkan Pembayaran
                            </a>
                            <button type="button" class="btn-check-status" onclick="checkPaymentStatus('{{ $donasi->order_id }}')">
                                <i class="fas fa-sync-alt"></i> Cek Status Pembayaran
                            </button>
                        @endif
                        <a href="{{ route('donasi.public.index') }}" class="btn-cancel">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function checkPaymentStatus(orderId) {
    const button = document.querySelector('.btn-check-status');
    const originalContent = button.innerHTML;
    
    //  loading state
    button.classList.add('loading');
    button.innerHTML = '<i class="fas fa-sync-alt"></i> Mengecek status...';
    button.disabled = true;
    

    const existingMessage = document.querySelector('.status-message');
    if (existingMessage) {
        existingMessage.remove();
    }
    
    // Check status via API
    fetch(`/api/donasi/status/${orderId}`)
        .then(response => response.json())
        .then(data => {
            button.classList.remove('loading');
            button.disabled = false;
            button.innerHTML = originalContent;
            
            if (data.success) {
                showMessage(data.message, data.status === 'success' ? 'success' : 'info');
                
                // If payment successful, redirect after 2 seconds
                if (data.status === 'success') {
                    setTimeout(() => {
                        window.location.href = '/donasi/success';
                    }, 2000);
                }
            } else {
                showMessage(data.message || 'Terjadi kesalahan saat mengecek status', 'error');
            }
        })
        .catch(error => {
            button.classList.remove('loading');
            button.disabled = false;
            button.innerHTML = originalContent;
            showMessage('Gagal terhubung ke server. Silakan coba lagi.', 'error');
            console.error('Error checking status:', error);
        });
}

function showMessage(message, type) {
    const buttonContainer = document.querySelector('.form-actions');
    const messageDiv = document.createElement('div');
    messageDiv.className = `status-message ${type}`;
    messageDiv.textContent = message;
    
    buttonContainer.appendChild(messageDiv);
    
    // Menghilangkan pesan setelah 5 detik
    setTimeout(() => {
        if (messageDiv.parentNode) {
            messageDiv.remove();
        }
    }, 5000);
}


document.addEventListener('DOMContentLoaded', function() {
    @if($donasi->status == 'pending')
    setInterval(() => {
        const button = document.querySelector('.btn-check-status');
        if (button && !button.disabled) {
            checkPaymentStatus('{{ $donasi->order_id }}');
        }
    }, 30000);
    @endif
});
</script>
@endpush