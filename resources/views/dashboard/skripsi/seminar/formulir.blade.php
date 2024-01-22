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
                    <h3>FORMULIR PENDAFTARAN SEMINAR SKRIPSI</h3>
                </td>
            </tr>
            <tr>
                <td colspan="3">Yang bertanda tangan dibawah ini :</td>
            </tr>
            <tr>
                <td width="150px">Nama</td>
                <td width="10px">:</td>
                <td>{{ $seminar->mahasiswa->nama }}</td>
            </tr>
            <tr>
                <td width="150px">NIM</td>
                <td width="10px">:</td>
                <td>{{ $seminar->mahasiswa->nim }}</td>
            </tr>
            <tr>
                <td width="150px">Prodi</td>
                <td width="10px">:</td>
                <td>{{ $seminar->mahasiswa->jurusan->jenjang }} {{ $seminar->mahasiswa->jurusan->jurusan }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td colspan="3">Dengan ini mengajukan pendaftaran Seminar Skripsi dengan judul :</td>
            </tr>
            <tr>
                <td colspan="3" class="justify"><strong><span>{!! $seminar->judul_skripsi !!}</span></strong></td>
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
                        <li>Menyertakan Foto Kopi KRS Berjalan Yang Telah Di Setujui</li>
                        <li>Telah Melakukan Pembayaran Seminar Proposal</li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td colspan="3">Dosen Penguji (<i>Di Isi Oleh Kaprodi</i>)</td>
            </tr>
            <tr>
                <td width="150px">Penguji 1</td>
                <td width="10px">:</td>
                <td>_________________________________________________________</td>
            </tr>
            <tr>
                <td width="150px">Penguji 2</td>
                <td width="10px">:</td>
                <td>_________________________________________________________</td>
            </tr>
            <tr>
                <td width="150px">Penguji 3</td>
                <td width="10px">:</td>
                <td>_________________________________________________________</td>
            </tr>
            <tr>
                <td width="150px">Waktu Seminar</td>
                <td width="10px">:</td>
                <td>_____________________________________Jam_________________</td>
            </tr>
            <tr>
                <td width="150px">Ruang</td>
                <td width="10px">:</td>
                <td>_______________________________________</td>
            </tr>
            <tr>
                <td colspan="3"></td>
            </tr>
            <tr>
                <td colspan="3" class="justify"><span>Dengan ini saya melakukan pendaftaran Seminar Skripsi dengan Judul Diatas.</span></td>
            </tr>
        </table>
        <br />
        <table width="850px" class="ttd">
            <tr>
                <td width="320px">Jombang, {{ \App\Helpers\IndoTanggal::tanggal($seminar->created_at, false) }}</td>
                <td width=""></td>
                <td width="320px">Menyetujui</td>
            </tr>
            <tr>
                <td>Pendaftar</td>
                <td></td>
                <td>Kaprodi</td>
            </tr>
            <tr>
                <td height="80px"></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"><u>{{ $seminar->mahasiswa->nama }}</u></td>
                <td><u>{{ $kaprodi->nama }}</u></td>
            </tr>
            <tr>
                <td>NIM : {{ $seminar->mahasiswa->nim }}</td>
                <td></td>
                <td>NIY : {{ $kaprodi->niy }}</td>
            </tr>
            <tr>
                <td height="20px"></td>
                <td></td>
                <td></td>
            </tr>
            {{-- <tr>
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
            </tr> --}}
        </table>
        <br />
        <br />
        <span style="font-size:16px"><i>Catatan</i></span><br />
        <ul style="margin-top:0px">
            <li><i>FC (Fotocopy) 1 Lembar</i></li>
            <li><i>Lembar Copy Harap Serahkan Ke Prodi Setelah Mendapatkan Persetujuan Kaprodi</i></li>
        </ul>
    </div>
</body>

</html>
