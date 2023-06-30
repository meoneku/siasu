<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Kop Teknik Change If Needed --}}
    <link rel="stylesheet" href="{{ url('css/kop.teknik.css') }}">
    <title>Form Pendaftaran</title>
</head>

<body class="container" onload="window.print()">
    @include('dashboard.kop.teknik')
    <div class="kontent">
        <table width="850px" class="paragraf">
            <tr>
                <td colspan="3" style="text-align:center;">
                    <h3>
                        FORMULIR PENDAFTARAN PRAKTIK INDUSTRI / KERJA PRAKTIK
                    </h3>
                </td>
            </tr>
            <tr>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td width="200px">Nama</td>
                <td width="10px">:</td>
                <td>{{ $kppi->mahasiswa->nama }}</td>
            </tr>
            <tr>
                <td width="200px">NIM</td>
                <td width="10px">:</td>
                <td>{{ $kppi->mahasiswa->nim }}</td>
            </tr>
            <tr>
                <td width="200px">Prodi</td>
                <td width="10px">:</td>
                <td>{{ $kppi->mahasiswa->jurusan->jenjang }} {{ $kppi->mahasiswa->jurusan->jurusan }}</td>
            </tr>
            <tr>
                <td width="200px">No Hanphone</td>
                <td width="10px">:</td>
                <td>{{ $kppi->hp }}</td>
            </tr>
            <tr>
                <td width="200px">Tempat</td>
                <td width="10px">:</td>
                <td>{{ $kppi->lokasi }}</td>
            </tr>
            <tr>
                <td width="200px">Waktu Pelaksanaan</td>
                <td width="10px">:</td>
                <td>{{ \App\Helpers\IndoTanggal::tanggal($kppi->mulai, false) }} s/d {{ \App\Helpers\IndoTanggal::tanggal($kppi->selesai, false) }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td colspan="3" class="justify">Saya berjanji akan mematuhi semua peraturan yang berlaku selama pelaksanaan Praktik Industri/ Kerja Praktik yang di tetapkan oleh Kantor/Intansi/Lembaga/Perusahaan dan Fakultas Teknik Universitas Hasyim Asy'ari Tebuireng Jombang.</td>
            </tr>
            <tr>
                <td colspan="3"></td>
            </tr>
        </table>
        <br />
        <table width="850px" class="ttd">
            <tr>
                <td width="320px">Jombang, {{ \App\Helpers\IndoTanggal::tanggal($kppi->created_at, false) }}</td>
                <td width=""></td>
                <td width="320px">Menyetujui</td>
            </tr>
            <tr>
                <td>Pendaftar</td>
                <td></td>
                <td>Kaprodi {{ $kppi->mahasiswa->jurusan->jurusan }}</td>
            </tr>
            <tr>
                <td height="100px"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"><u>{{ $kppi->mahasiswa->nama }}</u></td>
                <td><u><u>{{ $kaprodi->nama }}</u></u></td>
            </tr>
            <tr>
                <td>NIM : {{ $kppi->mahasiswa->nim }}</td>
                <td></td>
                <td>NIY : {{ $kaprodi->niy }}</td>
            </tr>
        </table>
        <br />
        <br />
        <span style="font-size:16px"><i>Lampiran</i></span><br />
        <ul style="margin-top:0px">
            <li><i>Bukti Pembayaran Praktik Industri/Kerja Praktik</i></li>
            <li><i>Surat balasan diterima dari tempat Praktik Industri/Kerja Praktik</i></li>
        </ul>
    </div>
</body>

</html>
