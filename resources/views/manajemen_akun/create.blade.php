@extends('layouts.app')

@section('title', 'Manajemen Akun')

@section('content')
    <div class="page-header">
        <h1>Tambah Data Manajemen Akun</h1>
        <br>

        <form action="{{ route('manajemen_akun.store') }}" method="POST" autocomplete="off">
            @csrf

            <div class="form-group">
                <label for="name">Nama Petani :</label>
                <input type="text" id="name" name="name" class="form-control" required value="">
            </div>
           <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required value="">
            </div>
            <div class="form-group">
                <label for="password">Password :</label>
                <input type="password" id="password" name="password" class="form-control" required placeholder="Masukkan 8 karakter" autocomplete="new-password" value="">
                <small>Password harus 8 karakter.</small>
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" class="form-control" required value="">
            </div>

            
            <div class="form-group">
                <label for="role">Role :</label>
                <select id="role" name="role" class="form-control" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
