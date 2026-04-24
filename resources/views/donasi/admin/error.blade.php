@extends('layouts.app')

@section('title', 'Pembayaran Gagal - Donasi')

@section('content')
<div class="page-header">
    <h1>Pembayaran Gagal</h1>
    <p>Terjadi kesalahan dalam pembayaran donasi</p>
</div>

<div class="card">
    <div class="card-body">
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            <strong>Pembayaran Gagal</strong>
            <p class="mb-0">Maaf, terjadi kesalahan dalam proses pembayaran. Silakan coba lagi atau hubungi administrator jika masalah berlanjut.</p>
        </div>
        
        <div class="text-center">
            <a href="{{ route('admin.donasi.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Donasi
            </a>
        </div>
    </div>
</div>
@endsection
