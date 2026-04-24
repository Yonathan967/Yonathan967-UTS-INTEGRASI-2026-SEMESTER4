@extends('layouts.app')

@section('title', 'Pengadaan Bibit')

@section('content')
    <div class="page-header">
        <h1>Data Pengadaan Bibit</h1>
<br>
        <a href="{{ route('pengadaan_bibit.create') }}" class="btn-add">
            Tambah Data Pengadaan <i class="fa-solid fa-plus"></i>
        </a>
        <a href="{{ route('pengadaan_bibit.cetak') }}" class="btn-cetak" target="_blank">
            Cetak Laporan <i class="fa-solid fa-print"></i></a>
    </div>


    <table class="styled-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Jenis Bibit</th>
                <th>Jumlah Pembelian</th>
                <th>Tanggal Pembelian</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
       <tbody>
@foreach ($allkategori as $key => $r)
<tr>
    <td>{{ $key + 1 }}</td>
    <td>{{ $r->jenis_bibit }}</td>
    <td>{{ $r->jumlah_pembelian }}</td>
    <td>{{ $r->tanggal_pembelian }}</td>
    <td>Rp {{ number_format($r->harga, 0, ',', '.') }}</td>
    <td>
        <form action="{{ route('pengadaan_bibit.destroy', $r->id) }}" method="POST">
            <a href="{{ route('pengadaan_bibit.edit', $r->id) }}" class="tombol"><i class="fa-regular fa-pen-to-square"></i></a>
             
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
