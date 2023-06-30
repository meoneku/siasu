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
                    <strong><u><span style="font-size: 28px">SURAT KETERANGAN KULIAH</u></strong><br />
                    Nomor : {{ $surat->no_surat }}
                </td>
            </tr>
            <tr>
                <td heigth="30px" colspan="4" style="text-align:center;">

                </td>
            </tr>
            <tr>
                <td colspan="4">
                    Yang bertanda tangan dibawah ini :
                </td>
            </tr>
            <tr>
                <td colspan="4">

                </td>
            </tr>
            <tr>
                <td width="210px" colspan="2" class="top-text">Nama</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ $kaprodi->nama }}</td>
            </tr>
            <tr>
                <td width="210px" colspan="2" class="top-text">NIY</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ $kaprodi->niy }}</td>
            </tr>
            <tr>
                <td width="210px" colspan="2" class="top-text">Jabatan</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ $kaprodi->jabatan }} {{ $kaprodi->jurusan->jurusan }}</td>
            </tr>
            <tr>
                <td width="210px" colspan="2" class="top-text">Instansi</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">Fakultas {{ $kaprodi->jurusan->fakultas }} Universitas Hasyim Asy'ari Tebuireng Jombang</td>
            </tr>
            <tr>
                <td colspan="4">

                </td>
            </tr>
            <tr>
                <td colspan="4" class="justify">
                    Dengan ini menerangkan dengan sebenarnya :
                </td>
            </tr>
            <tr>
                <td colspan="4">

                </td>
            </tr>
            <tr>
                <td width="210px" colspan="2" class="top-text">Nama Mahasiswa</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ $surat->mahasiswa->nama }}</td>
            </tr>
            <tr>
                <td width="210px" colspan="2" class="top-text">NIM</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ $surat->mahasiswa->nim }}</td>
            </tr>
            <tr>
                <td width="210px" colspan="2" class="top-text">Jenjang/Program Studi</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ $surat->mahasiswa->jurusan->jenjang }} / {{ $surat->mahasiswa->jurusan->jurusan }}</td>
            </tr>
            <tr>
                <td width="210px" colspan="2" class="top-text">Semester</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ $surat->angkatan }} ({{ ucfirst(App\Helpers\Terbilang::terbilang($surat->angkatan)) }})</td>
            </tr>
            <tr>
                <td width="210px" colspan="2" class="top-text">Tahun Akademik</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">{{ App\Helpers\Codes::getTA($surat->semester) }}</td>
            </tr>
            <tr>
                <td colspan="4">

                </td>
            </tr>
            <tr>
                <td colspan="4">
                    Menerangkan dengan sebenarnya bahwa yang bersangkutan tercatat sebagai mahasiswa aktif Fakultas {{ $surat->mahasiswa->jurusan->fakultas }} Universitas Hasyim Asy'ari.
                </td>
            </tr>
            <tr>
                <td colspan="4">

                </td>
            </tr>
            <tr>
                <td colspan="4">
                    Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagai mana mestinya.
                </td>
            </tr>
        </table>
        <br />
        <table width="850px" class="ttd">
            <tr>
                <td width="320px"></td>
                <td width=""></td>
                <td width="320px">Jombang, {{ \App\Helpers\IndoTanggal::tanggal($surat->surat->created_at, false) }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Kaprodi {{ $surat->mahasiswa->jurusan->jurusan }}</td>
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
