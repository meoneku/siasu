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
    <title>Surat Tugas</title>
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
                <td class="top-text" style="padding: 0px 0px 0px 5px"><strong><u>Permohonan Izin Praktik Industri</strong></u></td>
            </tr>
        </table>
        <br />
        <br />
        <table width="850px" class="paragraf surat">
            <tr>
                <td width="115px">Kepada</td>
                <td width="5px" class="top-text" style="padding: 5px 0px 5px 0px">:</td>
                <td class="top-text" style="padding: 5px 0px 5px 5px">{{ $surat->tempat }}</td>
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
                    Guna meningkatkan pemahaman materi mata kuliah bagi mahasiswa Prodi {{ $surat->jurusan->jenjang }} {{ $surat->jurusan->jurusan }} Fakultas Teknik Universitas Hasyim Asy'ari Tebuireng Jombang, dengan ini kami mohon diberi izin untuk Praktik Industri. Yang rencana pelaksanaannya dilakukan pada tanggal {{ tanggal_indonesia($surat->mulai_tanggal, false) }} s.d. {{ tanggal_indonesia($surat->selesai_tanggal, false) }} . Adapun nama mahasiswa tersebut sebagai berikut :
                </td>
            </tr>
            <tr>
                <td colspan="4" class="justify">
                    <table width="800px" class="paragraf table-konten">
                        <tr>
                            <td width="25px" style="text-align:center"><strong>No</strong></td>
                            <td width="120px" style="text-align:center"><strong>NIM</strong></td>
                            <td><strong>Nama</strong></td>
                            <td width="200px" style="text-align:center"><strong>Prodi</strong></td>
                        </tr>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($surat->mahasiswa as $mahasiswa)
                            <tr>
                                <td style="text-align:center">{{ $no }}</td>
                                <td style="text-align:center">{{ $mahasiswa->nim }}</td>
                                <td>{{ $mahasiswa->nama }}</td>
                                <td style="text-align:center">{{ $mahasiswa->jurusan->jenjang }} {{ $mahasiswa->jurusan->jurusan }}</td>
                            </tr>
                            @php
                                $no++;
                            @endphp
                        @endforeach
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="justify inden">
                    Demikian atas kerjasama dan bantuannya kami sampaikan terima kasih.
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
                <td width="350px">Jombang, {{ tanggal_indonesia($surat->surat->created_at, false) }}</td>
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
