<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pengadaan</title>
    <style>
        body { font-family: Arial }
        table { width:100%; border-collapse: collapse }
        th, td { border:1px solid black; padding:8px }
    </style>
</head>
<body>

<h2 align="center">LAPORAN PENGADAAN BIBIT</h2>

<table>
<thead>
<tr>
    <th>No</th>
    <th>Jenis bibit</th>
    <th>Jumlah pembelian</th>
    <th>Tanggal pembelian</th>
    <th>Jenis Bibit</th>
    <th>Harga</th>
   
</tr>
</thead>
<tbody>
@foreach($data as $i => $d)
<tr>
    <td>{{ $i+1 }}</td>
    <td>{{ $d->jenis_bibit }}</td>
    <td>{{ $d->jumlah_pembelian }}</td>
    <td>{{ $d->tanggal_pembelian }}</td>
    <td>{{ $d->jenis_bibit }}</td>
    <td>{{ $d->harga }}</td>
</tr>
@endforeach
</tbody>
</table>

<script>
    window.print();
</script>

</body>
</html>
