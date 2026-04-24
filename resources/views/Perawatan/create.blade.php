@extends('layouts.app')

@section('title', 'Perawatan')

@section('content')
<div class="page-header">
    <h1>Tambah Data Perawatan</h1>
    <br>

    <form action="{{ route('perawatan.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="username">Username :</label>
            <input type="text" id="username" name="username" class="form-control" value="{{ Auth::user()->name }}" readonly>
        </div>

        <input type="hidden" id="user_name" name="user_name" value="{{ Auth::user()->name }}">

        <div class="form-group">
            <label for="jenis_perawatan">Jenis Perawatan:</label>
            <input type="text" id="jenis_perawatan" name="jenis_perawatan" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="tanggal_perawatan">Tanggal Perawatan:</label>
            <input type="date" id="tanggal_perawatan" name="tanggal_perawatan" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection