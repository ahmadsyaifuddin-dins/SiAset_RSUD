<!DOCTYPE html>
<html>

<head>
    <title>{{ $judul }}</title>
    @include('laporan.components._style')
</head>

<body>

    @include('laporan.components._header')

    <center>
        <h3 style="margin-bottom: 5px; text-transform: uppercase;">{{ $judul }}</h3>
        <p style="margin-top: 0; margin-bottom: 20px;">Periode: {{ $periode }}</p>
    </center>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Lapor</th>
                <th>Kode / Nama Barang</th>
                <th>Lokasi Ruangan</th>
                <th>Deskripsi Kerusakan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $item)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="text-align: center;">{{ \Carbon\Carbon::parse($item->tanggal_laporan)->format('d-m-Y') }}
                    </td>
                    <td>
                        <strong>{{ $item->inventaris->kode_inventaris ?? '-' }}</strong><br>
                        {{ $item->inventaris->barang->nama_barang ?? '-' }}
                    </td>
                    <td>{{ $item->inventaris->ruangan->nama_ruangan ?? '-' }}</td>
                    <td>{{ $item->deskripsi_kerusakan }}</td>
                    <td style="text-align: center;">{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @include('laporan.components._signature')

</body>

</html>
