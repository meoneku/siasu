<?php

namespace App\Http\Controllers;

use App\Models\Lulusan;
use App\Models\Jurusan;
use App\Models\Nilai;
use App\Models\Kata;
use Illuminate\Http\Request;

class TranskripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.transkrip.index', [
            'title'     => 'Mahasiswa | Transkrip',
            'lulusan'   => Lulusan::with('jurusan')->filter(request(['nama', 'jurusan', 'tahun']))->paginate(6)->withQueryString(),
            'jurusan'   => Jurusan::all()
        ]);
    }

    public function edit(Request $request)
    {
        $nim = $request->nim;

        $request->session()->put('back_url', url()->previous());

        return redirect('webmin/nilai?nim=' . $nim);
    }

    public function print(Request $request)
    {
        $mata_kuliah = Nilai::where('nim', $request->nim)->distinct()->orderBy('mk_jenis', 'asc')->orderBy('level', 'asc')->get(['kd_mk', 'mk_jenis', 'level']);
        $countNilai = collect([]);
        $mkJenis = 0;
        $jumlahSKS = 0;
        $jumlahNilai = 0;
        $no = 1;

        foreach ($mata_kuliah as $mk) {
            $cek_mk = Nilai::where([['nim', $request->nim], ['kd_mk', $mk['kd_mk']]])->get();
            $cari_nilai = collect([]);

            if ($request->separator == 'active') {
                if ($mkJenis != $mk->mk_jenis) {
                    if ($request->kurikulum == 'kkni') {
                        $separat = $this->ConvertMKJenisKKNI($mk->mk_jenis);
                    } elseif ($request->kurikulum == 'merdeka') {
                        $separat = $this->ConvertMKJenisMB($mk->mk_jenis);
                    } else {
                        $separat = $this->ConvertMKJenisKKNI($mk->mk_jenis);
                    }
                    $countNilai->push([
                        'no'            => 0,
                        'separator'     => $mk->mk_jenis,
                        'kdmk'          => 0,
                        'mk'            => $separat,
                        'sks'           => 0,
                        'nilai'         => 0
                    ]);
                }
            }

            $mkJenis = $mk->mk_jenis;

            foreach ($cek_mk as $cmk) {
                $cari_nilai->push([
                    'no'            => $no,
                    'separator'     => 0,
                    'kdmk'          => $cmk->kd_mk,
                    'mk'            => $cmk->mata_kuliah,
                    'sks'           => $cmk->sks,
                    'nilai'         => $cmk->nilai,
                ]);
            }
            $sorted = $cari_nilai->sortByDesc('nilai')->first();
            $stringMK = preg_replace_callback(
                '/\b(?=[LXIVCDM]+\b)([a-z]+)\b/i',
                function ($matches) {
                    return strtoupper($matches[0]);
                },
                ucwords(strtolower($sorted['mk']))
            );

            $String_MK_MAP = implode('-', array_map('ucfirst', explode('-', $stringMK)));
            $stringMataKuliah = $this->gantiKata($String_MK_MAP);

            $countNilai->push([
                'no'            => $sorted['no'],
                'separator'     => $sorted['separator'],
                'kdmk'          => $sorted['kdmk'],
                'mk'            => $stringMataKuliah,
                'sks'           => $sorted['sks'],
                'nilai'         => $sorted['nilai'],
            ]);
            $jumlahSKS += $sorted['sks'];
            $jumlahNilai += $sorted['nilai'] * $sorted['sks'];
            $no++;
        }
        //dd($countNilai);
        $IPK = number_format(round($jumlahNilai / $jumlahSKS, 2), 2);
        $Yudisium = $this->cariYudisium($IPK);

        $nilai = [];
        $count = $countNilai->count();

        if ($count % 2 == 0) {
            $left_count = $count / 2;
            $genap = true;
        } else {
            $pcount = $count + 1;
            $left_count = $pcount / 2;
            $genap = false;
        }

        $left_index = $left_count - 1;
        $start_right_index = $left_count;
        $right_index = $count - 1;

        for ($i = 0; $i <= $left_index; $i++) {
            $left_number        = $countNilai[$i]['no'];
            $left_separator     = $countNilai[$i]['separator'];
            $left_kd            = $countNilai[$i]['kdmk'];
            $left_mk            = $countNilai[$i]['mk'];
            $left_sks           = $countNilai[$i]['sks'];
            $left_nilai         = $countNilai[$i]['nilai'];
            $left_huruf         = $this->cariNilaiHuruf($countNilai[$i]['nilai']);
            if ($genap == false) {
                if ($start_right_index > $right_index) {
                    $right_number       = 0;
                    $right_separator    = 99;
                    $right_kd           = 0;
                    $right_mk           = '-';
                    $right_sks          = 0;
                    $right_nilai        = 0;
                    $right_huruf        = 'Z';
                } else {
                    $right_number       = $countNilai[$start_right_index]['no'];
                    $right_separator    = $countNilai[$start_right_index]['separator'];
                    $right_kd           = $countNilai[$start_right_index]['kdmk'];
                    $right_mk           = $countNilai[$start_right_index]['mk'];
                    $right_sks          = $countNilai[$start_right_index]['sks'];
                    $right_nilai        = $countNilai[$start_right_index]['nilai'];
                    $right_huruf        = $this->cariNilaiHuruf($countNilai[$start_right_index]['nilai']);
                }
            } else {
                $right_number       = $countNilai[$start_right_index]['no'];
                $right_separator    = $countNilai[$start_right_index]['separator'];
                $right_kd           = $countNilai[$start_right_index]['kdmk'];
                $right_mk           = $countNilai[$start_right_index]['mk'];
                $right_sks          = $countNilai[$start_right_index]['sks'];
                $right_nilai        = $countNilai[$start_right_index]['nilai'];
                $right_huruf        = $this->cariNilaiHuruf($countNilai[$start_right_index]['nilai']);
            }
            array_push($nilai, [
                'left_number'       => $left_number,
                'left_separator'    => $left_separator,
                'left_kd'           => $left_kd,
                'left_mk'           => $left_mk,
                'left_sks'          => $left_sks,
                'left_nilai'        => $left_nilai,
                'left_huruf'        => $left_huruf,
                'right_number'      => $right_number,
                'right_separator'   => $right_separator,
                'right_kd'          => $right_kd,
                'right_mk'          => $right_mk,
                'right_sks'         => $right_sks,
                'right_nilai'       => $right_nilai,
                'right_huruf'       => $right_huruf
            ]);

            $start_right_index++;
        }

        return view('dashboard.transkrip.print', [
            'nilai'     => $nilai,
            'lulusan'   => Lulusan::where('nim', $request->nim)->first(),
            'JumlahSKS' => $jumlahSKS,
            'JumlahNilai' => $jumlahNilai,
            'IPK'       => $IPK,
            'Yudisium'  => $Yudisium
        ]);
    }

    public function gantiKata($kalimat)
    {
        $kataCari  = [];
        $kataGanti = [];

        $kata = Kata::all();
        foreach ($kata as $data) {
            array_push($kataCari, $data->kata_cari);
            array_push($kataGanti, $data->kata_ganti);
        }

        $result = str_ireplace($kataCari, $kataGanti, $kalimat);

        return $result;
    }

    public static function ConvertMKJenisKKNI($data)
    {
        if ($data == 1) {
            $result = "Mata Kuliah Pengembangan Kepribadian (MPK) Inti";
        } elseif ($data == 2) {
            $result = "Mata Kuliah Pengembangan Kepribadian (MPK) Instisusional";
        } elseif ($data == 3) {
            $result = "Mata Kuliah Keilmuan dan Ketrampilan (MKK)";
        } elseif ($data == 4) {
            $result = "Mata Kuliah Keahlian Berkarya (MKB)";
        } elseif ($data == 5) {
            $result = "Mata Kuliah Perilaku Berkarya (MPB)";
        } elseif ($data == 6) {
            $result = "Mata Kuliah Berkehidupan Bermasyarakat (MBB)";
        } else {
            $result = "Error";
        }

        return $result;
    }

    public function ConvertMKJenisMB($data)
    {
        if ($data == 1) {
            $result = "Mata Kuliah Wajib Nasional (MKWN)";
        } elseif ($data == 2) {
            $result = "Mata Kuliah Di Luar Prodi Dalam Perguruan Tinggi (MLPD)";
        } elseif ($data == 3) {
            $result = "Mata Kuliah Wajib Program Studi (MKWP)";
        } elseif ($data == 4) {
            $result = "Mata Kuliah Pilihan (MKL)";
        } elseif ($data == 5) {
            $result = "Mata Kuliah Peminatan (MKP)";
        } elseif ($data == 6) {
            $result = "Mata Kuliah Tugas Akhir (MTA)";
        } else {
            $result = "Error";
        }

        return $result;
    }

    public function cariNilaiHuruf($nilai)
    {
        if ($nilai == 4) {
            $result = "A";
        } elseif ($nilai == 3.75) {
            $result = "A-";
        } elseif ($nilai == 3.5) {
            $result = "B+";
        } elseif ($nilai == 3) {
            $result = "B";
        } elseif ($nilai == 2.75) {
            $result = "B-";
        } elseif ($nilai == 2.5) {
            $result = "C+";
        } elseif ($nilai == 2) {
            $result = "C";
        } elseif ($nilai == 1) {
            $result = "D";
        } elseif ($nilai == 0) {
            $result = "E";
        }
        return $result;
    }

    public function cariYudisium($ipk)
    {
        if ($ipk <= 2.75) {
            $result = "Memuaskan";
        } elseif ($ipk <= 3.5) {
            $result = "Sangat Memuaskan";
        } elseif ($ipk >= 3.51) {
            $result = "Dengan Pujian";
        }
        return $result;
    }
}
