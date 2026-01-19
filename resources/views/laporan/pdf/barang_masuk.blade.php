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
                <th style="width: 20%">Tanggal Masuk</th>
                <th style="width: 40%">Nama Barang</th>
                <th style="width: 15%">Jumlah</th>
                <th style="width: 20%">Satuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $item)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="text-align: center;">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d-m-Y') }}
                    </td>
                    <td>{{ $item->barangGudang->nama_barang ?? 'Item Terhapus' }}</td>
                    <td style="text-align: center;">{{ $item->jumlah_masuk }}</td>
                    <td style="text-align: center;">{{ $item->barangGudang->satuan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @include('laporan.components._signature')

</body>

</html>
