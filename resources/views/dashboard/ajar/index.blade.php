@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Ajar Semester</h5>
            </div>

            <div class="card-body">
                <form action="/webmin/ajar">
                    <div class="input-group">
                        <input type="text" name="nama" class="form-control rounded-0 w-25" placeholder="Semua Nama" value="{{ request('nama') }}">
                        <select name="semester" class="form-control w-25">
                            <option value="">Semua Semester</option>
                            @for ($tahun = date('Y'); $tahun >= env('SEMESTER_YEAR_BEGIN'); $tahun -= 1)
                                @for ($angka = 2; $angka >= 1; $angka -= 1)
                                    @if ($tahun . $angka == request('semester'))
                                        <option value="{{ $tahun . $angka }}" selected>{{ App\Http\Controllers\NilaiController::ConvertSemester($tahun . $angka) }}</option>
                                    @else
                                        <option value="{{ $tahun . $angka }}">{{ App\Http\Controllers\NilaiController::ConvertSemester($tahun . $angka) }}</option>
                                    @endif
                                @endfor
                            @endfor
                        </select>
                        <select name="jurusan" class="form-control w-25">
                            <option value="">Semua Homebase</option>
                            @foreach ($jurusan as $prodi)
                                @if (request('jurusan') == $prodi->id)
                                    <option value="{{ $prodi->id }}" selected>{{ $prodi->jenjang }} {{ $prodi->jurusan }}</option>
                                @else
                                    <option value="{{ $prodi->id }}">{{ $prodi->jenjang }} {{ $prodi->jurusan }}</option>
                                @endif
                            @endforeach
                        </select>
                        <button class="btn btn-danger btn-flat" type="submit"><i class="fas fa-search"></i></button>
                        <a href="/webmin/ajar" class="btn btn-info btn-flat"><i class="fas fa-circle-notch"></i></a>
                        <a href="/webmin/ajar/create" class="btn btn-primary btn-flat"><i class="fas fa-plus"></i></a>
                        <a href="/webmin/nilai/import" class="btn btn-success btn-flat"><i class="fas fa-file-excel"></i></a>
                    </div>
                </form>
                <div class="row mt-4">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIY</th>
                                <th>Nama</th>
                                <th>Homebase</th>
                                <th>Semester</th>
                                <th>SKS</th>
                                <th>KJM</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ajar as $mk)
                                <tr>
                                    <td>{{ $ajar->firstItem() + $loop->index }}</td>
                                    <td>{{ $mk->niy }}</td>
                                    <td>{{ $mk->dosen->nama }}</td>
                                    <td>{{ $mk->dosen->jurusan->jurusan }}</td>
                                    <td>{{ App\Http\Controllers\NilaiController::ConvertSemester($mk->semester) }}</td>
                                    <td>{{ $mk->sks }}</td>
                                    <td>{{ $mk->kjm_pasca + $mk->kjm_fai + $mk->kjm_ft + $mk->kjm_fti + $mk->kjm_fe + $mk->kjm_fip + $mk->kjm_sore + $mk->kjm_piba }}</td>
                                    <td><a href="/webmin/ajar/{{ $mk->id }}/edit" class="badge bg-info me-1" title="Edit Data Pengajaran"><i class="fas fa-edit"></i></a>
                                        <form action="/webmin/ajar/{{ $mk->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                            <button class="badge bg-danger border-0 button-delete" data-message="Data Pengajaran Dosen {{ $mk->dosen->nama }}"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    {{ $ajar->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
