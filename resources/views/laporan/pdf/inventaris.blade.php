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
        <p style="margin-top: 0; margin-bottom: 20px; font-weight: bold;">LOKASI: {{ strtoupper($ruangan) }}</p>
    </center>

    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Inventaris</th>
                <th>Nama Barang</th>
                <th>Jenis / Kategori</th>
                <th>Tgl Masuk</th>
                <th>Kondisi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $item)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $item->kode_inventaris }}</td>
                    <td>{{ $item->barang->nama_barang }}</td>
                    <td>{{ $item->barang->jenis_barang }} / {{ $item->barang->kategori_barang }}</td>
                    <td style="text-align: center;">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d-m-Y') }}
                    </td>
                    <td style="text-align: center;">{{ $item->kondisi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @include('laporan.components._signature')

</body>

</html>
