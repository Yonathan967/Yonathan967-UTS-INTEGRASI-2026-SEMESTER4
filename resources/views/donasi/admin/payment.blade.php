@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/donasiadmin.css') }}">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <h1>Pembayaran Donasi</h1>
                <p>Selesaikan pembayaran donasi Anda</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-credit-card"></i> Pembayaran</h4>
                </div>
                <div class="card-body">
                    <!-- Detail Donasi -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <h6>Order ID: <span class="text-primary">{{ $donasi->order_id }}</span></h6>
                            <p class="text-muted mb-1">Donatur: {{ $donasi->nama_donatur }}</p>
                            <p class="mb-0">Metode: {{ $donasi->metode_label }}</p>
                        </div>
                        <div class="col-md-4 text-end">
                            <h4 class="text-success">Rp {{ number_format($donasi->jumlah, 0, ',', '.') }}</h4>
                        </div>
                    </div>

                    <hr>

                    <!-- Payment Methods -->
                    <div class="payment-methods">
                        <h5 class="mb-3">Pilih Metode Pembayaran</h5>
                        
                        @if($donasi->metode_pembayaran == 'transfer')
                        <div class="payment-method active">
                            <div class="payment-header">
                                <i class="fas fa-university"></i>
                                <span>Transfer Bank</span>
                            </div>
                            <div class="payment-details">
                                <div class="bank-info">
                                    <h6>Bank BCA</h6>
                                    <p class="mb-1">No. Rekening: 1234567890</p>
                                    <p class="mb-1">Atas Nama: Reece Farm</p>
                                    <p class="text-muted">Silakan transfer sesuai jumlah donasi</p>
                                </div>
                                <div class="bank-info">
                                    <h6>Bank Mandiri</h6>
                                    <p class="mb-1">No. Rekening: 0987654321</p>
                                    <p class="mb-1">Atas Nama: Reece Farm</p>
                                    <p class="text-muted">Silakan transfer sesuai jumlah donasi</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($donasi->metode_pembayaran == 'ewallet')
                        <div class="payment-method active">
                            <div class="payment-header">
                                <i class="fas fa-wallet"></i>
                                <span>E-Wallet</span>
                            </div>
                            <div class="payment-details">
                                <div class="ewallet-options">
                                    <div class="ewallet-item">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/70/Gojek_logo_2019.svg/2560px-Gojek_logo_2019.svg.png" alt="GoPay">
                                        <p>GoPay</p>
                                    </div>
                                    <div class="ewallet-item">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/eb/OVO_logo.svg/2560px-OVO_logo.svg.png" alt="OVO">
                                        <p>OVO</p>
                                    </div>
                                    <div class="ewallet-item">
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/DANA_logo.svg/2560px-DANA_logo.svg.png" alt="DANA">
                                        <p>DANA</p>
                                    </div>
                                </div>
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> Scan QR code atau masukkan nomor telepon untuk pembayaran
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($donasi->metode_pembayaran == 'qris')
                        <div class="payment-method active">
                            <div class="payment-header">
                                <i class="fas fa-qrcode"></i>
                                <span>QRIS</span>
                            </div>
                            <div class="payment-details text-center">
                                <div class="qr-code">
                                    <div class="qr-placeholder">
                                        <i class="fas fa-qrcode fa-5x text-muted"></i>
                                        <p class="mt-3">QR Code akan muncul di sini</p>
                                        <small class="text-muted">Setelah integrasi Midtrans</small>
                                    </div>
                                </div>
                                <p class="mt-3">Scan QR code di atas menggunakan aplikasi e-wallet Anda</p>
                            </div>
                        </div>
                        @endif

                        @if($donasi->metode_pembayaran == 'credit_card')
                        <div class="payment-method active">
                            <div class="payment-header">
                                <i class="fas fa-credit-card"></i>
                                <span>Kartu Kredit</span>
                            </div>
                            <div class="payment-details">
                                <form id="cc-form">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Nomor Kartu</label>
                                                <input type="text" class="form-control" placeholder="1234 5678 9012 3456" maxlength="19">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Expired Date</label>
                                                <input type="text" class="form-control" placeholder="MM/YY" maxlength="5">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">CVV</label>
                                                <input type="text" class="form-control" placeholder="123" maxlength="3">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama Pemegang Kartu</label>
                                        <input type="text" class="form-control" placeholder="John Doe">
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Midtrans Placeholder -->
                    <div class="alert alert-warning mt-4">
                        <h6><i class="fas fa-exclamation-triangle"></i> Integrasi Payment Gateway</h6>
                        <p class="mb-2">Payment gateway akan diintegrasikan menggunakan Midtrans. Setelah Anda belajar dari YouTube:</p>
                        <ul class="mb-2">
                            <li>Popup payment Midtrans Snap akan muncul di sini</li>
                            <li>Pengguna bisa memilih metode pembayaran yang tersedia</li>
                            <li>Status pembayaran akan update otomatis</li>
                        </ul>
                        <button class="btn btn-primary" onclick="simulatePayment()">
                            <i class="fas fa-play"></i> Simulasi Pembayaran (Demo)
                        </button>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('donasi.show', $donasi) }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button class="btn btn-success" onclick="confirmPayment()">
                            <i class="fas fa-check"></i> Konfirmasi Pembayaran
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function simulatePayment() {
    // Simulasi popup Midtrans
    alert('Demo: Popup Midtrans akan muncul di sini setelah integrasi\n\nPengguna akan memilih:\n- Transfer Bank\n- E-Wallet (GoPay, OVO, DANA)\n- QRIS\n- Kartu Kredit\n\nSetelah pembayaran, status akan otomatis update.');
}

function confirmPayment() {
    if (confirm('Apakah Anda sudah melakukan pembayaran?')) {
        // Redirect ke success page (nanti akan diganti dengan callback Midtrans)
        window.location.href = '{{ route("donasi.success", ["order_id" => $donasi->order_id]) }}';
    }
}

// Format card number input
document.addEventListener('DOMContentLoaded', function() {
    const cardInput = document.querySelector('input[placeholder="1234 5678 9012 3456"]');
    if (cardInput) {
        cardInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '');
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
            e.target.value = formattedValue;
        });
    }

    const expInput = document.querySelector('input[placeholder="MM/YY"]');
    if (expInput) {
        expInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.slice(0, 2) + '/' + value.slice(2, 4);
            }
            e.target.value = value;
        });
    }
});
</script>

@endsection
