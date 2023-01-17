@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Pendaftaran Skripsi</h5>
            </div>

            <div class="card-body">
                <form action="/webmin/skripsi">
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
                        <select name="batch" class="form-control w-25">
                            <option value="">Semua Batch</option>
                            @foreach ($batchs as $batch)
                                @if (request('batch') == $batch->id)
                                    <option value="{{ $batch->id }}" selected>{{ $batch->nama }}</option>
                                @else
                                    <option value="{{ $batch->id }}">{{ $batch->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                        <button class="btn btn-danger btn-flat" type="submit"><i class="fas fa-search"></i></button>
                        <a href="/webmin/skripsi" class="btn btn-info btn-flat"><i class="fas fa-circle-notch"></i></a>
                        <a href="/webmin/skripsi/create" class="btn btn-primary btn-flat"><i class="fas fa-plus"></i></a>
                    </div>
                </form>
                <div class="row mt-4">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Tanggal Daftar</th>
                                <th>Batch</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($skripsi as $data)
                                <tr>
                                    <td>{{ $skripsi->firstItem() + $loop->index }}</td>
                                    <td>{{ $data->mahasiswa->nama }}</td>
                                    <td>{{ $data->mahasiswa->jurusan->jurusan }}</td>
                                    <td>{{ tanggal_indonesia($data->created_at) }}</td>
                                    <td>{{ $data->batch->nama }}</td>
                                    <td><a href="/webmin/skripsi/{{ $data->id }}/form" class="badge bg-primary me-1" target="_blank" title="Cetak Form Pendaftaran"><i class="fas fa-file-pdf"></i></a>
                                        <a href="/webmin/skripsi/{{ $data->id }}" class="badge bg-success me-1" title="Set Dosen Pembimbing"><i class="fas fa-user-graduate"></i></a>
                                        <a href="/webmin/skripsi/{{ $data->id }}" class="badge bg-warning me-1" title="Cetak Surat Penugasan"><i class="fas fa-file-signature"></i></a>
                                        <a href="/webmin/skripsi/{{ $data->id }}/edit" class="badge bg-info me-1" title="Edit Data Pendaftaran Skripsi"><i class="fas fa-edit"></i></a>
                                        <form action="/webmin/skripsi/{{ $data->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                            <button class="badge bg-danger border-0 button-delete" data-message="Data Pendaftar Skripsi {{ $data->mahasiswa->nama }}"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    {{ $skripsi->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
