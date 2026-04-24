@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <h1>Donasi Pertanian</h1>
                <p>Dukung pengembangan pertanian kami dengan donasi Anda</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-hand-holding-heart"></i> Form Donasi</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.donasi.store') }}" method="POST">
                        @csrf
                        
                        <!-- Informasi Donatur -->
                        <div class="section-title">
                            <h5><i class="fas fa-user"></i> Informasi Donatur</h5>
                            <hr>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_donatur" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('nama_donatur') is-invalid @enderror" 
                                           id="nama_donatur" name="nama_donatur" value="{{ old('nama_donatur') }}" required>
                                    @error('nama_donatur')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">No. Telepon</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Detail Donasi -->
                        <div class="section-title mt-4">
                            <h5><i class="fas fa-donate"></i> Detail Donasi</h5>
                            <hr>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jumlah" class="form-label">Jumlah Donasi (Rp) <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror" 
                                               id="jumlah" name="jumlah" value="{{ old('jumlah') }}" 
                                               min="1000" step="1000" required>
                                    </div>
                                    @error('jumlah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Minimal donasi Rp 1.000</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="metode_pembayaran" class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                                    <select class="form-select @error('metode_pembayaran') is-invalid @enderror" 
                                            id="metode_pembayaran" name="metode_pembayaran" required>
                                        <option value="">Pilih Metode Pembayaran</option>
                                        <option value="transfer" {{ old('metode_pembayaran') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                                        <option value="ewallet" {{ old('metode_pembayaran') == 'ewallet' ? 'selected' : '' }}>E-Wallet</option>
                                        <option value="qris" {{ old('metode_pembayaran') == 'qris' ? 'selected' : '' }}>QRIS</option>
                                        <option value="credit_card" {{ old('metode_pembayaran') == 'credit_card' ? 'selected' : '' }}>Kartu Kredit</option>
                                    </select>
                                    @error('metode_pembayaran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Quick Amount Buttons -->
                        <div class="mb-3">
                            <label class="form-label">Quick Amount:</label>
                            <div class="btn-group w-100" role="group">
                                <button type="button" class="btn btn-outline-primary" onclick="setAmount(10000)">Rp 10.000</button>
                                <button type="button" class="btn btn-outline-primary" onclick="setAmount(25000)">Rp 25.000</button>
                                <button type="button" class="btn btn-outline-primary" onclick="setAmount(50000)">Rp 50.000</button>
                                <button type="button" class="btn btn-outline-primary" onclick="setAmount(100000)">Rp 100.000</button>
                                <button type="button" class="btn btn-outline-primary" onclick="setAmount(500000)">Rp 500.000</button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan (Opsional)</label>
                            <textarea class="form-control @error('pesan') is-invalid @enderror" 
                                      id="pesan" name="pesan" rows="3">{{ old('pesan') }}</textarea>
                                    @error('pesan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            <small class="form-text text-muted">Maksimal 500 karakter</small>
                        </div>

                        <!-- Impact Section -->
                        <div class="alert alert-info mt-4">
                            <h6><i class="fas fa-info-circle"></i> Dampak Donasi Anda:</h6>
                            <ul class="mb-0">
                                <li>Rp 10.000 = 1 bibit sayuran</li>
                                <li>Rp 50.000 = 5 bibit sayuran + pupuk</li>
                                <li>Rp 100.000 = 10 bibit sayuran + pupuk + alat</li>
                                <li>Rp 500.000 = Support 1 petani selama 1 musim</li>
                            </ul>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-heart"></i> Donasi Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function setAmount(amount) {
    document.getElementById('jumlah').value = amount;
}

// Format currency input
document.getElementById('jumlah').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value) {
        e.target.value = parseInt(value);
    }
});
</script>

<style>
.section-title h5 {
    color: #2c3e50;
    font-weight: 600;
}

.section-title hr {
    margin-top: 5px;
    border-top: 2px solid #e74c3c;
}

.card {
    border: none;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
}

.btn-success {
    background: linear-gradient(135deg, #56ab2f 0%, #a8e063 100%);
    border: none;
}

.btn-success:hover {
    background: linear-gradient(135deg, #3d7a1f 0%, #7fb83d 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.alert-info {
    background-color: #e8f4f8;
    border-left: 4px solid #17a2b8;
}
</style>
@endsection
