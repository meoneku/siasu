@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Cetak Transkrip</h5>
            </div>

            <div class="card-body">
                <form action="/webmin/transkrip">
                    <div class="input-group">
                        <input type="text" name="nama" class="form-control rounded-0 w-25" placeholder="Semua Nama" value="{{ request('nama') }}">
                        <select name="tahun" class="form-control">
                            <option value="">Semua Tahun</option>
                            @for ($tahun = date('Y'); $tahun >= env('GRADUATION_YEAR_BEGIN'); $tahun -= 1)
                                @if ($tahun == request('tahun'))
                                    <option value="{{ $tahun }}" selected>{{ $tahun }}</option>
                                @else
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                @endif
                            @endfor
                        </select>
                        <select name="jurusan" class="form-control w-25">
                            <option value="">Semua Jurusan</option>
                            @foreach ($jurusan as $prodi)
                                @if (request('jurusan') == $prodi->id)
                                    <option value="{{ $prodi->id }}" selected>{{ $prodi->jenjang }} {{ $prodi->jurusan }}</option>
                                @else
                                    <option value="{{ $prodi->id }}">{{ $prodi->jenjang }} {{ $prodi->jurusan }}</option>
                                @endif
                            @endforeach
                        </select>
                        <button class="btn btn-danger btn-flat" type="submit"><i class="fas fa-search"></i></button>
                        <a href="/webmin/transkrip" class="btn btn-info btn-flat"><i class="fas fa-circle-notch"></i></a>
                    </div>
                </form>
                <div class="row mt-4">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Tanggal Lulus</th>
                                <th>Tanggal Wisuda</th>
                                <th>Jurusan</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lulusan as $data)
                                @php
                                    $angkatan = substr($data->nim, 0, 2);
                                    if ($angkatan >= 20) {
                                        $kuri = 'merdeka';
                                    } elseif ($angkatan < 20 and $angkatan >= 18) {
                                        $kuri = 'kkni';
                                    } else {
                                        $kuri = 'k13';
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $lulusan->firstItem() + $loop->index }}</td>
                                    <td>{{ $data->nim }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ \App\Helpers\IndoTanggal::tanggal($data->tanggal_lulus, false) }}</td>
                                    <td>{{ \App\Helpers\IndoTanggal::tanggal($data->tanggal_wisuda, false) }}</td>
                                    <td>{{ $data->jurusan->jurusan }}</td>
                                    <td><a href="/webmin/lulusan/{{ $data->id }}/edit" class="badge bg-info me-1" title="Edit Data Lulusan"><i class="fas fa-user-graduate"></i></a>
                                        <a href="/webmin/transkrip/edit?nim={{ $data->nim }}" class="badge bg-danger me-1" title="Edit Nilai"><i class="fas fa-file-invoice"></i></a>
                                        <a href="/webmin/transkrip/print?nim={{ $data->nim }}&separator={{ env('SEPARATOR') }}&kurikulum={{ $kuri }}&final=false&predikat={{ env('PREDIKAT') }}&pin={{ env('PIN') }}" class="badge bg-primary me-1" title="Transkrip Sementara" target="_blank"><i class="fas fa-sad-cry"></i></a>
                                        <a href="/webmin/transkrip/print?nim={{ $data->nim }}&separator={{ env('SEPARATOR') }}&kurikulum={{ $kuri }}&final=true&predikat={{ env('PREDIKAT') }}&pin={{ env('PIN') }}" class="badge bg-success me-1" title="Transkrip Akhir" target="_blank"><i class="fas fa-print"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    {{ $lulusan->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
