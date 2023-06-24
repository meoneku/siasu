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

        .jadwal {
            font-size: 16px;
        }

        .jadwal th {
            padding: 0px 0px 0px 0px;
            border: 1px solid black;
            border-collapse: collapse;
        }

        .jadwal td {
            padding: 5px 5px 5px 5px;
            border: 1px solid black;
            border-collapse: collapse;
        }

        .kontent1 {
            font-family: "Times New Roman", Times, serif;
            padding: 0px 10px 0px 10px;
        }
    </style>
    <title>Jadwal Seminar</title>
</head>

<body class="container" onload="window.print()">
    <div class="kontent1">
        <table width="100%" class="paragraf">
            <tr>
                <td height="10px" style="text-align:center;">

                </td>
            </tr>
            <tr>
                <td style="text-align:center;">
                    <strong><span style="font-size: 18px">DATA PENDAFTARA SKRIPSI</strong>
                </td>
            </tr>
            {{-- <tr>
                <td style="text-align:center;">
                    <strong><span style="font-size: 18px">PRODI {{ strtoupper($jurusan->jenjang) }} {{ strtoupper($jurusan->jurusan) }} FAKULTAS {{ strtoupper($jurusan->fakultas) }} UNIVERSITAS HASYIM ASY'ARI TEBUIRENG JOMBANG</strong>
                </td>
            </tr> --}}
            {{-- <tr>
                <td style="text-align:center;">
                    <strong><span style="font-size: 18px">TAHUN {{ $batch->tahun }}</strong>
                </td>
            </tr> --}}
        </table>
        <br />
        <table width="100%" class="jadwal">
            <tr>
                <th>No.</th>
                <th>Tanggal Daftar</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Judul</th>
                <th>Lokasi Penelitian</th>
                <th>Nomor HP</th>
                <th>Email</th>
                <th>Pembimbing</th>
                <th>SKS</th>
                <th>IPK</th>
            </tr>
            @foreach ($skripsi as $data)
                <tr>
                    <td style="margin-left: 20px">{{ $loop->iteration }}</td>
                    <td>{{ tanggal_indonesia($data->created_at) }}</td>
                    <td>{{ $data->mahasiswa->nim }}</td>
                    <td>{{ $data->mahasiswa->nama }}</td>
                    <td>{{ $data->mahasiswa->jurusan->jurusan }}</td>
                    <td class="justify">{{ strip_tags($data->judul_skripsi) }}</td>
                    <td class="justify">{{ $data->lokasi_penelitian }}</td>
                    <td>{{ $data->nomor_handphone }}</td>
                    <td>{{ $data->email }}</td>
                    <td width="20%">
                        @foreach ($data->dosen as $dosen)
                            {{ $dosen->nama }}<br />
                        @endforeach
                    </td>
                    <td>{{ $data->sks }}</td>
                    <td>{{ $data->ipk }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>