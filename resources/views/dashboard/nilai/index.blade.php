@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Nilai</h5>
            </div>

            <div class="card-body">
                <form action="/webmin/nilai">
                    <div class="input-group">
                        @if (request('nim'))
                            <input type="hidden" name="nim" value="{{ request('nim') }}">
                        @endif
                        @if (!request('nim'))
                            <input type="text" name="nama" class="form-control rounded-0" placeholder="Semua Nama" value="{{ request('nama') }}">
                        @endif
                        <input type="text" name="mk" class="form-control rounded-0" placeholder="Semua Mata Kuliah" value="{{ request('mk') }}">
                        <select name="semester" class="form-control">
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
                        @if (!request('nim'))
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
                        @endif
                        <button class="btn btn-danger btn-flat" type="submit"><i class="fas fa-search"></i></button>
                        @if (request('nim'))
                            <a href="/webmin/nilai?nim={{ request('nim') }}" class="btn btn-info btn-flat"><i class="fas fa-circle-notch"></i></a>
                        @else
                            <a href="/webmin/nilai" class="btn btn-info btn-flat"><i class="fas fa-circle-notch"></i></a>
                        @endif
                        <a href="/webmin/nilai/create" class="btn btn-primary btn-flat"><i class="fas fa-plus"></i></a>
                        <a href="/webmin/nilai/import" class="btn btn-success btn-flat"><i class="fas fa-file-excel"></i></a>
                        <a href="/webmin/nilai/pindah" class="btn btn-warning btn-flat"><i class="fas fa-file-excel"></i></a>
                    </div>
                </form>
                @if (request('nim'))
                    <div class="container mt-4">
                        @php
                            $mahasiswa = App\Models\Mahasiswa::where('nim', request('nim'))
                                ->with('jurusan')
                                ->first();
                        @endphp
                        <div class="row">
                            <div class="col">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Nama</label>
                                    <label class="col-sm-6 col-form-label">
                                        @if ($mahasiswa)
                                            {{ $mahasiswa->nama }}
                                        @endif
                                    </label>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">NIM</label>
                                    <label class="col-sm-4 col-form-label">
                                        @if ($mahasiswa)
                                            {{ $mahasiswa->nim }}
                                        @endif
                                    </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Jurusan</label>
                                    <label class="col-sm-4 col-form-label">
                                        @if ($mahasiswa)
                                            {{ $mahasiswa->jurusan->jurusan }}
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row mt-4">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                @if (!request('nim'))
                                    <th>Nama</th>
                                @endif
                                <th>Kode MK</th>
                                <th>Mata Kuliah</th>
                                @if (!request('nim'))
                                    <th>Jurusan</th>
                                @endif
                                <th>Semester</th>
                                <th>SKS</th>
                                <th>Nilai</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nilai as $data)
                                <tr>
                                    <td>{{ $nilai->firstItem() + $loop->index }}</td>
                                    @if (!request('nim'))
                                        <td>
                                            @if ($data->mahasiswa)
                                                {{ $data->mahasiswa->nama }}
                                            @endif
                                        </td>
                                    @endif
                                    <td>{{ $data->kd_mk }}</td>
                                    <td>{{ $data->mata_kuliah }}</td>
                                    @if (!request('nim'))
                                        <td>
                                            @if ($data->mahasiswa)
                                                {{ $data->mahasiswa->jurusan->jurusan }}
                                            @endif
                                        </td>
                                    @endif
                                    <td>{{ App\Http\Controllers\NilaiController::ConvertSemester($data->semester) }}</td>
                                    <td>{{ $data->sks }}</td>
                                    <td>{{ $data->nilai }}</td>
                                    <td><a href="/webmin/nilai/{{ $data->id }}/edit" class="badge bg-info me-1"><i class="fas fa-edit"></i></a>
                                        <form action="/webmin/nilai/{{ $data->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                            <button class="badge bg-danger border-0 button-delete" data-message="Nilai Mata Kuliah {{ $data->mata_kuliah }} @if ($data->mahasiswa) Untuk Mahasiswa {{ $data->mahasiswa->nama }} @endif"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <div class="row align-items-start col-md-12">
                        <div class="col">
                            @if (request('nim'))
                                @if (session()->has('back_url'))
                                    <a href="{{ session('back_url') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
                                @endif
                            @endif
                        </div>
                        <div class="col">
                            <div class="d-flex justify-content-end">
                                {{ $nilai->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
