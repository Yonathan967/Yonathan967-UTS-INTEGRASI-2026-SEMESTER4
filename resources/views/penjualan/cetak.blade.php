<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: Arial }
        table { width:100%; border-collapse: collapse }
        th, td { border:1px solid black; padding:8px }
    </style>
</head>
<body>

<h2 align="center">LAPORAN PENJUALAN</h2>

<table>
<thead>
<tr>
    <th>No</th>
    <th>Nama Pembeli</th>
    <th>Jenis Tanaman</th>
    <th>Jumlah Pembelian (KG)</th>
    <th>Harga per KG (Rp)</th>
    <th>Total Nominal (Rp)</th>
    <th>Tanggal Pembelian</th>
</tr>
</thead>
<tbody>
@foreach($data as $i => $d)
<tr>
    <td>{{ $i+1 }}</td>
    <td>{{ $d->Nama_Pembeli }}</td>
    <td>{{ $d->jenis_tanaman }}</td>
    <td>{{ $d->jumlah_pembelian }}</td>
    <td>Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
    <td>Rp {{ number_format($d->jumlah_pembelian * $d->harga, 0, ',', '.') }}</td>
    <td>{{ $d->tanggal_pembelian }}</td>
</tr>
@endforeach
</tbody>
</table>

<script>
    window.print();
</script>

</body>
</html>
