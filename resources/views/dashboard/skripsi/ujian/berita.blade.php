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
                <td height="15px" colspan="3" style="text-align:center;">

                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:center;">
                    <strong><u><span style="font-size: 28px">BERITA ACARA SEMINAR HASIL SKRIPSI</u></strong><br />
                </td>
            </tr>
            <tr>
                <td height="15px" colspan="3" style="text-align:center;">

                </td>
            </tr>
            <tr>
                <td colspan="3" class="justify">
                    Pada hari ini {{ tanggal_indonesia($seminar->tanggal_seminar) }} jam {{ date('G:i', strtotime($seminar->jam_mulai)) }} - {{ date('G:i', strtotime($seminar->jam_selesai)) }} WIB. Bertempat di ruang {{ $seminar->ruang }} telah dilakukan Seminar Hasil Skripsi :
                </td>
            </tr>
            <tr>
                <td colspan="3">

                </td>
            </tr>
            <tr>
                <td width="200px" class="top-text">Nama Mahasiswa</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ $seminar->mahasiswa->nama }}</td>
            </tr>
            <tr>
                <td width="200px" class="top-text">NIM</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ $seminar->mahasiswa->nim }}</td>
            </tr>
            <tr>
                <td width="200px" class="top-text">Prodi</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ $seminar->mahasiswa->jurusan->jenjang }} {{ $seminar->mahasiswa->jurusan->jurusan }}</td>
            </tr>
            <tr>
                <td colspan="3">

                </td>
            </tr>
            <tr>
                <td colspan="3" class="justify">
                    Menyatakan hasil Seminar Hasil Skripsi : dengan nilai _____ (Angka)
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    Catatan ( jika ada ) : ____________________________________________________________________
                </td>
            </tr>
            <tr>
                <td height="15px" colspan="3">

                </td>
            </tr>
        </table>
        <table width="850px" class="paragraf">
            <tr>
                <td colspan="4">
                    Susunan Penguji :
                </td>
            </tr>
            @foreach ($seminar->dosen as $dosen)
                <tr>
                    <td height="30px" width="150px" class="top-text">{{ $dosen->pivot->sebagai }}</td>
                    <td width="10px" class="top-text">:</td>
                    <td class="top-text">{{ $dosen->nama }}</td>
                    <td width="200px">Tanda Tangan,</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4">

                </td>
            </tr>
        </table>
        <br />
        <table width="850px" class="ttd">
            <tr>
                <td width="350px"></td>
                <td width=""></td>
                <td width="350px">Jombang, {{ tanggal_indonesia($seminar->tanggal_seminar, false) }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Ketua Penguji</td>
            </tr>
            <tr>
                <td height="80px"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td><u><strong>{{ $seminar->dosen->first()->nama }}</strong></u></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><strong>NIY : {{ $seminar->dosen->first()->niy }}</strong></td>
            </tr>
        </table>
    </div>
</body>

</html>
