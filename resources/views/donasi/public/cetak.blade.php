<!DOCTYPE html>
<html>
<head>
    <title>Laporan Donasi</title>
    <style>
        body { font-family: Arial }
        table { width:100%; border-collapse: collapse }
        th, td { border:1px solid black; padding:8px }
    </style>
</head>
<body>

<h2 align="center">LAPORAN DONASI</h2>

<table>
<thead>
<tr>
    <th>No</th>
    <th>Nama Donatur</th>
    <th>Email</th>
    <th>Jumlah</th>
    <th>Metode</th>
    <th>Status</th>
    <th>Tanggal</th>
</tr>
</thead>
<tbody>
@foreach($data as $i => $d)
<tr>
    <td>{{ $i+1 }}</td>
    <td>{{ $d->nama_donatur }}</td>
    <td>{{ $d->email ?? '-' }}</td>
    <td>Rp {{ number_format($d->jumlah, 0, ',', '.') }}</td>
    <td>{{ $d->metode_label }}</td>
    <td>{{ $d->status_label }}</td>
    <td>{{ $d->created_at->format('d M Y') }}</td>
</tr>
@endforeach
</tbody>
</table>

<script>
    window.print();
</script>

</body>
</html>
