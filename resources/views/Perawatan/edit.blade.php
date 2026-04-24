
@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('dashboard/Edit.css') }}">
@endpush

@section('title', 'Perawatan')

@section('content')
    <div class="page-edit">
        <div class="edit-header">
            <h1>Edit Data Perawatan</h1>
            <p>Perbarui informasi data perawatan</p>
        </div>
        
        <form action="{{ route('perawatan.update', $perawatan->id) }}" method="POST" class="edit-form">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group">
                    <label for="username">
                        <i class="fas fa-user"></i>
                        Username:
                    </label>
                    <input type="text" id="username" name="username" class="form-control" 
                           value="{{ $perawatan->username }}" readonly>
                </div>
                
                <div class="form-group">
                    <label for="jenis_perawatan">
                        <i class="fas fa-hand-holding-water"></i>
                        Jenis Perawatan:
                    </label>
                    <input type="text" id="jenis_perawatan" name="jenis_perawatan" class="form-control" 
                           placeholder="Masukkan jenis perawatan" required value="{{ $perawatan->jenis_perawatan }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="tanggal_perawatan">
                        <i class="fas fa-calendar-alt"></i>
                        Tanggal Perawatan:
                    </label>
                    <input type="date" id="tanggal_perawatan" name="tanggal_perawatan" class="form-control" 
                           required value="{{ $perawatan->tanggal_perawatan }}">
                </div>
            </div>

            <input type="hidden" id="user_name" name="user_name" value="{{ Auth::user()->name }}">

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Perubahan
                </button>
                <a href="{{ route('perawatan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </form>
    </div>
@endsection
