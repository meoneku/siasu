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
                    Nomor : {{ $seminar->no_surat }}
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
            @foreach ($seminar->dosen as $dosen)
                <tr>
                    <td width="10px" class="top-text">{{ $dosen->pivot->ke }}.&nbsp;</td>
                    <td width="200px" class="top-text">Nama</td>
                    <td width="10px" class="top-text">:</td>
                    <td class="top-text">{{ $dosen->nama }}</td>
                </tr>
                <tr>
                    <td width="10px" class="top-text"></td>
                    <td width="200px" class="top-text">NIY</td>
                    <td width="10px" class="top-text">:</td>
                    <td class="top-text">{{ $dosen->niy }}</td>
                </tr>
                <tr>
                    <td width="10px" class="top-text"></td>
                    <td width="200px" class="top-text">Sebagai</td>
                    <td width="10px" class="top-text">:</td>
                    <td class="top-text">{{ $dosen->pivot->sebagai }}</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" class="justify">
                    untuk bertugas sebagai Penguji Seminar Proposal Skripsi mahasiswa Jurusan {{ $seminar->mahasiswa->jurusan->jurusan }} berikut ini:
                </td>
            </tr>
            <tr>
                <td colspan="4">

                </td>
            </tr>
            <tr>
                <td width="210px" colspan="2" class="top-text">Nama Mahasiswa</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ $seminar->mahasiswa->nama }}</td>
            </tr>
            <tr>
                <td width="210px" colspan="2" class="top-text">NIM</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ $seminar->mahasiswa->nim }}</td>
            </tr>
            <tr>
                <td width="210px" colspan="2" class="top-text">Jenjang/Program Studi</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ $seminar->mahasiswa->jurusan->jenjang }} / {{ $seminar->mahasiswa->jurusan->jurusan }}</td>
            </tr>
            <tr>
                <td width="210px" colspan="2" class="top-text">Fakultas</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ $seminar->mahasiswa->jurusan->fakultas }}</td>
            </tr>
            <tr>
                <td width="210px" colspan="2" class="top-text">Judul Skripsi</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text justify">{{ strip_tags($seminar->judul_skripsi) }}</td>
            </tr>
            <tr>
                <td colspan="4">

                </td>
            </tr>
            <tr>
                <td colspan="4">
                    Seminar akan dilaksanakan
                </td>
            </tr>
            <tr>
                <td width="210px" colspan="2" class="top-text">Hari, Tanggal</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ \App\Helpers\IndoTanggal::tanggal($seminar->tanggal_seminar) }}</td>
            </tr>
            <tr>
                <td width="210px" colspan="2" class="top-text">Waktu</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ date('G:i', strtotime($seminar->jam_mulai)) }} - {{ date('G:i', strtotime($seminar->jam_selesai)) }} WIB</td>
            </tr>
            <tr>
                <td width="210px" colspan="2" class="top-text">Ruang</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ $seminar->ruang }}</td>
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
                <td width="320px">Jombang, {{ \App\Helpers\IndoTanggal::tanggal($seminar->surat->created_at, false) }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>a.n. Dekan</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Kaprodi {{ $seminar->mahasiswa->jurusan->jurusan }}</td>
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
