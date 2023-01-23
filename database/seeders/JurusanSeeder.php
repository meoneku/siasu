<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jurusan::create([
            'jurusan'           => 'Hukum Keluarga',
            'singkatan'         => 'HK',
            'jenjang'           => 'S1',
            'fakultas'          => 'Fakultas Agama Islam',
            'akreditasi'        => 'B',
            'nomor_akreditasi'  => 'Uknown',
            'kode_surat'        => 'A',
        ]);

        Jurusan::create([
            'jurusan'           => 'Hukum Ekonomi Syariah',
            'singkatan'         => 'HES',
            'jenjang'           => 'S1',
            'fakultas'          => 'Fakultas Agama Islam',
            'akreditasi'        => 'B',
            'nomor_akreditasi'  => 'Uknown',
            'kode_surat'        => 'A',
        ]);

        Jurusan::create([
            'jurusan'           => 'Komunikasi Dan Penyiaran Islam',
            'singkatan'         => 'KPI',
            'jenjang'           => 'S1',
            'fakultas'          => 'Fakultas Agama Islam',
            'akreditasi'        => 'B',
            'nomor_akreditasi'  => 'Uknown',
            'kode_surat'        => 'A',
        ]);

        Jurusan::create([
            'jurusan'           => 'Pendidikan Agama Islam',
            'singkatan'         => 'PAI',
            'jenjang'           => 'S1',
            'fakultas'          => 'Fakultas Agama Islam',
            'akreditasi'        => 'B',
            'nomor_akreditasi'  => 'Uknown',
            'kode_surat'        => 'A',
        ]);

        Jurusan::create([
            'jurusan'           => 'Pendidikan Bahasa Arab',
            'singkatan'         => 'PBA',
            'jenjang'           => 'S1',
            'fakultas'          => 'Fakultas Agama Islam',
            'akreditasi'        => 'B',
            'nomor_akreditasi'  => 'Uknown',
            'kode_surat'        => 'A',
        ]);

        Jurusan::create([
            'jurusan'           => 'Pendidikan Guru Madrasah Ibtidaiyah',
            'singkatan'         => 'PGMI',
            'jenjang'           => 'S1',
            'fakultas'          => 'Fakultas Agama Islam',
            'akreditasi'        => 'B',
            'nomor_akreditasi'  => 'Uknown',
            'kode_surat'        => 'A',
        ]);

        Jurusan::create([
            'jurusan'           => 'Teknik Mesin',
            'singkatan'         => 'TM',
            'jenjang'           => 'S1',
            'fakultas'          => 'Fakultas Teknik',
            'akreditasi'        => 'C',
            'nomor_akreditasi'  => '217/SK/BAN-PT/Akred/S/I/2018',
            'kode_surat'        => 'F',
        ]);

        Jurusan::create([
            'jurusan'           => 'Teknik Elektro',
            'singkatan'         => 'TE',
            'jenjang'           => 'S1',
            'fakultas'          => 'Fakultas Teknik',
            'akreditasi'        => 'C',
            'nomor_akreditasi'  => '1856/SK/BAN-PT/Akred/S/VII/2018',
            'kode_surat'        => 'F',
        ]);

        Jurusan::create([
            'jurusan'           => 'Teknik Sipil',
            'singkatan'         => 'TS',
            'jenjang'           => 'S1',
            'fakultas'          => 'Fakultas Teknik',
            'akreditasi'        => 'C',
            'nomor_akreditasi'  => '1973/SK/BAN-PT/Akred/S/VII/2018',
            'kode_surat'        => 'F',
        ]);

        Jurusan::create([
            'jurusan'           => 'Teknik Industri',
            'singkatan'         => 'TD',
            'jenjang'           => 'S1',
            'fakultas'          => 'Fakultas Teknik',
            'akreditasi'        => 'C',
            'nomor_akreditasi'  => '2469/SK/BAN-PT/Akred/S/IX/2018',
            'kode_surat'        => 'F',
        ]);

        Jurusan::create([
            'jurusan'           => 'Teknik Informatika',
            'singkatan'         => 'TI',
            'jenjang'           => 'S1',
            'fakultas'          => 'Fakultas Teknologi Informasi',
            'akreditasi'        => 'C',
            'nomor_akreditasi'  => 'Uknown',
            'kode_surat'        => 'G',
        ]);

        Jurusan::create([
            'jurusan'           => 'Sistem Informasi',
            'singkatan'         => 'SI',
            'jenjang'           => 'S1',
            'fakultas'          => 'Fakultas Teknologi Informasi',
            'akreditasi'        => 'C',
            'nomor_akreditasi'  => 'Uknown',
            'kode_surat'        => 'G',
        ]);

        Jurusan::create([
            'jurusan'           => 'Manajemen Informatika',
            'singkatan'         => 'MI',
            'jenjang'           => 'D3',
            'fakultas'          => 'Fakultas Teknologi Informasi',
            'akreditasi'        => 'C',
            'nomor_akreditasi'  => 'Uknown',
            'kode_surat'        => 'G',
        ]);

        Jurusan::create([
            'jurusan'           => 'Manajamen',
            'singkatan'         => 'Man',
            'jenjang'           => 'S1',
            'fakultas'          => 'Fakultas Ekonomi',
            'akreditasi'        => 'Baik',
            'nomor_akreditasi'  => 'Uknown',
            'kode_surat'        => 'H',
        ]);

        Jurusan::create([
            'jurusan'           => 'Akuntansi',
            'singkatan'         => 'Akun',
            'jenjang'           => 'S1',
            'fakultas'          => 'Fakultas Ekonomi',
            'akreditasi'        => 'Baik',
            'nomor_akreditasi'  => 'Uknown',
            'kode_surat'        => 'H',
        ]);

        Jurusan::create([
            'jurusan'           => 'Ekonomi Islam',
            'singkatan'         => 'EI',
            'jenjang'           => 'S1',
            'fakultas'          => 'Fakultas Ekonomi',
            'akreditasi'        => 'C',
            'nomor_akreditasi'  => 'Uknown',
            'kode_surat'        => 'H',
        ]);

        Jurusan::create([
            'jurusan'           => 'Pendidikan Guru Sekolah Dasar',
            'singkatan'         => 'PGSD',
            'jenjang'           => 'S1',
            'fakultas'          => 'Fakultas Ilmu Pendidikan',
            'akreditasi'        => 'Baik',
            'nomor_akreditasi'  => 'Uknown',
            'kode_surat'        => 'I',
        ]);

        Jurusan::create([
            'jurusan'           => 'Pendidikan Bahasa Dan Sastra Indonesia',
            'singkatan'         => 'PBSI',
            'jenjang'           => 'S1',
            'fakultas'          => 'Fakultas Ilmu Pendidikan',
            'akreditasi'        => 'C',
            'nomor_akreditasi'  => 'Uknown',
            'kode_surat'        => 'I',
        ]);

        Jurusan::create([
            'jurusan'           => 'Pendidikan Bahasa Inggris',
            'singkatan'         => 'PBI',
            'jenjang'           => 'S1',
            'fakultas'          => 'Fakultas Ilmu Pendidikan',
            'akreditasi'        => 'C',
            'nomor_akreditasi'  => 'Uknown',
            'kode_surat'        => 'I',
        ]);

        Jurusan::create([
            'jurusan'           => 'Pendidikan Ilmu Pengetahuan Alam',
            'singkatan'         => 'PIPA',
            'jenjang'           => 'S1',
            'fakultas'          => 'Fakultas Ilmu Pendidikan',
            'akreditasi'        => 'Baik',
            'nomor_akreditasi'  => 'Uknown',
            'kode_surat'        => 'I',
        ]);

        Jurusan::create([
            'jurusan'           => 'Pendidikan Matematika',
            'singkatan'         => 'PM',
            'jenjang'           => 'S1',
            'fakultas'          => 'Fakultas Ilmu Pendidikan',
            'akreditasi'        => 'Baik',
            'nomor_akreditasi'  => 'Uknown',
            'kode_surat'        => 'I',
        ]);

        Jurusan::create([
            'jurusan'           => 'Hukum Keluarga',
            'singkatan'         => 'S2HK',
            'jenjang'           => 'S2',
            'fakultas'          => 'Pascasarjana',
            'akreditasi'        => 'C',
            'nomor_akreditasi'  => 'Uknown',
            'kode_surat'        => 'B',
        ]);

        Jurusan::create([
            'jurusan'           => 'Pendidikan Agama Islam',
            'singkatan'         => 'S1PAI',
            'jenjang'           => 'S2',
            'fakultas'          => 'Pascasarjana',
            'akreditasi'        => 'C',
            'nomor_akreditasi'  => 'Uknown',
            'kode_surat'        => 'B',
        ]);

        Jurusan::create([
            'jurusan'           => 'Manajemen Pendidikan Agama Islam',
            'singkatan'         => 'MPI',
            'jenjang'           => 'S1',
            'fakultas'          => 'Fakultas Agama Islam',
            'akreditasi'        => 'C',
            'nomor_akreditasi'  => 'Uknown',
            'kode_surat'        => 'A',
        ]);
    }
}
