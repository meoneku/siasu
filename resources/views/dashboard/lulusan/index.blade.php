@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Lulusan</h5>
            </div>

            <div class="card-body">
                <form action="/webmin/lulusan">
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
                        <a href="/webmin/lulusan" class="btn btn-info btn-flat"><i class="fas fa-circle-notch"></i></a>
                        <a href="/webmin/lulusan/create" class="btn btn-primary btn-flat"><i class="fas fa-plus"></i></a>
                        <a href="/webmin/lulusan/import" class="btn btn-success btn-flat"><i class="fas fa-file-excel"></i></a>
                    </div>
                </form>
                <div class="row mt-4">
                    @foreach ($lulusan as $lulus)
                        <div class="col-md-6">
                            <div class="card card-widget widget-user shadow">
                                <div class="widget-user-header bg-danger">
                                    <h3 class="widget-user-username">{{ $lulus->nama }}</h3>
                                    <h5 class="widget-user-desc">{{ $lulus->jurusan->jenjang }} {{ $lulus->jurusan->jurusan }}</h5>
                                </div>
                                <div class="widget-user-image">
                                    <img class="img-circle elevation-2" src="{{ url('uploads') . '/' . $lulus->foto }}" alt="Foto Lulus">
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">LULUS</h5>
                                                <span class="description-text">{{ tanggal_indonesia($lulus->tanggal_lulus, false) }}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">NIM</h5>
                                                <span class="description-text">{{ $lulus->nim }}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="description-block">
                                                <h5 class="description-header">No. Ijazah</h5>
                                                <span class="description-text">{{ $lulus->nomorijazah }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-end">
                                        @php
                                            $angkatan = substr($lulus->nim, 0, 2);
                                            if ($angkatan >= 20) {
                                                $kuri = 'merdeka';
                                            } elseif ($angkatan < 20 and $angkatan >= 18) {
                                                $kuri = 'kkni';
                                            } else {
                                                $kuri = 'k13';
                                            }
                                        @endphp
                                        <a href="/webmin/transkrip/print?nim={{ $lulus->nim }}&separator={{ env('SEPARATOR') }}&kurikulum={{ $kuri }}&final=false&predikat={{ env('PREDIKAT') }}&pin={{ env('PIN') }}" class="btn btn-primary" target="_blank"><i class="fas fa-sad-cry"></i> Transkrip Sementara</a>&nbsp;
                                        <a href="/webmin/transkrip/print?nim={{ $lulus->nim }}&separator={{ env('SEPARATOR') }}&kurikulum={{ $kuri }}&final=true&predikat={{ env('PREDIKAT') }}&pin={{ env('PIN') }}" class="btn btn-success" target="_blank"><i class="fas fa-print"></i> Transkrip</a>&nbsp;
                                        <a href="/webmin/lulusan/{{ $lulus->id }}/edit" class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>&nbsp;
                                        <form action="/webmin/lulusan/{{ $lulus->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                            <button class="btn btn-danger button-delete" data-message="Lulusan Dengan Nama {{ $lulus->nama }}"><i class="fas fa-trash"></i> Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer d-flex justify-content-end">
                    {{ $lulusan->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
