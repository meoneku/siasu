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
                    <h3>FORMULIR PENDAFTARAN SKRIPSI</h3>
                </td>
            </tr>
            <tr>
                <td colspan="3">Yang bertanda tangan dibawah ini :</td>
            </tr>
            <tr>
                <td width="150px">Nama</td>
                <td width="10px">:</td>
                <td>{{ $skripsi->mahasiswa->nama }}</td>
            </tr>
            <tr>
                <td width="150px">NIM</td>
                <td width="10px">:</td>
                <td>{{ $skripsi->mahasiswa->nim }}</td>
            </tr>
            <tr>
                <td width="150px">Prodi</td>
                <td width="10px">:</td>
                <td>{{ $skripsi->mahasiswa->jurusan->jenjang }} {{ $skripsi->mahasiswa->jurusan->jurusan }}</td>
            </tr>
            <tr>
                <td width="150px">Total SKS</td>
                <td width="10px">:</td>
                <td>{{ $skripsi->sks }}</td>
            </tr>
            <tr>
                <td width="150px">IPK</td>
                <td width="10px">:</td>
                <td>{{ $skripsi->ipk }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td colspan="3">Dengan ini mengajukan pendaftaran judul skripsi dengan judul :</td>
            </tr>
            <tr>
                <td colspan="3" class="justify"><strong><span>{!! $skripsi->judul_skripsi !!}</span></strong></td>
            </tr>
            <tr>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td colspan="3" style="padding-bottom:0px">Dan saya telah memenuhi syarat-syarat administrasi dan akademik sebagai berikut :</td>
            </tr>
            <tr>
                <td colspan="3">
                    <ol type="1">
                        <li>Telah melunasi pembayaran semester berjalan</li>
                        <li>Menyertakan foto kopi slip pembayaran semester</li>
                        <li>Menyertakan bukti telah melakukan pembayaran skripsi</li>
                        <li>Menyertakan foto kopi Kartu Hasil Studi (KHS)</li>
                        <li>Menyertakan foto kopi Kartu Rencana Studi (KRS) semester berjalan</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td colspan="3">Dosen Pembimbing (<i>Di Isi Oleh Koordinator Skripsi/Kaprodi</i>)</td>
            </tr>
            <tr>
                <td width="150px">Pembimbing</td>
                <td width="10px">:</td>
                <td>_________________________________________________________</td>
            </tr>
            <tr>
                <td width="150px">Mulai Tugas</td>
                <td width="10px">:</td>
                <td>_______________________________________</td>
            </tr>
            <tr>
                <td width="150px">Selesai Tugas</td>
                <td width="10px">:</td>
                <td>_______________________________________</td>
            </tr>
            <tr>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td colspan="3" class="justify"><span>Dengan ini saya melakukan pendaftaran Skripsi dengan Judul dan persyaratan yang telah ditentukan. Dan menyelesaikan Skripsi sesuai dengan waktu yang telah ditentukan oleh Prodi / Jurusan.</span></td>
            </tr>
        </table>
        <br />
        <table width="850px" class="ttd">
            <tr>
                <td width="320px">Jombang, {{ tanggal_indonesia($skripsi->created_at, false) }}</td>
                <td width=""></td>
                <td width="320px">Menyetujui</td>
            </tr>
            <tr>
                <td>Pendaftar</td>
                <td></td>
                <td>Koordinator Skripsi</td>
            </tr>
            <tr>
                <td height="80px"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"><u>{{ $skripsi->mahasiswa->nama }}</u></td>
                <td><u>{{ $koord->nama }}</u></td>
            </tr>
            <tr>
                <td>NIM : {{ $skripsi->mahasiswa->nim }}</td>
                <td></td>
                <td>NIY : {{ $koord->niy }}</td>
            </tr>
            <tr>
                <td height="20px"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Mengetahui</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Kaprodi</td>
                <td></td>
            </tr>
            <tr>
                <td height="80px"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2"><u>{{ $kaprodi->nama }}</u></td>
            </tr>
            <tr>
                <td></td>
                <td>NIY : {{ $kaprodi->niy }}</td>
                <td></td>
            </tr>
        </table>
        <br />
        <br />
        <span style="font-size:16px"><i>Catatan</i></span><br />
        <ul style="margin-top:0px">
            <li><i>FC (Fotocopy) 1 Lembar</i></li>
            <li><i>Lembar Copy Harap Serahkan Ke Prodi Setelah Mendapatkan Tanda Tangan Dan Pembimbing</i></li>
        </ul>
    </div>
</body>

</html>
