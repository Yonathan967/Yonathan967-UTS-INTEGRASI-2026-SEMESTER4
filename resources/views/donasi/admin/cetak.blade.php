<!DOCTYPE html>
<html>
<head>
    <title>Laporan Donasi</title>
    <link rel="stylesheet" href="{{ asset('css/donasiadmin.css') }}">
</head>
<body class="donasiadmin-print">

<h2>LAPORAN DONASI PERTANIAN</h2>
<p class="text-center">Tanggal Cetak: {{ date('d M Y H:i') }}</p>

<table>
<thead>
<tr>
    <th class="text-center">No</th>
    <th>Nama Donatur</th>
    <th>Email</th>
    <th>Telepon</th>
    <th class="text-right">Jumlah</th>
    <th class="text-center">Metode</th>
    <th class="text-center">Status</th>
    <th class="text-center">Tanggal</th>
</tr>
</thead>
<tbody>
@foreach($data as $i => $d)
<tr>
    <td class="text-center">{{ $i+1 }}</td>
    <td>{{ $d->nama_donatur }}</td>
    <td>{{ $d->email ?? '-' }}</td>
    <td>{{ $d->phone ?? '-' }}</td>
    <td class="text-right">Rp {{ number_format($d->jumlah, 0, ',', '.') }}</td>
    <td class="text-center">{{ $d->metode_label }}</td>
    <td class="text-center">
        <span class="{{ $d->status == 'success' ? 'status-success' : 'status-warning' }}">
            {{ $d->status_label }}
        </span>
    </td>
    <td class="text-center">{{ $d->created_at->format('d M Y') }}</td>
</tr>
@endforeach
<tr class="total-row">
    <td colspan="4" class="text-right"><strong>TOTAL:</strong></td>
    <td class="text-right"><strong>Rp {{ number_format($data->sum('jumlah'), 0, ',', '.') }}</strong></td>
    <td colspan="3" class="text-center"><strong>{{ $data->count() }} Donasi</strong></td>
</tr>
</tbody>
</table>

<script>
    window.print();
    // Close window after printing (optional)
    setTimeout(function() {
        window.close();
    }, 100);
</script>

</body>
</html>
