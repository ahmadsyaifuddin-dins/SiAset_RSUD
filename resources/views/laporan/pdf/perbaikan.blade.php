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
                <th style="width: 4%">No</th>
                <th style="width: 12%">Tgl Lapor</th>
                <th style="width: 20%">Barang / Aset</th>
                <th style="width: 15%">Keluhan</th>
                <th style="width: 12%">Tgl Selesai</th>
                <th style="width: 15%">Tindakan</th>
                <th style="width: 10%">Teknisi</th>
                <th style="width: 12%">Biaya</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $item)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="text-align: center;">{{ \Carbon\Carbon::parse($item->tanggal_laporan)->format('d-m-Y') }}
                    </td>
                    <td>
                        <b>{{ $item->inventaris->barang->nama_barang ?? '-' }}</b><br>
                        <small>{{ $item->inventaris->ruangan->nama_ruangan ?? '-' }}</small>
                    </td>
                    <td>{{ Str::limit($item->deskripsi_kerusakan, 50) }}</td>

                    @if ($item->perbaikan)
                        <td style="text-align: center;">
                            {{ \Carbon\Carbon::parse($item->perbaikan->tanggal_perbaikan)->format('d-m-Y') }}</td>
                        <td>{{ $item->perbaikan->tindakan }}</td>
                        <td>{{ $item->perbaikan->teknisi }}</td>
                        <td style="text-align: right;">Rp {{ number_format($item->perbaikan->biaya, 0, ',', '.') }}
                        </td>
                    @else
                        <td colspan="4" style="text-align: center; font-style: italic; color: red;">
                            Belum Diperbaiki (Status: {{ $item->status }})
                        </td>
                    @endif
                </tr>
            @endforeach

            <tr>
                <td colspan="7" style="text-align: right; font-weight: bold; background-color: #f2f2f2;">TOTAL BIAYA
                    MAINTENANCE</td>
                <td style="text-align: right; font-weight: bold; background-color: #f2f2f2;">
                    Rp {{ number_format($data->sum(fn($k) => $k->perbaikan->biaya ?? 0), 0, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>

    @include('laporan.components._signature')

</body>

</html>
