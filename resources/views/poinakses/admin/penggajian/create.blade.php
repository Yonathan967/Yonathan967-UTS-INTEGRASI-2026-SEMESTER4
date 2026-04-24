@extends('layouts.app')

@section('title', 'Tambah Penggajian')

@section('content')
    <div class="page-header">
        <h1>Tambah Data Penggajian</h1>
        <br>
        <form action="{{ route('penggajian.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">Karyawan:</label>
                <select id="user_id" name="user_id" class="form-control" required>
                    <option value="">Pilih Karyawan</option>
                    @foreach($karyawans as $karyawan)
                    <option value="{{ $karyawan->id }}">{{ $karyawan->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="gaji">Gaji:</label>
                <input type="number" id="gaji" name="gaji" class="form-control" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="tanggal_gaji">Tanggal Gaji:</label>
                <input type="date" id="tanggal_gaji" name="tanggal_gaji" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <textarea id="keterangan" name="keterangan" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('penggajian.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection