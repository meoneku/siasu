@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Mahasiswa</h5>
            </div>

            <div class="card-body">
                <form action="/webmin/mahasiswa">
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
                        <a href="/webmin/mahasiswa" class="btn btn-info btn-flat"><i class="fas fa-circle-notch"></i></a>
                        <a href="/webmin/mahasiswa/create" class="btn btn-primary btn-flat"><i class="fas fa-plus"></i></a>
                        <a href="/webmin/mahasiswa/import" class="btn btn-success btn-flat"><i class="fas fa-file-excel"></i></a>
                    </div>
                </form>
                <div class="row mt-4">
                    @foreach ($mahasiswa as $data)
                        <div class="col-md-6">
                            <div class="card card-widget widget-user shadow">
                                <div class="widget-user-header bg-danger">
                                    <h3 class="widget-user-username">{{ $data->nama }}</h3>
                                    <h5 class="widget-user-desc">{{ $data->jurusan->jenjang }} {{ $data->jurusan->jurusan }}</h5>
                                </div>
                                <div class="widget-user-image">
                                    <img class="img-circle elevation-2" src="{{ url('uploads') . '/' . $data->foto }}" alt="Foto Mahasiswa">
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">NIM</h5>
                                                <span class="description-text">{{ $data->nim }}</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header"></h5>
                                                <span class="description-text"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="description-block">
                                                <h5 class="description-header">Status</h5>
                                                <span class="description-text">{{ $data->status }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row d-flex justify-content-end">
                                        <a href="/webmin/mahasiswa/{{ $data->id }}/edit" class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>&nbsp;
                                        <form action="/webmin/mahasiswa/{{ $data->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                            <button class="btn btn-danger button-delete" data-message="Mahasiswa Dengan Nama {{ $data->nama }}"><i class="fas fa-trash"></i> Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer d-flex justify-content-end">
                    {{ $mahasiswa->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
