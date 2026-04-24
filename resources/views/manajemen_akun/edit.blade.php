
@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('dashboard/Edit.css') }}">
@endpush

@section('title', 'Manajemen Akun')

@section('content')
    <div class="page-edit">
        <h1>Edit akun pegawai</h1>
<br>
        <form action="{{ route('manajemen_akun.update', $user->id) }}" method="POST">
            @csrf
            
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama Petani:</label>
                <input type="text" id="name" name="name" class="form-control" required value="{{$user->name}}">
            </div>

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required value="{{ $user->username }}">
                
           <div class="form-group">
               <label>Password Baru (opsional)</label>
               <input type="password" name="password" class="form-control" placeholder="Masukkan 8 karakter">
               <small>Kosongkan jika tidak ingin mengganti password. Password baru harus 8 karakter.</small>
</div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required value="{{ $user->email }}">
                <div class="form-group">
        <label>Role</label>
        <select name="role" class="form-control" required>
            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
        </select>
    </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
