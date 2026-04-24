@extends('layouts.app')

@section('title', 'Penanaman')

@section('content')
    <div class="page-header">
        <h1>Tambah Data Penanaman</h1>
<br>
       <form action="{{ route('penanaman.store') }}" method="POST">
    @csrf

            <div class="form-group">
            <label for="username">Username :</label>

            <input type="text" id="username" name="username" class="form-control" 
                   value="{{ Auth::user()->name }}" readonly>
        </div>
       
        <input type="hidden" id="user_name" name="user_name" value="{{ Auth::user()->name }}">

            <div class="form-group">
                <label for="lokasi_tanaman">Lokasi Tanaman:</label>
                <input type="text" id="lokasi_tanaman" name="lokasi_tanaman" class="form-control" required>
            </div>
            <div></div>
            <div class="form-group">
                <label for="jenis_bibit">Jenis Bibit:</label>
                <input type="text" id="jenis_bibit" name="jenis_bibit" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="jumlah_bibit">Jumlah Bibit:</label>
                <input type="number" id="jumlah_bibit" name="jumlah_bibit" class="form-control" min="1" required>
                @error('jumlah_bibit')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="jumlah_tanaman">Jumlah Tanaman:</label>
                <input type="number" id="jumlah_tanaman" name="jumlah_tanaman" class="form-control" min="1" required>
                @error('jumlah_tanaman')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">

            </div>
            <div class="fomr-group">
                <label for="tanggal_tanam">Tanggal Tanam:</label>
                <input type="date" id="tanggal_tanam" name="tanggal_tanam" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection