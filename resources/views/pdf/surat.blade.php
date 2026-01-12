<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>

<body>

    <h1>SURAT RESMI</h1>

    <p><strong>Nomor:</strong> {{ $surat->nomor_surat }}</p>
    <p><strong>Tanggal:</strong> {{ $surat->tanggal_surat }}</p>

    <hr>

    <p style="white-space: pre-line;">
        {!! nl2br(e($surat->isi)) !!}
    </p>

    <br><br>

    <p>
        Disetujui oleh:<br>
        <strong>{{ $surat->approvedBy->name ?? '—' }}</strong>
    </p>

</body>

</html>
