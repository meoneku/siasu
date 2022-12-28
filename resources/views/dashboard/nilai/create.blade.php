@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Nilai | Tambah</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/nilai') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                    <div class="form-group row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" placeholder="Nomor Induk Mahasiswa" value="{{ old('nim') }}" maxlength="10" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kdmk" class="col-sm-2 col-form-label">Kode Mata Kuliah</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control @error('kd_mk') is-invalid @enderror" id="kdmk" name="kd_mk" placeholder="Kode Mata Kuliah" value="{{ old('kd_mk') }}" maxlength="10" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mk" class="col-sm-2 col-form-label">Nama Mata Kuliah</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('mata_kuliah') is-invalid @enderror" id="mk" name="mata_kuliah" placeholder="Nama Mata Kuliah" value="{{ old('mata_kuliah') }}" maxlength="200" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mk_jenis" class="col-sm-2 col-form-label">Jenis Mata Kuliah</label>
                        <div class="col-sm-10">
                            <select id="mk_jenis" name="mk_jenis" class="form-control" required>
                                @for ($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}">{{ App\Http\Controllers\NilaiController::ConvertMKJenis($i) }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="level" class="col-sm-2 col-form-label">Level Mata Kuliah</label>
                        <div class="col-sm-4">
                            <select id="level" name="level" class="form-control" required>
                                @for ($i = 1; $i <= 3; $i++)
                                    <option value="{{ $i }}">{{ App\Http\Controllers\NilaiController::ConvertMKLevel($i) }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sks" class="col-sm-2 col-form-label">SKS</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control @error('sks') is-invalid @enderror" id="sks" name="sks" placeholder="Jumlah SKS" value="{{ old('sks') }}" maxlength="128" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nilai" class="col-sm-2 col-form-label">Nilai</label>
                        <div class="col-sm-2">
                            <input type="number" step="0.01" class="form-control @error('nilai') is-invalid @enderror" id="nilai" name="nilai" placeholder="0,00" value="{{ old('nilai') }}"required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="semester" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-4">
                            <select name="semester" class="form-control">
                                @for ($tahun = date('Y'); $tahun >= env('SEMESTER_YEAR_BEGIN'); $tahun -= 1)
                                    @for ($angka = 2; $angka >= 1; $angka -= 1)
                                        @if ($tahun . $angka == date('Y') . '1')
                                            <option value="{{ $tahun . $angka }}" selected>{{ App\Http\Controllers\NilaiController::ConvertSemester($tahun . $angka) }}</option>
                                        @else
                                            <option value="{{ $tahun . $angka }}">{{ App\Http\Controllers\NilaiController::ConvertSemester($tahun . $angka) }}</option>
                                        @endif
                                    @endfor
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-warning" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>&nbsp;
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
            </div>
            <div class="card-footer">
                *<i>Perhatikan Penulisan Nama Lulusan
            </div>
        </div>
    </div>
@endsection
