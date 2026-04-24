@extends('layouts.app')

@section('title', 'Pengadaan Bibit')

@section('content')
    <div class="page-header">
        <h1>Tambah Data Pengadaan Bibit</h1>
<br>
        <form action="{{ route('pengadaan_bibit.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="jenis_bibit">Jenis Bibit:</label>
                <input type="text" id="jenis_bibit" name="jenis_bibit" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="jumlah_pembelian">Jumlah Pembelian:</label>
                <input type="number" id="jumlah_pembelian" name="jumlah_pembelian" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tanggal_pembelian">Tanggal Pembelian:</label>
                <input type="date" id="tanggal_pembelian" name="tanggal_pembelian" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="number" id="harga" name="harga" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
