<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat {{ $surat->nomor_surat }}</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            line-height: 1.6;
        }

        .kop {
            width: 100%;
        }

        .kop td {
            vertical-align: top;
        }

        .kop img {
            width: 80px;
        }

        .kop .instansi {
            text-align: center;
        }

        .kop .instansi h1 {
            font-size: 14pt;
            margin: 0;
            font-weight: bold;
        }

        .kop .instansi p {
            margin: 0;
            font-size: 10pt;
        }

        hr {
            border: none;
            border-top: 2px solid #000;
            margin: 10px 0;
        }

        .judul {
            text-align: center;
            margin-top: 20px;
        }

        .judul h2 {
            text-transform: uppercase;
            margin-bottom: 5px;
            font-size: 13pt;
        }

        .judul p {
            margin: 0;
            font-size: 11pt;
        }

        .identitas {
            margin-top: 25px;
        }

        .identitas table {
            width: 100%;
        }

        .identitas td {
            padding: 3px 0;
        }

        .isi {
            margin-top: 20px;
            text-align: justify;
        }

        .ttd {
            width: 100%;
            margin-top: 50px;
        }

        .ttd td {
            width: 50%;
            text-align: center;
        }

        .ttd .nama {
            margin-top: 70px;
            font-weight: bold;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <table class="kop">
        <tr>
            <td width="15%">
                <img src="{{ public_path('assets/LOGO_PJT.png') }}" alt="Logo">
            </td>
            <td class="instansi" width="85%">
                <h1>PERUM JASA TIRTA I</h1>
                <p>Jl. Surabaya no.2A, Malang</p>
                <p>Email: info@contoh.co.id | Telp: (021) 123456</p>
            </td>
        </tr>
    </table>
    <hr>
    <div class="judul">
        <h2>{{ $surat->jenisSurat->nama ?? 'SURAT' }}</h2>
        <p>Nomor: {{ $surat->nomor_surat }}</p>
    </div>
    <div class="identitas">
        <table>
            <tr>
                <td width="25%">Nama</td>
                <td width="2%">:</td>
                <td>{{ $surat->user->name ?? '-' }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{ $surat->jabatan ?? '-' }}</td>
            </tr>
            <tr>
                <td>Unit Kerja</td>
                <td>:</td>
                <td>{{ $surat->unit_kerja ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tanggal Pengajuan</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y') }}</td>
            </tr>
        </table>
    </div>

    <div class="isi">
        {!! nl2br(e($surat->isi)) !!}
    </div>

    <table class="ttd">
        <tr>
            <td></td>
            <td>
                <p>{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p>Mengetahui,</p>
                <p class="nama">
                    {{ $surat->pejabat->nama ?? 'Nama Pejabat' }}
                </p>
                <p>{{ $surat->pejabat->jabatan ?? 'Jabatan Pejabat' }}</p>
            </td>
        </tr>
    </table>
</body>
</html>