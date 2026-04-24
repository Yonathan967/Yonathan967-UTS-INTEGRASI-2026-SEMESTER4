@extends('layouts.app')

@section('title', ' Penjualan')

@section('content')
    <div class="page-header">
        <h1>Data Penjualan</h1>
<br>
        <a href="{{ route('penjualan.create') }}" class="btn-add">
            Tambah Data Penjualan <i class="fa-solid fa-plus"></i>
        </a>
        <a href="{{ route('penjualan.cetak') }}" class="btn-cetak" target="_blank">
            Cetak Laporan <i class="fa-solid fa-print"></i></a>
    </div>

    <table class="styled-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pembeli</th>
                <th>Jenis Tanaman</th>
                <th>Jumlah Pembelian(KG)</th>
                <th>Harga per KG (Rp)</th>
                <th>Total Nominal (Rp)</th>
                <th>Tanggal Pembelian</th>
                <th>Aksi</th>
            </tr>
        </thead>
       <tbody>
@foreach ($allkategori as $key => $r)
<tr>
    <td>{{ $key + 1 }}</td>
    <td>{{ $r->Nama_Pembeli }}</td>
    <td>{{ $r->jenis_tanaman }}</td>
    <td>{{ $r->jumlah_pembelian }}</td>
    <td>Rp {{ number_format($r->harga, 0, ',', '.') }}</td>
    <td>Rp {{ number_format($r->jumlah_pembelian * $r->harga, 0, ',', '.') }}</td>
    <td>{{ $r->tanggal_pembelian }}</td>
    <td>
        <form action="{{ route('penjualan.destroy', $r->id) }}" method="POST">
            <a href="{{ route('penjualan.edit', $r->id) }}" class="tombol"><i class="fa-regular fa-pen-to-square"></i></a>

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
