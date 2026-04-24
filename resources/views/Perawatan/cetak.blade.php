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
    <th>Jenis Perawatan</th>
    <th>Tanggal Perawatan</th>
   
</tr>
</thead>
<tbody>
@foreach($data as $i => $d)
<tr>
    <td>{{ $i+1 }}</td>
    <td>{{ $d->nama_petani }}</td>
    <td>{{ $d->jenis_perawatan }}</td>
    <td>{{ $d->tanggal_perawatan }}</td>
</tr>
@endforeach
</tbody>
</table>

<script>
    window.print();
</script>

</body>
</html>
