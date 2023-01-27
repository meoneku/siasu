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
                <td heigth="30px" colspan="3" style="text-align:center;">

                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:center;">
                    <strong><u><span style="font-size: 28px">SURAT TUGAS</u></strong><br />
                    Nomor : {{ $skripsi->no_surat }}
                </td>
            </tr>
            <tr>
                <td heigth="30px" colspan="3" style="text-align:center;">

                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:center;">
                    Tentang<br />
                    <strong>PENUGASAN DOSEN PEMBIMBING SKRIPSI MAHASISWA PRODI {{ strtoupper($skripsi->mahasiswa->jurusan->jurusan) }}</strong><br />
                    <strong>FAKULTAS TEKNIK UNIVERSITAS HASYIM ASY'ARI TEBUIRENG JOMBANG</strong>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:center;">
                    DEKAN FAKULTAS TEKNIK UNIVERSITAS HASYIM ASY'ARI
                </td>
            </tr>
            <tr>
                <td width="150px" class="top-text">Menimbang</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">Bahwa untuk mewujudkan visi dan misi Fakultas Teknik Universitas Hasyim Asy’ari Tebuireng Jombang perlu ditunjuk pembimbing skripsi.</td>
            </tr>
            <tr>
                <td width="150px" class="top-text">Mengingat</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">
                    <ol>
                        <li>Undang-Undang Republik lndonesia Nomor 20 Tahun 2003 tentang Sistem Pendidikan Nasional</li>
                        <li>Peraturan Pemerintah Republik Indonesia Nomor 19 Tahun 2005 tentang Standar Nasional Pendidikan</li>
                        <li>Undang-Undang Nomor 12 Tahun 2012 tentang Pendidikan Tinggi</li>
                        <li>Permen No 49 Th 2014 tentang Standar Nasional Pendidikan Tinggi</li>
                        <li>Perrmen No 50 Th 2014 ttg Sistem Penjaminan Mutu PT</li>
                        <li>Keputusan Menteri Pendidikan dan Kebudayaan RI No. 278/E/O/20l3 tentang Izin Pendirian Universitas Hasyim Asy’ari</li>
                        <li>Statuta Universitas Hasyim Asy’ari</li>
                        <li>SK Yayasan tentang pengangkatan sebagai Dekan Fakultas Teknik</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td heigth="30px" colspan="3" style="text-align:center;">

                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:center;">
                    <strong>MENUGASKAN</strong>
                </td>
            </tr>
            <tr>
                <td width="150px" class="top-text">Kepada</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">
                    <ol>
                        @foreach($skripsi->dosen as $dosen)
                            <li><strong>{{ $dosen->nama }}</strong></li>
                        @endforeach
                    </ol>
                </td>
            </tr>
            <tr>
                <td width="150px" class="top-text">Untuk</td>
                <td width="10px" class="top-text">:</td>
                <td class="top-text">
                    <ol>
                        <li>Melaksanakan tugas sebagai Pembimbing Skripsi Mahasiswa Prodi {{ $skripsi->mahasiswa->jurusan->jenjang }} {{ $skripsi->mahasiswa->jurusan->jurusan }} {{ $skripsi->mahasiswa->jurusan->fakultas }} melaksanakan tugas sebagai Pembimbing Skripsi</li>
                        <li>Bimbingan dilaksanakan terhadap mahasiswa :<br /> Nama<span class="tab1"></span>: {{ $skripsi->mahasiswa->nama }}<br />NIM<span class="tab2"></span>: {{ $skripsi->mahasiswa->nim }}<br />Judul Skripsi : {{ strip_tags($skripsi->judul_skripsi) }}</li>
                        <li>Kegiatan bimbingan dilaksanakan sejak tanggal dikeluarkannya Surat Tugas ini dan agar mahasiswa menghubungi dan berkonsultasi dengan pembimbing.</li>
                        <li>Pelaksanaan penulisan proposal skripsi dan penelitian dimulai sejak ditanda tangani Surat Tugas ini.</li>
                        <li>Melaksanakan bimbingan proposal 3 (tiga) kali dan bimbingan skripsi minimal 6 (enam) kali sampai selesai penyusunan skripsi</li>
                        <li>Surat Tugas ini berlaku sampai tanggal <strong>{{ tanggal_indonesia($selesai, false) }}</strong></li>
                    </ol>
                </td>
            </tr>
        </table>
        <br />
        <table width="850px" class="ttd">
            <tr>
                <td width="320px"></td>
                <td width=""></td>
                <td width="320px">Ditetapkan di : Jombang</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Pada Tanggal : {{ tanggal_indonesia($skripsi->surat->created_at, false) }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Dekan Fakultas Teknik</td>
            </tr>
            <tr>
                <td height="80px"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td><u><strong>{{ $dekan->nama }}</strong></u></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><strong>NIY : {{ $dekan->niy }}</strong></td>
            </tr>
        </table>
    </div>
</body>

</html>
