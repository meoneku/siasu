<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Kop Teknik Change If Needed --}}
    <link rel="stylesheet" href="{{ url('css/kop.teknik.css') }}">
    <style>
        .formbim {
            font-size: 20px;
        }

        .formbim td {
            padding: 0px 0px 0px 0px;
            border: 1px solid;
            text-align: center;
            vertical-align: middle;
        }

    </style>
    <title>Form Pendaftaran</title>
</head>

<body class="container" onload="window.print()">
    @include('dashboard.kop.teknik')
    <div class="kontent">
        <table width="850px" class="paragraf">
            <tr>
                <td colspan="3" style="text-align:center;">
                    <h3>FORM BIMBINGAN SKRIPSI</h3>
                </td>
            </tr>
            <tr>
                <td width="200px">Nama</td>
                <td width="10px">:</td>
                <td>{{ $skripsi->mahasiswa->nama }}</td>
            </tr>
            <tr>
                <td width="200px">NIM / Prodi</td>
                <td width="10px">:</td>
                <td>{{ $skripsi->mahasiswa->nim }} / {{ $skripsi->mahasiswa->jurusan->jenjang }} {{ $skripsi->mahasiswa->jurusan->jurusan }}</td>
            </tr>
            <tr>
                <td width="200px" style="vertical-align: top;">Judul Skripsi</td>
                <td width="10px" style="vertical-align: top;">:</td>
                <td style="vertical-align: top;">{{ strip_tags($skripsi->judul_skripsi) }}</td>
            </tr>
            <tr>
                <td width="200px">Dosen Pembimbing</td>
                <td width="10px">:</td>
                <td>{{ $skripsi->dosen->nama }}</td>
            </tr>
        </table>
        <br />
        <table class="formbim" width="850px">
            <tr>
                <td><strong>No</strong></td>
                <td><strong>Tanggal</strong></td>
                <td><strong>Masalah Yang Dibimbing</strong></td>
                <td><strong>Paraf</strong></td>
            </tr>
            <tr>
                <td height="720px"></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <br/>
        <table width="850px" class="ttd">
            <tr>
                <td></td>
                <td width="350px">Pembimbing</td>
            </tr>
            <tr>
                <td height="100px"></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td width="350px">{{ $skripsi->dosen->nama }}</td>
            </tr>
            <tr>
                <td></td>
                <td width="350px">NIY: {{ $skripsi->dosen->niy }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
