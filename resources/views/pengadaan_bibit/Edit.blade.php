
@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('dashboard/Edit.css') }}">
@endpush

@section('title', 'Pengadaan Bibit')

@section('content')
    <div class="page-edit">
        <h1>Edit Data Pengadaan Bibit</h1>
<br>
        <form action="{{ route('pengadaan_bibit.update', $pengadaan_bibit->id) }}" method="POST">
            @csrf
            
            @method('PUT')

            <div class="form-group">
                <label for="jenis_bibit">Jenis Bibit:</label>
                <input type="text" id="jenis_bibit" name="jenis_bibit" class="form-control" required value="{{ $pengadaan_bibit->jenis_bibit }}">
            </div>
            <div class="form-group">
                <label for="jumlah_pembelian">Jumlah Pembelian:</label>
                <input type="number" id="jumlah_pembelian" name="jumlah_pembelian" class="form-control" required value="{{ $pengadaan_bibit->jumlah_pembelian }}">
            </div>
            <div class="form-group">
                <label for="tanggal_pembelian">Tanggal Pembelian:</label>
                <input type="date" id="tanggal_pembelian" name="tanggal_pembelian" class="form-control" required value="{{ $pengadaan_bibit->tanggal_pembelian }}">
            </div>
            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" id="harga" name="harga" class="form-control" required value="{{ $pengadaan_bibit->harga }}">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
