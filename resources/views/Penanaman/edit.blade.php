
@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('dashboard/Edit.css') }}">
@endpush

@section('title', 'Penanaman')

@section('content')
    <div class="page-edit">
        <div class="edit-header">
            <h1>Edit Data Penanaman</h1>
            <p>Perbarui informasi data penanaman</p>
        </div>
        
        <form action="{{ route('penanaman.update', $penanaman->id) }}" method="POST" class="edit-form">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group">
                    <label for="username">
                        <i class="fas fa-user"></i>
                        Username:
                    </label>
                    <input type="text" id="username" name="username" class="form-control" 
                           value="{{ $penanaman->username }}" readonly>
                </div>
                
                <div class="form-group">
                    <label for="lokasi_tanaman">
                        <i class="fas fa-map-marker-alt"></i>
                        Lokasi Tanaman:
                    </label>
                    <input type="text" id="lokasi_tanaman" name="lokasi_tanaman" class="form-control" 
                           placeholder="Masukkan lokasi tanaman" required value="{{ $penanaman->lokasi_tanaman }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="jenis_bibit">
                        <i class="fas fa-seedling"></i>
                        Jenis Bibit:
                    </label>
                    <input type="text" id="jenis_bibit" name="jenis_bibit" class="form-control" 
                           placeholder="Masukkan jenis bibit" required value="{{ $penanaman->jenis_bibit }}">
                </div>
                
                <div class="form-group">
                    <label for="jumlah_bibit">
                        <i class="fas fa-sort-numeric-up"></i>
                        Jumlah Bibit:
                    </label>
                    <input type="number" id="jumlah_bibit" name="jumlah_bibit" class="form-control" 
                           placeholder="Masukkan jumlah bibit" min="1" required value="{{ $penanaman->jumlah_bibit }}">
                    @error('jumlah_bibit')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="jumlah_tanaman">
                        <i class="fas fa-leaf"></i>
                        Jumlah Tanaman:
                    </label>
                    <input type="number" id="jumlah_tanaman" name="jumlah_tanaman" class="form-control" 
                           placeholder="Masukkan jumlah tanaman" min="1" required value="{{ $penanaman->jumlah_tanaman }}">
                    @error('jumlah_tanaman')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="tanggal_tanam">
                        <i class="fas fa-calendar-alt"></i>
                        Tanggal Tanam:
                    </label>
                    <input type="date" id="tanggal_tanam" name="tanggal_tanam" class="form-control" 
                           required value="{{ $penanaman->tanggal_tanam }}">
                </div>
            </div>

            <input type="hidden" id="user_name" name="user_name" value="{{ Auth::user()->name }}">

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Perubahan
                </button>
                <a href="{{ route('penanaman.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </form>
    </div>
@endsection
