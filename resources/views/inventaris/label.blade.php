<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Label - {{ $data->kode_inventaris }}</title>
    <style>
        /* Tampilan di layar (Background Abu-abu) */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            background: #e5e7eb;
        }

        /* Desain Kotak Stiker (Contoh Ukuran 6cm x 4cm) */
        .label-box {
            background: white;
            width: 6cm;
            height: 4cm;
            padding: 8px;
            border: 1px dashed #666;
            /* Garis potong */
            box-sizing: border-box;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .header {
            font-size: 9px;
            font-weight: bold;
            border-bottom: 1px solid #000;
            padding-bottom: 3px;
            margin-bottom: 3px;
        }

        .qr-container {
            margin: 2px 0;
        }

        .kode {
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .nama {
            font-size: 9px;
            text-transform: uppercase;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Tampilan khusus saat masuk ke mesin Printer */
        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
                display: block;
            }

            .label-box {
                border: none;
                margin: 0;
            }

            /* Memaksa ukuran kertas print sesuai kotak label */
            @page {
                size: 6cm 4cm;
                margin: 0;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="label-box">
        <div class="header">
            RSUD H. BADARUDDIN KASIM<br>
            Aset Inventaris
        </div>

        <div class="qr-container">
            {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(55)->generate($data->kode_inventaris) !!}
        </div>

        <div class="kode">{{ $data->kode_inventaris }}</div>
        <div class="nama">{{ \Illuminate\Support\Str::limit($data->barang->nama_barang, 30) }}</div>
    </div>

</body>

</html>
