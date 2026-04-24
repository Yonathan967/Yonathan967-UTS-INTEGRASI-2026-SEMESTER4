@extends('layouts.app')

@section('title', 'Pemanenan')

@section('content')
    <div class="page-header">
        <h1>Tambah Data Pemanenan</h1>
<br>
        <form action="{{ route('pemanenan.store') }}" method="POST">
            @csrf
            <div class="form-group">
            <label for="username">Username :</label>

            <input type="text" id="username" name="username" class="form-control" 
                   value="{{ Auth::user()->name }}" readonly>
        </div>

        
        <input type="hidden" id="user_name" name="user_name" value="{{ Auth::user()->name }}">

            <div class="form-group">
                <label for="jenis_tanaman">Jenis Tanaman:</label>
                <input type="text" id="jenis_tanaman" name="jenis_tanaman" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="jumlah_panen">Jumlah Panen:</label>
                <input type="number" id="jumlah_panen" name="jumlah_panen" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tanggal_panen">Tanggal Panen:</label>
                <input type="date" id="tanggal_panen" name="tanggal_panen" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
