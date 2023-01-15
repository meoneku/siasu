@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Dosen</h5>
            </div>

            <div class="card-body">
                <form action="/webmin/dosen">
                    <div class="input-group">
                        <input type="text" name="nama" class="form-control rounded-0 w-25" placeholder="Semua Nama" value="{{ request('nama') }}">
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
                        <a href="/webmin/dosen" class="btn btn-info btn-flat"><i class="fas fa-circle-notch"></i></a>
                        <a href="/webmin/dosen/create" class="btn btn-primary btn-flat"><i class="fas fa-plus"></i></a>
                        <a href="/webmin/dosen/import" class="btn btn-success btn-flat"><i class="fas fa-file-excel"></i></a>
                    </div>
                </form>
                <div class="row mt-4">
                    @foreach ($dosen as $data)
                        <div class="col-md-6">
                            <div class="card card-widget widget-user shadow">
                                <div class="widget-user-header bg-danger">
                                    <h3 class="widget-user-username">{{ $data->nama }}</h3>
                                    <h5 class="widget-user-desc">{{ $data->jurusan->jenjang }} {{ $data->jurusan->jurusan }}</h5>
                                </div>
                                <div class="widget-user-image">
                                    <img class="img-circle elevation-2" src="{{ url('uploads') . '/' . $data->foto }}" alt="Foto Dosen">
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">Jabatan</h5>
                                                <span class="description-text">{{ $data->jabatan }}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">NIY</h5>
                                                <span class="description-text">{{ $data->niy }}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="description-block">
                                                <h5 class="description-header">NIDN</h5>
                                                <span class="description-text">{{ $data->nidn }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-end">
                                        <a href="/webmin/dosen/{{ $data->id }}/edit" class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>&nbsp;
                                        <form action="/webmin/dosen/{{ $data->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                            <button class="btn btn-danger button-delete" data-message="Dosen Dengan Nama {{ $data->nama }}"><i class="fas fa-trash"></i> Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer d-flex justify-content-end">
                    {{ $dosen->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
