@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Ajar | Tambah</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/ajar') . '/' . $ajar->id }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                    <div class="form-group row">
                        <label for="searchdosen" class="col-sm-2 col-form-label">NIY</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="searchdosen" name="searchdosen" placeholder="Ketik Nama Dosen" value="{{ old('niy', $ajar->niy) }}" required>
                            <input type="hidden" name="niy" id="niy" value="{{ old('niy', $ajar->niy) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nidn" class="col-sm-2 col-form-label">NIDN</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control @error('nidn') is-invalid @enderror" id="nidn" name="nidn" placeholder="Nomor Induk Dosen Nasional" value="{{ old('nidn', $ajar->dosen->nidn) }}" maxlength="15" required readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama Lengkap" value="{{ old('nama', $ajar->dosen->nama) }}" maxlength="128" required readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jurusan_id" class="col-sm-2 col-form-label">Homebase</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control @error('jurusan_id') is-invalid @enderror" id="jurusan_id" name="jurusan_id" placeholder="Homebase" value="{{ old('jurusan_id', $ajar->dosen->jurusan->jurusan) }}" maxlength="128" required readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="semester" class="col-sm-2 col-form-label">Semester</label>
                        <div class="col-sm-4">
                            <select id="semester" name="semester" class="form-control" required>
                                @for ($tahun = date('Y'); $tahun >= env('SEMESTER_YEAR_BEGIN'); $tahun -= 1)
                                    @for ($angka = 2; $angka >= 1; $angka -= 1)
                                        @if ($tahun . $angka == $ajar->semester)
                                            <option value="{{ $tahun . $angka }}" selected>{{ App\Http\Controllers\NilaiController::ConvertSemester($tahun . $angka) }}</option>
                                        @else
                                            <option value="{{ $tahun . $angka }}">{{ App\Http\Controllers\NilaiController::ConvertSemester($tahun . $angka) }}</option>
                                        @endif
                                    @endfor
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sks" class="col-sm-2 col-form-label">Jumlah SKS</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control @error('sks') is-invalid @enderror" id="sks" name="sks" placeholder="" value="{{ old('sks', $ajar->sks, 0) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kjm_pasca" class="col-sm-2 col-form-label">Jumlah KJM Pasca</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control @error('kjm_pasca') is-invalid @enderror" id="kjm_pasca" name="kjm_pasca" placeholder="" value="{{ old('kjm_pasca', $ajar->kjm_pasca, 0) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kjm_fai" class="col-sm-2 col-form-label">Jumlah KJM FAI</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control @error('kjm_fai') is-invalid @enderror" id="kjm_fai" name="kjm_fai" placeholder="" value="{{ old('kjm_fai', $ajar->kjm_fai, 0) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kjm_ft" class="col-sm-2 col-form-label">Jumlah KJM FT</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control @error('kjm_ft') is-invalid @enderror" id="kjm_ft" name="kjm_ft" placeholder="" value="{{ old('kjm_ft', $ajar->kjm_ft, 0) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kjm_fti" class="col-sm-2 col-form-label">Jumlah KJM FTI</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control @error('kjm_fti') is-invalid @enderror" id="kjm_fti" name="kjm_fti" placeholder="" value="{{ old('kjm_fti', $ajar->kjm_fti, 0) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kjm_fe" class="col-sm-2 col-form-label">Jumlah KJM FE</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control @error('kjm_fe') is-invalid @enderror" id="kjm_fe" name="kjm_fe" placeholder="" value="{{ old('kjm_fe', $ajar->kjm_fe, 0) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kjm_fip" class="col-sm-2 col-form-label">Jumlah KJM FIP</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control @error('kjm_fip') is-invalid @enderror" id="kjm_fip" name="kjm_fip" placeholder="" value="{{ old('kjm_fip', $ajar->kjm_fip, 0) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kjm_sore" class="col-sm-2 col-form-label">Jumlah KJM Sore</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control @error('kjm_sore') is-invalid @enderror" id="kjm_sore" name="kjm_sore" placeholder="" value="{{ old('kjm_sore', $ajar->kjm_sore, 0) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kjm_piba" class="col-sm-2 col-form-label">Jumlah KJM PIBA</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control @error('kjm_piba') is-invalid @enderror" id="kjm_piba" name="kjm_piba" placeholder="" value="{{ old('kjm_piba', $ajar->kjm_piba, 0) }}" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-warning" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>&nbsp;
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
@endsection
