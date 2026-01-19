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
        <p style="margin-top: -15px; font-size: 10px;">Dicetak pada: {{ date('d-m-Y H:i') }}</p>
    </center>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 35%">Nama Barang</th>
                <th style="width: 25%">Jenis / Kategori</th>
                <th style="width: 15%">Satuan</th>
                <th style="width: 20%">Sisa Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $item)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->jenis }} <br> <small>({{ $item->kategori }})</small></td>
                    <td style="text-align: center;">{{ $item->satuan }}</td>
                    <td style="text-align: center; font-weight: bold;">{{ $item->stok_saat_ini }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @include('laporan.components._signature')

</body>

</html>
