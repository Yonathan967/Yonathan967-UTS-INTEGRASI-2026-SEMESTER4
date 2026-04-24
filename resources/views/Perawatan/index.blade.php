@extends('layouts.app')

@section('title', ' Perawatan')

@section('content')
    <div class="page-header">
        <h1>Data Perawatan</h1>
<br>
        <a href="{{ route('perawatan.create') }}" class="btn-add">
            Tambah Data Perawatan <i class="fa-solid fa-plus"></i>
        </a>
        <a href="{{ route('perawatan.cetak') }}" class="btn-cetak" target="_blank">
            Cetak Laporan <i class="fa-solid fa-print"></i></a>
    </div>

    <table class="styled-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Jenis Perawatan</th>
                <th>Tanggal Perawatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
       <tbody>
@foreach ($allkategori as $key => $r)
<tr>
    <td>{{ $key + 1 }}</td>
    <td>{{ $r->username }}</td>
    <td>{{ $r->jenis_perawatan }}</td>
    <td>{{ $r->tanggal_perawatan }}</td>
    <td>
        <form action="{{ route('perawatan.destroy', $r->id) }}" method="POST">
            <a href="{{ route('perawatan.edit', $r->id) }}" class="tombol"><i class="fa-regular fa-pen-to-square"></i></a>

            @csrf
            @method('DELETE')

            <button type="submit" class="tombol tombol-hapus"
                onclick="return confirm('Yakin ingin menghapus data ini?')">
                <i class="fa-solid fa-trash"></i> 
            </button>
        </form>
    </td>
</tr>
@endforeach
</tbody>

    </table>
@endsection
