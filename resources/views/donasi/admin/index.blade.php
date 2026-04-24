@extends('layouts.app')

@section('title', 'Manajemen Donasi')

@section('content')

<div class="donation-admin-page">
    <!-- Page Header -->
    <div class="page-header-modern">
        <div class="header-content">
            <div class="header-text">
                <h1><i class="fas fa-hand-holding-heart"></i> Manajemen Donasi</h1>
                <p>Kelola dan pantau semua donasi pertanian</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.donasi.cetak') }}" class="btn-modern btn-primary" target="_blank">
                    <i class="fas fa-print"></i> Cetak Laporan
                </a>
            
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card-modern success">
            <div class="stat-icon">
                <i class="fas fa-donate"></i>
            </div>
            <div class="stat-content">
                <h3>Rp {{ number_format(App\Models\DonasiPertanian::success()->sum('jumlah'), 0, ',', '.') }}</h3>
                <p>Total Donasi</p>
                <small>Semua waktu</small>
            </div>
        </div>
        
        <div class="stat-card-modern info">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <h3>{{ App\Models\DonasiPertanian::success()->count() }}</h3>
                <p>Total Donatur</p>
                <small>Donasi berhasil</small>
            </div>
        </div>
        
        <div class="stat-card-modern warning">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <h3 id="pending-count">{{ App\Models\DonasiPertanian::pending()->count() }}</h3>
                <p>Menunggu Pembayaran</p>
                <small>Perlu konfirmasi</small>
            </div>
        </div>
        
        <div class="stat-card-modern primary">
            <div class="stat-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="stat-content">
                <h3>Rp {{ number_format(App\Models\DonasiPertanian::success()->byMonth()->sum('jumlah'), 0, ',', '.') }}</h3>
                <p>Donasi Bulan Ini</p>
                <small>{{ now()->format('F Y') }}</small>
            </div>
        </div>
    </div>

    <!-- Filter & Search Section -->
    <div class="filter-section">
        <div class="search-bar">
            <form method="GET" action="{{ route('admin.donasi.index') }}" class="search-form">
                <div class="input-group">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" placeholder="Cari nama donatur atau order ID..."
                        value="{{ request('search') }}" class="search-input">
                </div>
                <button type="submit" class="btn-search">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        
        <div class="filter-tabs">
            <a href="{{ route('admin.donasi.index', ['status' => 'all']) }}"
                class="filter-tab {{ request('status') != 'success' && request('status') != 'pending' ? 'active' : '' }}">
                <i class="fas fa-list"></i> Semua
            </a>
            <a href="{{ route('admin.donasi.index', ['status' => 'success']) }}"
                class="filter-tab {{ request('status') == 'success' ? 'active' : '' }}">
                <i class="fas fa-check-circle"></i> Berhasil
            </a>
            <a href="{{ route('admin.donasi.index', ['status' => 'pending']) }}"
                class="filter-tab {{ request('status') == 'pending' ? 'active' : '' }}">
                <i class="fas fa-clock"></i> Pending
            </a>
        </div>
    </div>

    <!-- Donations Table -->
    <div class="table-container">
        <div class="table-header">
            <h3>Daftar Donasi</h3>
            <span class="table-info">
                @if($donasi->total() > 0)
                    Menampilkan {{ $donasi->firstItem() }} - {{ $donasi->lastItem() }} dari {{ $donasi->total() }} data
                @else
                    Belum ada data donasi
                @endif
            </span>
        </div>
<table class="styled-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Donatur</th>
            <th>Email</th>
            <th>Jumlah</th>
            <th>Metode</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody id="donasi-tbody">
        @forelse($donasi as $index => $d)
        <tr>
            <td>{{ $donasi->firstItem() + $index }}</td>
            <td>
                <div>
                    <strong>{{ $d->nama_donatur }}</strong>
                    @if($d->phone)
                        <br><small class="text-muted">{{ $d->phone }}</small>
                    @endif
                </div>
            </td>
            <td>{{ $d->email ?? '-' }}</td>
            <td><strong class="text-success">Rp {{ number_format($d->jumlah, 0, ',', '.') }}</strong></td>
            <td>{{ $d->metode_label }}</td>
            <td>
                <span class="status-pill {{ $d->status == 'success' ? 'success' : 'pending' }}">
                    {{ $d->status_label }}
                </span>
            </td>
            <td>
                {{ $d->created_at->format('d M Y') }}<br>
                <small class="text-muted">{{ $d->created_at->format('H:i') }}</small>
            </td>
            <td>
                <form action="{{ route('admin.donasi.destroy', $d) }}" method="POST" class="action-form">
                    <a href="{{ route('admin.donasi.show', $d) }}" class="tombol">
                        <i class="fa-regular fa-eye"></i>
                    </a>
                    @if($d->status == 'pending')
                    <a href="{{ route('admin.donasi.payment', $d) }}" class="tombol tombol-success">
                        <i class="fa-solid fa-credit-card"></i>
                    </a>
                    @endif
                    <button type="button" class="tombol" onclick="printDonation({{ $d->id }})">
                        <i class="fa-solid fa-print"></i>
                    </button>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="tombol tombol-hapus"
                        onclick="return confirm('Yakin ingin menghapus donasi ini?')">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="empty-table-message">
                <i class="fa-solid fa-inbox"></i>
                Belum ada data donasi
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- Pagination --}}
@if($donasi->hasPages())
<div class="pagination-footer">
    <small class="text-muted">
        Menampilkan {{ $donasi->firstItem() }} - {{ $donasi->lastItem() }} dari {{ $donasi->total() }} data
    </small>
    {{ $donasi->links() }}
</div>
@endif

{{-- Script Auto Refresh --}}
<script>
function printDonation(id) {
    window.open('{{ route("admin.donasi.show", ":id") }}'.replace(':id', id) + '?print=1', '_blank');
}

// Auto refresh setiap 30 detik jika ada donasi pending
setInterval(function () {
    const pendingEl = document.getElementById('pending-count');
    if (pendingEl && parseInt(pendingEl.textContent.trim()) > 0) {
        location.reload();
    }
}, 30000);
</script>

@endsection