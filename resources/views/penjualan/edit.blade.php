
@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('dashboard/Edit.css') }}">
@endpush

@section('title', 'Penjualan')

@section('content')
    <div class="page-edit">
        <h1>Edit Data Penjualan</h1>
<br>
        <form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST">
            @csrf
            
            @method('PUT')

            <div class="form-group">
                <label for="jenis_tanaman">Jenis Tanaman:</label>
                <input type="text" id="jenis_tanaman" name="jenis_tanaman" class="form-control" required value="{{ $penjualan->jenis_tanaman }}">
            </div>
            <div class="form-group">
                <label for="jumlah_pembelian">Jumlah Pembelian(KG):</label>
                <input type="number" id="jumlah_pembelian" name="jumlah_pembelian" class="form-control" required value="{{ $penjualan->jumlah_pembelian }}">
            </div>
            <div class="form-group">
                <label for="harga">Harga per KG (Rp):</label>
                <input type="number" id="harga" name="harga" class="form-control" step="0.01" required value="{{ $penjualan->harga }}">
            </div>
            <div class="form-group">
                <label for="tanggal_pembelian">Tanggal Pembelian:</label>
                <input type="date" id="tanggal_pembelian" name="tanggal_pembelian" class="form-control" required value="{{ $penjualan->tanggal_pembelian }}">
            </div>
            <div class="form-group">
                <label for="Nama_Pembeli">Nama Pembeli:</label>
                <input type="text" id="Nama_Pembeli" name="Nama_Pembeli" class="form-control" required value="{{ $penjualan->Nama_Pembeli }}">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
