@extends('layouts.app')

@section('title', ' Penjualan')

@section('content')
    <div class="page-header">
        <h1>Data Pemanenan</h1>
<br>
        <a href="{{ route('pemanenan.create') }}" class="btn-add">
            Tambah Data Pemanenan <i class="fa-solid fa-plus"></i>
        </a>
        <a href="{{ route('pemanenan.cetak') }}" class="btn-cetak" target="_blank">
            Cetak Laporan <i class="fa-solid fa-print"></i></a>
    </div>

    <table class="styled-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Jenis Tanaman</th>
                <th>Jumlah Panen(KG)</th>
                <th>Tanggal Panen</th>
                <th>Aksi</th>
            </tr>
        </thead>
       <tbody>
@foreach ($allkategori as $key => $r)
<tr>
    <td>{{ $key + 1 }}</td>
    <td>{{ $r->username }}</td>
    <td>{{ $r->jenis_tanaman }}</td>
    <td>{{ $r->jumlah_panen }}</td>
    <td>{{ $r->tanggal_panen }}</td>
   
    <td>
        <form action="{{ route('pemanenan.destroy', $r->id) }}" method="POST">
            <a href="{{ route('pemanenan.edit', $r->id) }}" class="tombol"><i class="fa-regular fa-pen-to-square"></i></a>

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
