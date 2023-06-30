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

        .surat td {
            padding: 0px 5px 0px 0px;
        }

        .inden {
            text-indent: 0.5in;
        }

        .isi td {
            padding: 0px 30px 10px 20px;
            line-height: 30px;
        }

        .table-konten td {
            padding: 0px 5px 0px 5px;
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <title>Surat Permohonan Observasi</title>
</head>

<body class="container" onload="window.print()">
    @include('dashboard.kop.teknik')
    <div class="kontent">
        <table width="850px" class="paragraf surat">
            <tr>
                <td height="10px" colspan="3" style="text-align:center;">

                </td>
            </tr>
            <tr>
                <td width="115px">No Surat</td>
                <td width="5px" class="top-text" style="padding: 0px 0px 0px 0px">:</td>
                <td class="top-text" style="padding: 0px 0px 0px 5px">{{ $surat->no_surat }}</td>
            </tr>
            <tr>
                <td width="115px">Lampiran</td>
                <td width="5px" class="top-text" style="padding: 0px 0px 0px 0px">:</td>
                <td class="top-text" style="padding: 0px 0px 0px 5px">-</td>
            </tr>
            <tr>
                <td width="115px">H A L</td>
                <td width="5px" class="top-text" style="padding: 0px 0px 0px 0px">:</td>
                <td class="top-text" style="padding: 0px 0px 0px 5px"><strong><u>Permohonan Izin Observasi</strong></u></td>
            </tr>
        </table>
        <br />
        <br />
        <table width="850px" class="paragraf surat">
            <tr>
                <td width="115px">Kepada</td>
                <td width="5px" class="top-text" style="padding: 5px 0px 5px 0px">:</td>
                <td class="top-text" style="padding: 5px 0px 5px 5px">{{ $surat->lembaga }}</td>
            </tr>
            <tr>
                <td width="115px"></td>
                <td width="5px" class="top-text" style="padding: 5px 0px 5px 0px"></td>
                <td class="top-text" style="padding: 5px 0px 5px 5px">{{ $surat->alamat }} {{ $surat->kecamatan }}</td>
            </tr>
            <tr>
                <td width="115px"></td>
                <td width="5px" class="top-text" style="padding: 5px 0px 5px 0px"></td>
                <td class="top-text" style="padding: 5px 0px 5px 5px">{{ $surat->kabupaten }} {{ $surat->provinsi }}</td>
            </tr>
        </table>
        <br />
        <br />
        <table width="850px" class="paragraf isi">
            <tr>
                <td colspan="4">
                    <i>Assalamu'alaikum warohmatullohi wabarokatuh</i>,
                </td>
            </tr>
            <tr>
                <td colspan="4" class="justify inden">
                    Dengan hormat, bersama ini kami sampaikan bahwa dalam rangka melengkapi syarat-syarat pelaksanaan Skripsi, mahasiswa {{ $surat->mahasiswa->jurusan->jenjang }} {{ $surat->mahasiswa->jurusan->jurusan }} Fakultas {{ $surat->mahasiswa->jurusan->fakultas }} Universitas Hasyim Asy'ari Tebuireng perlu mendapatkan data dengan melakukan penelitian pada sebuah Lembaga/Institusi/Perusahaan.
                </td>
            </tr>
            <tr>
                <td colspan="4" class="justify inden">
                    Sehubungan dengan itu, kami mohon dapatlah kiranya mahasiswa yang namanya tercantum dibawah ini dizinkan untuk melakukan observasi di Lembaga/Institusi/Perusahaan di bawah pimpinan Bapak/Ibu. Adapun nama mahasiswa yang dimaksud sebagai berikut:
                </td>
            </tr>
            <tr>
                <td width="150px">Nama</td>
                <td width="5px" class="top-text" style="padding: 0px 0px 0px 0px">:</td>
                <td colspan="2" class="top-text" style="padding: 0px 0px 0px 5px">{{ $surat->mahasiswa->nama }}</td>
            </tr>
            <tr>
                <td width="150px">NIM</td>
                <td width="5px" class="top-text" style="padding: 0px 0px 0px 0px">:</td>
                <td colspan="2" class="top-text" style="padding: 0px 0px 0px 5px">{{ $surat->mahasiswa->nim }}</td>
            </tr>
            <tr>
                <td width="150px">Prodi</td>
                <td width="5px" class="top-text" style="padding: 0px 0px 0px 0px">:</td>
                <td colspan="2" class="top-text" style="padding: 0px 0px 0px 5px">{{ $surat->mahasiswa->jurusan->jenjang }} {{ $surat->mahasiswa->jurusan->jurusan }}</td>
            </tr>
            <tr>
                <td width="150px">Fakultas</td>
                <td width="5px" class="top-text" style="padding: 0px 0px 0px 0px">:</td>
                <td colspan="2" class="top-text" style="padding: 0px 0px 0px 5px">{{ $surat->mahasiswa->jurusan->fakultas }} </td>
            </tr>
            <tr>
                <td width="150px" class="top-text">Judul Skripsi</td>
                <td width="5px" class="top-text" style="padding: 0px 0px 0px 0px">:</td>
                <td colspan="2" class="top-text" style="padding: 0px 0px 0px 5px">{{ strip_tags($surat->judul_skripsi) }} </td>
            </tr>
            <tr>
                <td colspan="4" class="justify inden">
                    Pelaksanaan Observasi oleh mahasiswa tersebut dapat disesuaikan dengan jadwal yang ditentukan oleh Lembaga/Institusi/Perusahaan Bapak/Ibu.
                </td>
            </tr>
            <tr>
                <td colspan="4" class="justify inden">
                    Demikian permohonan ini kami sampaikan. Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <i>Wassalamu'alaikum warohmatullohi wabarokatuh,</i>,
                </td>
            </tr>
        </table>
        <br />
        <br />
        <table width="850px" class="ttd">
            <tr>
                <td width="350px"></td>
                <td width=""></td>
                <td width="350px">Jombang, {{ \App\Helpers\IndoTanggal::tanggal($surat->surat->created_at, false) }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Kaprodi {{ $kaprodi->jurusan->jurusan }}</td>
            </tr>
            <tr>
                <td height="80px"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><strong>{{ $kaprodi->nama }}</strong></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><strong>NIY: {{ $kaprodi->niy }}</strong></td>
            </tr>
        </table>
    </div>
</body>

</html>
