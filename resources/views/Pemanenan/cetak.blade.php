<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penanaman</title>
    <style>
        body { font-family: Arial }
        table { width:100%; border-collapse: collapse }
        th, td { border:1px solid black; padding:8px }
    </style>
</head>
<body>

<h2 align="center">LAPORAN PENANAMAN</h2>

<table>
<thead>
<tr>
    <th>No</th>
    <th>Nama Petani</th>
    <th>Jenis Tanaman</th>
    <th>Jumlah Panen</th>
    <th>Tanggal Panen</th>
   
</tr>
</thead>
<tbody>
@foreach($data as $i => $d)
<tr>
    <td>{{ $i+1 }}</td>
    <td>{{ $d->nama_petani }}</td>
    <td>{{ $d->lokasi_tanaman }}</td>
    <td>{{ $d->jumlah_bibit }}</td>
    <td>{{ $d->jenis_bibit }}</td>
    <td>{{ $d->jumlah_tanaman }}</td>
    <td>{{ $d->tanggal_tanam }}</td>
</tr>
@endforeach
</tbody>
</table>

<script>
    window.print();
</script>

</body>
</html>
