<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penggajian</title>
    <style>
        body { font-family: Arial }
        table { width:100%; border-collapse: collapse }
        th, td { border:1px solid black; padding:8px }
    </style>
</head>
<body>

<h2 align="center">LAPORAN PENGGAJIAN KARYAWAN</h2>

<table>
<thead>
<tr>
    <th>No</th>
    <th>Nama Karyawan</th>
    <th>Gaji</th>
    <th>Tanggal Gaji</th>
    <th>Status</th>
</tr>
</thead>
<tbody>
@foreach($penggajians as $i => $penggajian)
<tr>
    <td>{{ $i+1 }}</td>
    <td>{{ $penggajian->user->name }}</td>
    <td>Rp {{ number_format($penggajian->gaji, 0, ',', '.') }}</td>
    <td>{{ $penggajian->tanggal_gaji->format('d/m/Y') }}</td>
    <td>{{ $penggajian->status == 'paid' ? 'Dibayar' : 'Pending' }}</td>
</tr>
@endforeach
</tbody>
</table>

<script>
    window.print();
</script>

</body>
</html>