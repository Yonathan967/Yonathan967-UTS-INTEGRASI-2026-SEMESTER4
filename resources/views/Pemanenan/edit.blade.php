
@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('dashboard/Edit.css') }}">
@endpush

@section('title', 'Pemanenan')

@section('content')
    <div class="page-edit">
        <div class="edit-header">
            <h1>Edit Data Pemanenan</h1>
            <p>Perbarui informasi data pemanenan</p>
        </div>
        
        <form action="{{ route('pemanenan.update', $pemanenan->id) }}" method="POST" class="edit-form">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group">
                    <label for="username">
                        <i class="fas fa-user"></i>
                        Username:
                    </label>
                    <input type="text" id="username" name="username" class="form-control" 
                           value="{{ $pemanenan->username }}" readonly>
                </div>
                
                <div class="form-group">
                    <label for="jenis_tanaman">
                        <i class="fas fa-wheat"></i>
                        Jenis Tanaman:
                    </label>
                    <input type="text" id="jenis_tanaman" name="jenis_tanaman" class="form-control" 
                           placeholder="Masukkan jenis tanaman" required value="{{ $pemanenan->jenis_tanaman }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="jumlah_panen">
                        <i class="fas fa-sort-numeric-up"></i>
                        Jumlah Panen (KG):
                    </label>
                    <input type="number" id="jumlah_panen" name="jumlah_panen" class="form-control" 
                           placeholder="Masukkan jumlah panen" required value="{{ $pemanenan->jumlah_panen }}">
                </div>
                
                <div class="form-group">
                    <label for="tanggal_panen">
                        <i class="fas fa-calendar-alt"></i>
                        Tanggal Panen:
                    </label>
                    <input type="date" id="tanggal_panen" name="tanggal_panen" class="form-control" 
                           required value="{{ $pemanenan->tanggal_panen }}">
                </div>
            </div>

            <input type="hidden" id="user_name" name="user_name" value="{{ Auth::user()->name }}">

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Perubahan
                </button>
                <a href="{{ route('pemanenan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </form>
    </div>
@endsection
