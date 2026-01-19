<!DOCTYPE html>
<html>

<head>
    <title>{{ $judul }}</title>
    @include('laporan.components._style')
    <style>
        /* Style Tambahan Khusus Surat */
        .surat-body {
            margin-top: 20px;
            line-height: 1.6;
            font-size: 14px;
            text-align: justify;
        }

        .detail-table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        .detail-table td {
            padding: 5px;
            border: none;
            vertical-align: top;
        }

        .label-col {
            width: 150px;
            font-weight: bold;
        }

        .titik-dua {
            width: 10px;
        }

        /* TTD Kiri & Kanan */
        .ttd-wrapper {
            width: 100%;
            margin-top: 50px;
        }

        .ttd-kiri {
            float: left;
            width: 40%;
            text-align: center;
        }

        .ttd-kanan {
            float: right;
            width: 40%;
            text-align: center;
        }
    </style>
</head>

<body>

    @include('laporan.components._header')

    <center>
        <h3 style="text-decoration: underline; margin-top: 20px; margin-bottom: 5px;">{{ $judul }}</h3>
        <p>Nomor: BA/{{ $data->id }}/IT/{{ date('Y') }}</p>
    </center>

    <div class="surat-body">
        <p>
            Pada hari ini <strong>{{ \Carbon\Carbon::parse($data->tanggal_serah)->translatedFormat('l') }}</strong>,
            tanggal <strong>{{ \Carbon\Carbon::parse($data->tanggal_serah)->translatedFormat('d F Y') }}</strong>,
            kami yang bertanda tangan di bawah ini:
        </p>

        <table class="detail-table" style="margin-left: 20px;">
            <tr>
                <td class="label-col">Nama</td>
                <td class="titik-dua">:</td>
                <td>{{ $data->perbaikan->teknisi }}</td>
            </tr>
            <tr>
                <td class="label-col">Jabatan</td>
                <td class="titik-dua">:</td>
                <td>Teknisi IT / IPSRS</td>
            </tr>
            <tr>
                <td colspan="3">Selanjutnya disebut sebagai <strong>PIHAK PERTAMA</strong> (Yang Menyerahkan).</td>
            </tr>
        </table>

        <table class="detail-table" style="margin-left: 20px;">
            <tr>
                <td class="label-col">Nama</td>
                <td class="titik-dua">:</td>
                <td>{{ $data->penerima }}</td>
            </tr>
            <tr>
                <td class="label-col">Ruangan</td>
                <td class="titik-dua">:</td>
                <td>{{ $data->perbaikan->kerusakan->inventaris->ruangan->nama_ruangan ?? '-' }}</td>
            </tr>
            <tr>
                <td colspan="3">Selanjutnya disebut sebagai <strong>PIHAK KEDUA</strong> (Yang Menerima).</td>
            </tr>
        </table>

        <p>
            PIHAK PERTAMA telah menyerahkan barang inventaris pasca perbaikan kepada PIHAK KEDUA dalam kondisi
            <strong>BAIK</strong> dan siap digunakan kembali, dengan rincian sebagai berikut:
        </p>

        <table style="width: 100%; border: 1px solid black; border-collapse: collapse; margin-top: 10px;">
            <tr style="background-color: #f2f2f2;">
                <th style="border: 1px solid black; padding: 5px;">Kode Inventaris</th>
                <th style="border: 1px solid black; padding: 5px;">Nama Barang</th>
                <th style="border: 1px solid black; padding: 5px;">Perbaikan yang Dilakukan</th>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 10px; text-align: center;">
                    {{ $data->perbaikan->kerusakan->inventaris->kode_inventaris }}
                </td>
                <td style="border: 1px solid black; padding: 10px;">
                    {{ $data->perbaikan->kerusakan->inventaris->barang->nama_barang }} <br>
                    <small>SN: {{ $data->perbaikan->kerusakan->inventaris->barang->sn ?? '-' }}</small>
                </td>
                <td style="border: 1px solid black; padding: 10px;">
                    {{ $data->perbaikan->tindakan }} <br>
                    <small><i>Catatan: {{ $data->keterangan ?? '-' }}</i></small>
                </td>
            </tr>
        </table>

        <p>Demikian Berita Acara Serah Terima ini dibuat untuk dipergunakan sebagaimana mestinya.</p>
    </div>

    <div class="ttd-wrapper">
        <div class="ttd-kiri">
            <p>PIHAK PERTAMA<br>(Yang Menyerahkan)</p>
            <br><br><br>
            <p style="font-weight: bold; text-decoration: underline;">{{ $data->perbaikan->teknisi }}</p>
        </div>

        <div class="ttd-kanan">
            <p>PIHAK KEDUA<br>(Yang Menerima)</p>
            <br><br><br>
            <p style="font-weight: bold; text-decoration: underline;">{{ $data->penerima }}</p>
        </div>
        <div style="clear: both;"></div>
    </div>

</body>

</html>
