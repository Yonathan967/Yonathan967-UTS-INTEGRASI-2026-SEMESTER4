@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('dashboard/Edit.css') }}">
@endpush

@section('title', 'Edit Penggajian')

@section('content')
    <div class="page-edit">
        <h1>Edit Data Penggajian</h1>
        <br>
        <form action="{{ route('penggajian.update', $penggajian) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="user_id">Karyawan:</label>
                <select id="user_id" name="user_id" class="form-control" required>
                    <option value="">Pilih Karyawan</option>
                    @foreach($karyawans as $karyawan)
                    <option value="{{ $karyawan->id }}" {{ $penggajian->user_id == $karyawan->id ? 'selected' : '' }}>{{ $karyawan->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="gaji">Gaji:</label>
                <input type="number" id="gaji" name="gaji" class="form-control" step="0.01" value="{{ $penggajian->gaji }}" required>
            </div>
            <div class="form-group">
                <label for="tanggal_gaji">Tanggal Gaji:</label>
                <input type="date" id="tanggal_gaji" name="tanggal_gaji" class="form-control" value="{{ $penggajian->tanggal_gaji->format('Y-m-d') }}" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="pending" {{ $penggajian->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ $penggajian->status == 'paid' ? 'selected' : '' }}>Dibayar</option>
                </select>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <textarea id="keterangan" name="keterangan" class="form-control">{{ $penggajian->keterangan }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('penggajian.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection