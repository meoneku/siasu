@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Mahasiswa</h5>
            </div>

            <div class="card-body">
                <form action="/webmin/va">
                    <div class="input-group">
                        <input type="text" name="nama" class="form-control rounded-0 w-25" placeholder="Semua Nama" value="{{ request('nama') }}">
                        <select name="jurusan" class="form-control w-25">
                            <option value="">Semua Jurusan</option>
                            @foreach ($jurusans as $prodi)
                                @if (request('jurusan') == $prodi->id)
                                    <option value="{{ $prodi->id }}" selected>{{ $prodi->jenjang }} {{ $prodi->jurusan }}</option>
                                @else
                                    <option value="{{ $prodi->id }}">{{ $prodi->jenjang }} {{ $prodi->jurusan }}</option>
                                @endif
                            @endforeach
                        </select>
                        <select name="jurusan" class="form-control w-25">
                            <option value="">Semua Kegiatan</option>
                            @foreach ($kegiatans as $kegiatan)
                                @if (request('kegiatan') == $kegiatan->id)
                                    <option value="{{ $kegiatan->id }}" selected>{{ $kegiatan->nama }}</option>
                                @else
                                    <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                        <button class="btn btn-danger btn-flat" type="submit"><i class="fas fa-search"></i></button>
                        <a href="/webmin/va" class="btn btn-info btn-flat"><i class="fas fa-circle-notch"></i></a>
                        <a href="{{ route('va.create') }}" class="btn btn-primary btn-flat"><i class="fas fa-plus"></i></a>
                        <a href="{{ route('va.import') }}" class="btn btn-success btn-flat"><i class="fas fa-file-excel"></i></a>
                    </div>
                </form>
                <div class="row mt-4">
                    <table class="table table-hover responsive">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Kegiatan</th>
                                <th>VA</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vas as $data)
                                <tr>
                                    <td>{{ $vas->firstItem() + $loop->index }}</td>
                                    <td>{{ $data->mahasiswa->nama }}</td>
                                    <td>{{ $data->mahasiswa->jurusan->jenjang }} {{ $data->mahasiswa->jurusan->jurusan }}</td>
                                    <td>{{ $data->kegiatan->nama }}</td>
                                    <td>{{ $data->nomor_va }}</td>
                                    <td>Rp. {{ number_format($data->nominal, 0, ',', '.') }}</td>
                                    <td>{{ $data->status }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info btn-xs">#</button>
                                            <button type="button" class="btn btn-info btn-xs dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <a class="dropdown-item" href="{{ route('va.edit', $data->id) }}"><i class="fas fa-edit"></i> Edit</a>
                                                @if (Auth::guard('admin')->user()->role == 'root')
                                                    <div class="dropdown-divider"></div>
                                                    <form action="{{ route('va.destroy', $data->id) }}" method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                                        <button class="btn-link button-delete dropdown-item" data-message="Data VA {{ $data->mahasiswa->nama }}"><i class="fas fa-trash"></i> Hapus</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    {{ $vas->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
