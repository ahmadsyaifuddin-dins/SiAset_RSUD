<!DOCTYPE html>
<html>

<head>
    <title>{{ $judul }}</title>
    @include('laporan.components._style')
    <style>
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

        .ttd-wrapper {
            width: 100%;
            margin-top: 40px;
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
        <p>Nomor: BAP/{{ $data->id }}/RSUD/{{ date('Y') }}</p>
    </center>

    <div class="surat-body">
        <p>
            Berdasarkan hasil pemeriksaan kondisi fisik aset, pada hari ini
            <strong>{{ \Carbon\Carbon::parse($data->tanggal_dihapus)->translatedFormat('l') }}</strong>
            tanggal <strong>{{ \Carbon\Carbon::parse($data->tanggal_dihapus)->translatedFormat('d F Y') }}</strong>,
            kami melakukan pemusnahan (penghapusan dari daftar aset) terhadap barang milik RSUD H. Badaruddin Kasim
            dengan rincian sebagai berikut:
        </p>

        <table style="width: 100%; border: 1px solid black; border-collapse: collapse; margin-top: 15px;">
            <tr>
                <td style="border: 1px solid black; padding: 8px; width: 30%;"><strong>Kode Inventaris</strong></td>
                <td style="border: 1px solid black; padding: 8px;">{{ $data->kode_inventaris }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 8px;"><strong>Nama Barang</strong></td>
                <td style="border: 1px solid black; padding: 8px;">{{ $data->barang->nama_barang }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 8px;"><strong>Serial Number (SN)</strong></td>
                <td style="border: 1px solid black; padding: 8px;">{{ $data->barang->sn ?? '-' }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 8px;"><strong>Lokasi Terakhir</strong></td>
                <td style="border: 1px solid black; padding: 8px;">{{ $data->ruangan->nama_ruangan ?? '-' }}</td>
            </tr>
            <tr>
                <td style="border: 1px solid black; padding: 8px;"><strong>Alasan Pemusnahan</strong></td>
                <td style="border: 1px solid black; padding: 8px; color: red;">{{ $data->alasan_hapus }}</td>
            </tr>
        </table>

        <p style="margin-top: 15px;">
            Aset tersebut telah dinyatakan <strong>Rusak Berat / Tidak Bisa Digunakan Kembali</strong>. Dengan
            diterbitkannya Berita Acara ini, maka aset di atas secara resmi dihapus dari daftar Inventaris Aktif.
        </p>
    </div>

    <div class="ttd-wrapper">
        <div class="ttd-kiri">
            <p>Mengetahui/Menyetujui,<br>Pimpinan / Pejabat Berwenang</p>
            <br><br><br>
            <p style="font-weight: bold; text-decoration: underline;">{{ $data->nama_penyetuju }}</p>
        </div>

        <div class="ttd-kanan">
            <p>Banjar, {{ \Carbon\Carbon::parse($data->tanggal_dihapus)->translatedFormat('d F Y') }}<br>Admin
                Inventaris</p>
            <br><br><br>
            <p style="font-weight: bold; text-decoration: underline;">{{ Auth::user()->name }}</p>
        </div>
        <div style="clear: both;"></div>
    </div>

</body>

</html>
