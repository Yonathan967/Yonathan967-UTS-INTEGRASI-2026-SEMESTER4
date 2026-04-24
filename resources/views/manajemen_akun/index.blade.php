@extends('layouts.app')

@section('title', 'Manajemen Akun')

@section('content')
    <div class="page-header">
        <h1>Manajemen Akun</h1>
        <br>
        <a href="{{ route('manajemen_akun.create') }}" class="btn-add">
            Tambah Akun <i class="fa-solid fa-plus"></i>
        </a>
    </div>

    <table class="styled-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $key => $user)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <form action="{{ route('manajemen_akun.destroy', $user->id) }}" method="POST">
                         <a href="{{ route('manajemen_akun.edit', $user->id) }}" class="tombol"><i class="fa-regular fa-pen-to-square"></i></a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="tombol tombol-hapus"
                            onclick="return confirm('Yakin ingin menghapus akun ini?')">
                            <i class="fa-solid fa-trash"></i> 
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
