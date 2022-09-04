<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.nilai.index', [
            'title'     => 'Mahasiswa | Data Nilai',
            'nilai'   => Nilai::latest()->with('mahasiswa')->filter(request(['nim', 'jurusan', 'semester', 'mk', 'nama']))->paginate(10)->withQueryString(),
            'jurusan'   => Jurusan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.nilai.create', [
            'title'     => 'Mahasiswa | Data Nilai',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData   = $request->validate([
            'nim'           => 'required|max:11',
            'kd_mk'         => 'required|max:10',
            'mata_kuliah'   => 'required|max:200',
            'mk_jenis'      => 'required',
            'level'         => 'required',
            'sks'           => 'required|max:2',
            'nilai'         => 'required',
            'semester'      => 'required',
        ]);

        Nilai::create($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Mata Kuliah' . $request->mata_kuliah . ' Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show(Nilai $nilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit(Nilai $nilai)
    {
        return view('dashboard.nilai.edit', [
            'title'     => 'Mahasiswa | Data Nilai',
            'nilai'     => $nilai
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nilai $nilai)
    {
        $validateData   = $request->validate([
            'nim'           => 'required|max:11',
            'kd_mk'         => 'required|max:10',
            'mata_kuliah'   => 'required|max:200',
            'mk_jenis'      => 'required',
            'level'         => 'required',
            'sks'           => 'required|max:2',
            'nilai'         => 'required',
            'semester'      => 'required',
        ]);

        Nilai::where('id', $nilai->id)
            ->update($validateData);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nilai $nilai, Request $request)
    {
        Nilai::destroy($nilai->id);
        return redirect($request->redirect_to)->with('success', 'Data Berhasil Di Hapus');
    }

    public function import()
    {
        return view('dashboard.nilai.import', [
            'title'     => 'Mahasiswa | Data Nilai',
        ]);
    }

    public function impStore(Request $request)
    {
        $file = $request->file('file');
        $semester = $request->semester;
        $validData = [];

        $openfile = fopen($file, "r");
        libxml_use_internal_errors(true);
        $htmlContent = file_get_contents($file);

        $DOM = new \DOMDocument();
        $DOM->loadHTML($htmlContent);

        /*** discard white space ***/
        $DOM->preserveWhiteSpace = false;

        /*** the table by its tag name ***/
        $tables = $DOM->getElementsByTagName('table');

        /*** get all rows from the table ***/

        $rows = $tables->item(2)->getElementsByTagName('tr');

        /*** loop over the table rows ***/
        $i = count($rows);
        $j = 0;
        $k = $i - $j;
        $num = 1;
        for ($j = 2; $j < $k; $j++) {
            /*** get each column by tag name ***/
            $cols = $rows->item($j)->getElementsByTagName('td');

            $nim = trim($cols->item(1)->nodeValue, "\xC2\xA0");
            $nimcetak = str_replace(" ", "", $nim);

            $sks = substr($cols->item(6)->nodeValue, 0, 1);

            $indeksnilai = trim($cols->item(9)->nodeValue, "\xC2\xA0");
            $mk = $cols->item(5)->nodeValue;

            $kduniv = substr($cols->item(4)->nodeValue, 0, 2);
            $kdlevel = 0;
            if ($kduniv == 90) {
                $kdlevel = 1;
            } else if ($kduniv > 90) {
                $kdlevel = 2;
            } else {
                $kdlevel = 3;
            }

            $jenismk = substr($cols->item(4)->nodeValue, 2, 1);

            $num++;

            array_push($validData, [
                'nim'           => $nimcetak,
                'kd_mk'         => $cols->item(4)->nodeValue,
                'mata_kuliah'   => $mk,
                'mk_jenis'      => $jenismk,
                'level'         => $kdlevel,
                'sks'           => $sks,
                'nilai'         => $indeksnilai,
                'semester'      => $semester
            ]);
        }
        Nilai::insert($validData);
        return redirect('webmin/nilai')->with('success', 'Data Sejumlah ' . $num . ' Berhasil Di Simpan');
    }

    public function pindah()
    {
        return view('dashboard.nilai.pindah', [
            'title'     => 'Mahasiswa | Data Nilai Pindahan',
        ]);
    }

    public function pindahStore(Request $request)
    {
        $file = $request->file('file');
        $semester = $request->semester;
        $validData = [];

        $openfile = fopen($file, "r");
		libxml_use_internal_errors(true);
		$htmlContent = file_get_contents($file);
			
		$DOM = new \DOMDocument();
		$DOM->loadHTML($htmlContent);
	
		/*** discard white space ***/ 
		$DOM->preserveWhiteSpace = false; 
   
		/*** the table by its tag name ***/ 
		$tables = $DOM->getElementsByTagName('table'); 
   
		/*** get all rows from the table ***/

		$rows = $tables->item(2)->getElementsByTagName('tr');
   
		/*** loop over the table rows ***/ 
        $num = 1;
		$i = count($rows);
		$j = 0;
		$k = $i - $j;
		for($j = 2; $j < $k; $j++)
		{
			/*** get each column by tag name ***/ 
			$cols = $rows->item($j)->getElementsByTagName('td'); 
			
			$nim = trim($cols->item(1)->nodeValue,"\xC2\xA0");
			$nimcetak = str_replace(" ","",$nim);

			$tmprodi = substr($nimcetak,4,2);

			$cekprodi = substr($tmprodi,0,1);
			if($cekprodi == "0"){
				$prodi = str_replace("0", "", $tmprodi);
			} else {
				$prodi = $tmprodi;
			}
				
			$sks = substr($cols->item(11)->nodeValue,0,1);
			
			$indeksnilai = $cols->item(13)->nodeValue;
			$mk = $cols->item(10)->nodeValue;

			$kduniv = substr($cols->item(9)->nodeValue, 0, 2);
			$kdlevel = 0;
			if($kduniv == 90) {
				$kdlevel = 1;
			} else if ($kduniv > 90) {
				$kdlevel = 2;
			} else {
				$kdlevel = 3;
			}

			$jenismk = substr($cols->item(9)->nodeValue, 2, 1);

            array_push($validData, [
                'nim'           => $nimcetak,
                'kd_mk'         => $cols->item(9)->nodeValue,
                'mata_kuliah'   => $mk,
                'mk_jenis'      => $jenismk,
                'level'         => $kdlevel,
                'sks'           => $sks,
                'nilai'         => $indeksnilai,
                'semester'      => $semester
            ]);

            $num++;
		}

        //Nilai::insert($validData);
        return redirect('webmin/nilai')->with('success', 'Selamat Anda Kena Prank Data Sejumlah ' . $num . ' Tidak Berhasil Di Simpan');
    }

    public static function ConvertSemester($semester)
    {
        $lastValue = substr($semester, 4);
        $year = substr($semester, 0, 4);
        $nextYear = $year + 1;
        if ($lastValue == 1) {
            $result = 'Gasal ' . $year . '/' . $nextYear;
        } else {
            $result = 'Genap ' . $year . '/' . $nextYear;
        }
        return $result;
    }

    public static function ConvertMKJenis($data)
    {
        if ($data == 1) {
            $result = "Mata Kuliah Pengembangan Kepribadian (MPK) Inti / Mata Kuliah Wajib Nasional (MKWN)";
        } elseif ($data == 2) {
            $result = "Mata Kuliah Pengembangan Kepribadian (MPK) Instisusional / Mata Kuliah Di Luar Prodi Dalam Perguruan Tinggi (MLPD)";
        } elseif ($data == 3) {
            $result = "Mata Kuliah Keilmuan dan Ketrampilan (MKK) / Mata Kuliah Wajib Program Studi (MKWP)";
        } elseif ($data == 4) {
            $result = "Mata Kuliah Keahlian Berkarya (MKB) / Mata Kuliah Pilihan (MKL)";
        } elseif ($data == 5) {
            $result = "Mata Kuliah Perilaku Berkarya (MPB) / Mata Kuliah Peminatan (MKP)";
        } elseif ($data == 6) {
            $result = "Mata Kuliah Berkehidupan Bermasyarakat (MBB) / Mata Kuliah Tugas Akhir (MTA)";
        } else {
            $result = "Error";
        }

        return $result;
    }

    public static function ConvertMKLevel($data)
    {
        if ($data == 1) {
            $result = "Universitas";
        } elseif ($data == 2) {
            $result = "Fakultas";
        } elseif ($data == 3) {
            $result = "Prodi/Jurusan";
        } else {
            $result = "Error";
        }

        return $result;
    }
}
