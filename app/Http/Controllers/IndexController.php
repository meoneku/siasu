<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\Bem;
use App\Models\Berita;
use App\Models\Dosen;
use App\Models\Fasilitas;
use App\Models\Hmp;
use App\Models\Jurusan;
use App\Models\Kalender;
use App\Models\Kategori;
use App\Models\Kemahasiswaan;
use App\Models\Kerjasama;
use App\Models\Pengumuman;
use App\Models\Prodi;
use App\Models\Profil;
use App\Models\Sejarah;
use App\Models\Visi;
use App\Models\Lab;
use App\Models\Mahasiswa;

class IndexController extends Controller
{
    public function index()
    {
        return view('index', [
           'fasilitas'     => Fasilitas::all(),
           'kerjasama'     => Kerjasama::all(),
           'sejarah'       => Sejarah::find(1),
           'berita'        => Berita::orderBy('publish_at', 'desc')->limit(3)->get(),
           'banner'        => Berita::where('is_banner', 'yes')->orderBy('publish_at', 'desc')->get()
        ]);
        // return view('dashboard.notfound');
    }

    public function skripsi()
    {
        $now = date('Y-m-d');
        $batch = Batch::where('kegiatan_id', 4)->whereRaw('? between mulai and selesai', $now)->first();
        return view('skripsi.skripsi', [
            'batch'     => $batch
        ]);
    }

    public function seminar()
    {
        $now = date('Y-m-d');
        $batch = Batch::where('kegiatan_id', 5)->whereRaw('? between mulai and selesai', $now)->first();
        return view('skripsi.seminar', [
            'batch'     => $batch
        ]);
    }

    public function semhas()
    {
        $now = date('Y-m-d');
        $batch = Batch::where('kegiatan_id', 6)->whereRaw('? between mulai and selesai', $now)->first();
        return view('skripsi.semhas', [
            'batch'     => $batch
        ]);
    }

    public function kppi()
    {
        $now = date('Y-m-d');
        $batch = Batch::where('kegiatan_id', 1)->whereRaw('? between mulai and selesai', $now)->first();
        return view('kppi', [
            'batch'     => $batch
        ]);
    }

    public function suratpi()
    {
        return view('surat.pi', [
            'jurusan'      => Jurusan::all()
        ]);
    }

    public function suratobservasi()
    {
        return view('surat.observasi');
    }

    public function ambildata()
    {
        return view('surat.ambildata');
    }

    public function suket()
    {
        return view('surat.suket');
    }

    public function layanan()
    {
        return view('layanan');
    }

    public function sejarah()
    {
        return view('sejarah', [
            'sejarah'   => Sejarah::find(1)
        ]);
    }

    public function visi(Visi $visi)
    {
        return view('visi', [
            'visi'      => $visi
        ]);
    }

    public function profil(Profil $profil)
    {
        return view('profil', [
            'profil'      => $profil
        ]);
    }

    public function prodi(Prodi $prodi)
    {
        return view('prodi', [
            'prodi'      => $prodi
        ]);
    }

    public function kalender()
    {
        return view('kalender', [
            'kalender'   => Kalender::find(1)
        ]);
    }

    public function bem()
    {
        return view('bem', [
            'bem'   => Bem::find(1)
        ]);
    }

    public function hmp(Hmp $hmp)
    {
        return view('hmp', [
            'hmp'      => $hmp
        ]);
    }

    public function lab(Lab $lab)
    {
        return view('lab', [
            'lab'      => $lab
        ]);
    }

    public function kemahasiswaan(Kemahasiswaan $kemahasiswaan)
    {
        return view('kemahasiswaan', [
            'kemahasiswaan'      => $kemahasiswaan
        ]);
    }

    public function pimpinan()
    {
        return view('pimpinan', [
            'dekan'     => Dosen::where('jabatan', 'Dekan')->first(),
            'wadek'     => Dosen::where('jabatan', 'Wakil Dekan')->first(),
            'kaprodi'   => Dosen::where('jabatan', 'Kaprodi')->orderBy('jurusan_id', 'asc')->get()
        ]);
    }

    public function dosen()
    {
        return view('dosen', [
            'dosen'     => Dosen::where('status', 'Dosen Tetap')->orderBy('jurusan_id', 'asc')->get(),
            'count'     => Dosen::where('status', 'Dosen Tetap')->count()
        ]);
    }

    public function staf()
    {
        return view('staf');
    }

    public function pengumuman()
    {
        return view('pengumuman.index', [
            'pengumuman'   => Pengumuman::orderBy('publish_at', 'desc')->filter(request(['judul']))->paginate(6)->withQueryString(),
            'recent'       => Pengumuman::orderBy('publish_at', 'desc')->limit(5)->get()
        ]);
    }

    public function getpengumuman(Pengumuman $pengumuman)
    {
        return view('pengumuman.detail', [
            'pengumuman'    => $pengumuman,
            'recent'       => Pengumuman::orderBy('publish_at', 'desc')->limit(5)->get()
        ]);
    }

    public function berita()
    {
        return view('berita.index', [
            'berita'       => Berita::orderBy('publish_at', 'desc')->filter(request(['judul', 'kategori']))->paginate(6)->withQueryString(),
            'recent'       => Berita::orderBy('publish_at', 'desc')->limit(5)->get(),
            'kategori'     => Kategori::all()
        ]);
    }

    public function getberita(Berita $berita)
    {
        return view('berita.detail', [
            'berita'       => $berita,
            'recent'       => Berita::orderBy('publish_at', 'desc')->limit(5)->get(),
            'kategori'     => Kategori::all()
        ]);
    }

    public function tes()
    {
        $mahasiswa = Mahasiswa::where('nim', '1994094001')->first();

        return $mahasiswa->kegiatan()->where('kegiatan_id', '2')->first()->pivot;

        // foreach ( $mahasiswa->kegiatan as $kegiatan) {
        //     echo $kegiatan->nama . ' ' . $kegiatan->pivot->va . '</br>';
        // }
    }
}
