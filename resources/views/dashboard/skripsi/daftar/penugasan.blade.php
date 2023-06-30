<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Kop Teknik Change If Needed --}}
    <link rel="stylesheet" href="{{ url('css/kop.teknik.css') }}">
    <style>
        .top-text {
            vertical-align: top;
        }

        ol {
            margin-top: 0px;
            margin-bottom: 0px;
            margin-left: 20px;
            padding-top: 0px;
            padding-bottom: 0px;
            padding-left: 0px;
        }

        .tab1 {
            display: inline-block;
            padding-left: 63px;
        }

        .tab2 {
            display: inline-block;
            padding-left: 71px;
        }
    </style>
    <title>Surat Tugas</title>
</head>

<body class="container" onload="window.print()">
    @include('dashboard.kop.teknik')
    <div class="kontent">
        <table width="850px" class="paragraf">
            <tr>
                <td heigth="30px" colspan="4" style="text-align:center;">

                </td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:center;">
                    <strong><u><span style="font-size: 28px">SURAT TUGAS</u></strong><br />
                    Nomor : {{ $skripsi->no_surat }}
                </td>
            </tr>
            <tr>
                <td heigth="30px" colspan="4" style="text-align:center;">

                </td>
            </tr>
            <tr>
                <td colspan="4">
                    Dekan Fakultas Teknik Universitas Hasyim Asy'ari Tebuireng Jombang dengan ini menugaskan kepada:
                </td>
            </tr>
            <tr>
                <td colspan="4">

                </td>
            </tr>
            @foreach ($skripsi->dosen as $dosen)
                <tr>
                    <td width="10px" class="top-text">{{ $dosen->pivot->ke }}.&nbsp;</td>
                    <td width="210px" class="top-text">Nama</td>
                    <td width="10px" class="top-text">:</td>
                    <td class="top-text">{{ $dosen->nama }}</td>
                </tr>
                <tr>
                    <td width="10px" class="top-text"></td>
                    <td width="210px" class="top-text">NIY</td>
                    <td width="10px" class="top-text">:</td>
                    <td class="top-text">{{ $dosen->niy }}</td>
                </tr>
                <tr>
                    <td width="10px" class="top-text"></td>
                    <td width="210px" class="top-text">Homebase</td>
                    <td width="10px" class="top-text">:</td>
                    <td class="top-text">{{ $dosen->jurusan->jenjang }} {{ $dosen->jurusan->jurusan }}</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" class="justify">
                    untuk bertugas sebagai Pembimbing Skripsi mahasiswa Program Studi {{ $skripsi->mahasiswa->jurusan->jenjang }} {{ $skripsi->mahasiswa->jurusan->jurusan }} berikut ini:
                </td>
            </tr>
            <tr>
                <td colspan="4">

                </td>
            </tr>
            <tr>
                <td width="220px" colspan="2" class="top-text">Nama Mahasiswa</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ $skripsi->mahasiswa->nama }}</td>
            </tr>
            <tr>
                <td width="220px" colspan="2" class="top-text">NIM</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ $skripsi->mahasiswa->nim }}</td>
            </tr>
            <tr>
                <td width="220px" colspan="2" class="top-text">Jenjang/Program Studi</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ $skripsi->mahasiswa->jurusan->jenjang }} / {{ $skripsi->mahasiswa->jurusan->jurusan }}</td>
            </tr>
            <tr>
                <td width="220px" colspan="2" class="top-text">Fakultas</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ $skripsi->mahasiswa->jurusan->fakultas }}</td>
            </tr>
            <tr>
                <td width="220px" colspan="2" class="top-text">Judul Skripsi</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text justify">{{ strip_tags($skripsi->judul_skripsi) }}</td>
            </tr>
            <tr>
                <td colspan="4">

                </td>
            </tr>
            <tr>
                <td width="220px" colspan="2" class="top-text">Masa Berlaku Surat Tugas</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ \App\Helpers\IndoTanggal::tanggal($skripsi->awal_penugasan, false) }} - {{ \App\Helpers\IndoTanggal::tanggal($skripsi->akhir_penugasan, false) }}</td>
            </tr>
            <tr>
                <td colspan="4">

                </td>
            </tr>
            <tr>
                <td colspan="4">
                    Demikian surat penugasan ini dibuat untuk dilaksanakan sebaik-baiknya.
                </td>
            </tr>
        </table>
        <br />
        <table width="850px" class="ttd">
            <tr>
                <td width="320px"></td>
                <td width=""></td>
                <td width="320px">Jombang, {{ \App\Helpers\IndoTanggal::tanggal($skripsi->surat->created_at, false) }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>a.n. Dekan</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Kaprodi {{ $skripsi->mahasiswa->jurusan->jurusan }}</td>
            </tr>
            <tr>
                <td height="80px"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td><u><strong>{{ $kaprodi->nama }}</strong></u></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><strong>NIY : {{ $kaprodi->niy }}</strong></td>
            </tr>
        </table>
    </div>
</body>

</html>
