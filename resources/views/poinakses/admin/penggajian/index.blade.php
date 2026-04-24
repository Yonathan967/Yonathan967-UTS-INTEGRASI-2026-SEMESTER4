@extends('layouts.app')

@section('title', 'Penggajian Karyawan')

@section('content')
    <div class="page-header">
        <h1>Data Penggajian Karyawan</h1>
        <br>
        <a href="{{ route('penggajian.create') }}" class="btn-add">
            Tambah Data Penggajian <i class="fa-solid fa-plus"></i>
        </a>
        <a href="{{ route('penggajian.cetak') }}" class="btn-cetak" target="_blank">
            Cetak Laporan <i class="fa-solid fa-print"></i>
        </a>
    </div>

    <table class="styled-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Gaji</th>
                <th>Tanggal Gaji</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penggajians as $key => $penggajian)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $penggajian->user->name }}</td>
                <td>Rp {{ number_format($penggajian->gaji, 0, ',', '.') }}</td>
                <td>{{ $penggajian->tanggal_gaji->format('d/m/Y') }}</td>
                <td>
                    <span class="badge badge-{{ $penggajian->status == 'paid' ? 'success' : 'warning' }}">
                        {{ $penggajian->status == 'paid' ? 'Dibayar' : 'Pending' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('penggajian.edit', $penggajian) }}" class="tombol"><i class="fa-regular fa-pen-to-square"></i></a>
                    <form action="{{ route('penggajian.destroy', $penggajian) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="tombol tombol-hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection