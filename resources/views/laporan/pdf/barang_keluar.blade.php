<!DOCTYPE html>
<html>

<head>
    <title>{{ $judul }}</title>
    @include('laporan.components._style')
</head>

<body>

    @include('laporan.components._header')

    <center>
        <h3 style="margin-bottom: 20px; text-transform: uppercase;">{{ $judul }}</h3>
    </center>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 15%">Tanggal</th>
                <th style="width: 30%">Nama Barang</th>
                <th style="width: 25%">Tujuan Ruangan</th>
                <th style="width: 10%">Jml</th>
                <th style="width: 15%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $item)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="text-align: center;">{{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d-m-Y') }}
                    </td>
                    <td>{{ $item->barangGudang->nama_barang ?? '-' }}</td>
                    <td>{{ $item->ruangan->nama_ruangan ?? '-' }}</td>
                    <td style="text-align: center;">{{ $item->jumlah_keluar }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @include('laporan.components._signature')

</body>

</html>
