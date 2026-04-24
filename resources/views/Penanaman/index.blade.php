@extends('layouts.app')

@section('title', ' Penanaman')

@section('content')
    <div class="page-header">
        <h1>Data Penanaman</h1>
<br>
        <a href="{{ route('penanaman.create') }}" class="btn-add">
            Tambah Data Penanaman <i class="fa-solid fa-plus"></i>
        </a>
        <a href="{{ route('penanaman.cetak') }}" class="btn-cetak" target="_blank">
            Cetak Laporan <i class="fa-solid fa-print"></i></a>
    </div>

    <table class="styled-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Lokasi Tanaman</th>
                <th>Jumlah Tanaman</th>
                <th>Jenis Bibit</th>
                <th>Tanggal Tanam</th>
                <th>Aksi</th>
            </tr>
        </thead>
       <tbody>
@foreach ($allkategori as $key => $r)
<tr>
    <td>{{ $key + 1 }}</td>
    <td>{{ $r->username }}</td>
    <td>{{ $r->lokasi_tanaman }}</td>
    <td>{{ $r->jumlah_tanaman }}</td>
    <td>{{ $r->jenis_bibit }}</td>
    <td>{{ $r->tanggal_tanam }}</td>
 
    <td>
        <form action="{{ route('penanaman.destroy', $r->id) }}" method="POST">
            <a href="{{ route('penanaman.edit', $r->id) }}" class="tombol"><i class="fa-regular fa-pen-to-square"></i></a>

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
