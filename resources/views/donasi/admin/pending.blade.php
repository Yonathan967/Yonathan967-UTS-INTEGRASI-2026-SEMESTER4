@extends('layouts.app')

@section('title', 'Pembayaran Pending - Donasi')

@section('content')
<div class="page-header">
    <h1>Pembayaran Pending</h1>
    <p>Menunggu pembayaran donasi</p>
</div>

<div class="card">
    <div class="card-body">
        <div class="alert alert-warning">
            <i class="fas fa-clock"></i>
            <strong>Pembayaran Sedang Diproses</strong>
            <p class="mb-0">Silakan selesaikan pembayaran Anda. Status akan diperbarui secara otomatis setelah pembayaran dikonfirmasi.</p>
        </div>
        
        <div class="text-center">
            <a href="{{ route('admin.donasi.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Donasi
            </a>
        </div>
    </div>
</div>
@endsection
