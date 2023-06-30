<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .doubleUnderline {
            text-decoration: underline;
            border-bottom: 2px solid #000;
            padding-bottom: 1px;
        }

        .tablekrip {
            border-collapse: collapse;
        }

        .tablekrip th {
            border: 1px solid black;
        }

        .tablekrip td {
            border: 1px solid black;
        }

        .noneline {
            border: none;
        }

        .noneline td {
            border: none;
        }
    </style>
    <title>Cetak Transkrip</title>
</head>

<body>
    <center>
        <table border="0" width="900px">
            <tr>
                <td align="center" rowspan="2" width="100"><img src="{{ url('img/UNHASY.png') }}" width="80px" height="80px"></td>
                <td align="left"><strong style="font-size:28px; font-family:Arial;">UNIVERSITAS HASYIM ASY'ARI</br>TEBUIRENG JOMBANG</strong></td>
            </tr>
            <tr>
                </td>
                <td>
                    <font class="doubleUnderline" style="font-size:12px; font-family:Arial;">Jl. Irian Jaya Nomor 55 Tebuireng Tromol Pos IX Jombang &nbsp;Jawa Timur Telepon (0321) 861719&nbsp; (Hunting),&nbsp; 864206, 851396, 874685 Fax. 874684</font>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td align="center" colspan="2"><strong style="font-size:18px; font-family:Arial;">
                        <center><strong><u>T R A N S K R I P&nbsp;&nbsp;&nbsp;A K A D E M I K @if (request('final') == 'false')
                                        &nbsp;S E M E N T A R A
                                    @endif
                                </u></br>
                                <font style="font-size:13px; font-family:Arial;">Nomor SK Akreditasi: {{ $lulusan->jurusan->nomor_akreditasi }}</font>
                        </center>
                    </strong></strong></td>
            </tr>
        </table>
        <table border="0" style="margin-top: 8px">
            <tr>
                <td width="425px" valign="top">
                    <table border="0" style="font-size:13px; font-family:Arial;">
                        <tr>
                            <td width="150px">Nama</td>
                            <td>:</td>
                            <td>{{ $lulusan->nama }}</td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal Lahir</td>
                            <td>:</td>
                            <td>{{ $lulusan->tempat_lahir . ', ' . \App\Helpers\IndoTanggal::tanggal($lulusan->tanggal_lahir, false) }}</td>
                        </tr>
                        <tr>
                            <td>Nomor Pokok Mahasiswa</td>
                            <td>:</td>
                            <td>{{ $lulusan->nim }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Kelulusan</td>
                            <td>:</td>
                            <td>{{ \App\Helpers\IndoTanggal::tanggal($lulusan->tanggal_lulus, false) }}</td>
                        </tr>
                    </table>
                </td>
                <td width="0px"></td>
                <td width="425px" valign="top">
                    <table border="0" style="font-size:13px; font-family:Arial;">
                        <tr>
                            <td>Fakultas</td>
                            <td>:</td>
                            <td>{{ $lulusan->jurusan->fakultas }}</td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td>:</td>
                            <td>{{ $lulusan->jurusan->jenjang . ' ' . $lulusan->jurusan->jurusan }}</td>
                        </tr>
                        @if (request('final') == 'true')
                            <tr>
                                <td width="150px">Nomor Transkrip</td>
                                <td>:</td>
                                @if (request('pin') == 'hide')
                                    <td>xxxxxxx</td>
                                @else
                                    <td>{{ $lulusan->nomorijazah }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td width="150px">Nomor Ijazah Nasional</td>
                                <td>:</td>
                                @if (request('pin') == 'hide')
                                    <td>xxxxxxxxxxxxxxxxxx</td>
                                @else
                                    <td>{{ $lulusan->pin }}</td>
                                @endif
                            </tr>
                        @endif
                    </table>
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0" style="font-size:12px; font-family:Arial; margin-top:10px" width="870px" class="tablekrip">
            <tr height="20px">
                <th width="20px">No</th>
                <th width="60px">Kode</th>
                <th width="258px">Mata Kuliah</th>
                <th width="25px">SKS</th>
                <th width="30px">Nilai</th>
                <th width="42px">AK</th>
                <th width="20px">No</th>
                <th width="60px">Kode</th>
                <th width="258px">Mata Kuliah</th>
                <th width="25px">SKS</th>
                <th width="30px">Nilai</th>
                <th width="42px">AK</th>
            </tr>
            @foreach ($nilai as $data)
                <tr valign="middle" align="center">
                    @if ($data['left_separator'] == 0)
                        <td height="20px">{{ $data['left_number'] }}</td>
                        <td>{{ $data['left_kd'] }}</td>
                        <td align="left" style="padding-left: 3px">{{ $data['left_mk'] }}</td>
                        <td>{{ $data['left_sks'] }}</td>
                        <td>{{ $data['left_nilai'] }}</td>
                        <td>{{ $data['left_huruf'] }}</td>
                    @else
                        <td height="20px" colspan="6"><strong>{{ $data['left_mk'] }}</strong></td>
                    @endif
                    @if ($data['right_separator'] == 0)
                        <td>{{ $data['right_number'] }}</td>
                        <td>{{ $data['right_kd'] }}</td>
                        <td align="left" style="padding-left : 3px">{{ $data['right_mk'] }}</td>
                        <td>{{ $data['right_sks'] }}</td>
                        <td>{{ $data['right_nilai'] }}</td>
                        <td>{{ $data['right_huruf'] }}</td>
                    @elseif($data['right_separator'] == 99)
                        <td height="20px" colspan="6"><strong></strong></td>
                    @else
                        <td height="20px" colspan="6"><strong>{{ $data['right_mk'] }}</strong></td>
                    @endif
                </tr>
            @endforeach
            <tr>
                <td colspan="6" rowspan="3" height="70px" valign="top" style="padding: 3px;">Judul Skripsi :<br />{!! $lulusan->judul_skripsi !!}</td>
                <td colspan="3" height="20px">&nbsp;Jumlah</td>
                <td align="center" colspan="2">{{ $JumlahSKS }}</td>
                <td align="center">{{ $JumlahNilai }}</td>
            </tr>
            <tr>
                <td colspan="3" height="20px">&nbsp;Indeks Prestasi Kumulatif</td>
                <td colspan="3">&nbsp;<strong>{{ $IPK }}</strong></td>
            </tr>
            <tr>
                <td colspan="3" height="20px">&nbsp;Predikat Kelulusan</td>
                <td colspan="3">&nbsp;<strong><span style="font-size:10px">{{ $Yudisium }}</span></strong></td>
            </tr>
            <tr>
                <td colspan="6" valign="top">&nbsp;Ekuivalen Hasil Penilaian:
                    <table border="0" style="font-size:12px; font-family:Arial;" width="435" class="noneline" cellpadding="0">
                        <tr>
                            <td width="10px">A</td>
                            <td width="5px">=</td>
                            <td width="126px">4.00</td>
                            <td width="10px">B</td>
                            <td width="5px">=</td>
                            <td width="126px">3.00</td>
                            <td width="10px">C</td>
                            <td width="5px">=</td>
                            <td width="126px">2.00</td>
                        </tr>
                        <tr>
                            <td>A-</td>
                            <td>=</td>
                            <td>3.75</td>
                            <td>B-</td>
                            <td>=</td>
                            <td>2.75</td>
                            <td>D</td>
                            <td>=</td>
                            <td>1.00</td>
                        </tr>
                        <tr>
                            <td>B+</td>
                            <td>=</td>
                            <td>3.50</td>
                            <td>C+</td>
                            <td>=</td>
                            <td>2.50</td>
                            <td>E</td>
                            <td>=</td>
                            <td>0.00</td>
                        </tr>
                    </table>
                </td>
                <td colspan="6" valign="top">&nbsp; Predikat Kelulusan : <br>
                    <table border="1" style="font-size:12px; font-family:Arial;" width="435" class="noneline" cellpadding="0">
                        @if (request('predikat') == 'useCumlaude')
                            <tr>
                                <td width="63">&nbsp;3.76 - 4.00</td>
                                <td width="5">=</td>
                                <td>Cumlaude</td>
                            </tr>
                            <tr>
                                <td>&nbsp;3.51 - 3.75</td>
                                <td>=</td>
                                <td>Sangat Memuaskan</td>
                            </tr>
                            <tr>
                                <td>&nbsp;3.01 - 3.50</td>
                                <td>=</td>
                                <td>Memuaskan</td>
                            </tr>
                            <tr>
                                <td>&nbsp;2.51 - 3.00</td>
                                <td>=</td>
                                <td>Cukup</td>
                            </tr>
                        @else
                            <tr>
                                <td width="63">&nbsp;2.00 - 2.75</td>
                                <td width="5">=</td>
                                <td>Memuaskan</td>
                            </tr>
                            <tr>
                                <td>&nbsp;2.76 - 3.50</td>
                                <td>=</td>
                                <td>Sangat Memuaskan</td>
                            </tr>
                            <tr>
                                <td>&nbsp;3.51 - 4.00</td>
                                <td>=</td>
                                <td>Dengan Pujian</td>
                            </tr>
                        @endif
                    </table>
                </td>
            </tr>
        </table>
        <table border="0" width="720px" style="font-size:13px; font-family:Arial; margin-top: 30px">
            <tr>
                <td width="200px">&nbsp;</td>
                <td width="120px"></td>
                <td width="85px" rowspan="10"></td>
                <td width="70"></td>
                <td width="225px">Jombang, @if (request('final') == 'false')
                        {{ \App\Helpers\IndoTanggal::tanggal($lulusan->tanggal_lulus, false) }}
                    @else
                        {{ \App\Helpers\IndoTanggal::tanggal($lulusan->tanggal_wisuda, false) }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>
                <td>
                    @if (request('final') == 'false')
                        Kaprodi {{ $lulusan->jurusan->jurusan }}
                    @else
                        Dekan
                    @endif
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                @php
                    if (request('final') == 'false') {
                        $dosen = App\Models\Dosen::where([['jabatan', 'Kaprodi'], ['jurusan_id', $lulusan->jurusan->id]])->first();
                        $ttd = $dosen->nama;
                        $niy = $dosen->niy;
                    } else {
                        $dosen = App\Models\Dosen::where('jabatan', 'Dekan')->first();
                        $ttd = $dosen->nama;
                        $niy = $dosen->niy;
                    }
                @endphp
                <td>&nbsp;</td>
                <td></td>
                <td></td>
                <td><strong><u>{{ $ttd }}</u><strong></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td></td>
                <td></td>
                <td><strong>NIY. {{ $niy }}</strong></td>
            </tr>
        </table>
    </center>
</body>

</html>
