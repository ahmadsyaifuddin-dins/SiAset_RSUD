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
                <th>Tgl Serah Terima</th>
                <th>Kode / Nama Barang</th>
                <th>Ruangan Penerima</th>
                <th>Teknisi (Menyerahkan)</th>
                <th>Penerima</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $item)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="text-align: center;">{{ \Carbon\Carbon::parse($item->tanggal_serah)->format('d-m-Y') }}
                    </td>
                    <td>
                        <strong>{{ $item->perbaikan->kerusakan->inventaris->kode_inventaris ?? '-' }}</strong><br>
                        {{ $item->perbaikan->kerusakan->inventaris->barang->nama_barang ?? '-' }}
                    </td>
                    <td>{{ $item->perbaikan->kerusakan->inventaris->ruangan->nama_ruangan ?? '-' }}</td>
                    <td>{{ $item->perbaikan->teknisi ?? '-' }}</td>
                    <td>{{ $item->penerima ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @include('laporan.components._signature')

</body>

</html>
