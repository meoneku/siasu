@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Batch | Tambah</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/batch') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Batch</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama Batch/Gelombang" value="{{ old('nama') }}" maxlength="200" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kegiatan_id" class="col-sm-2 col-form-label">Kegiatan</label>
                        <div class="col-sm-4">
                            <select name="kegiatan_id" id="kegiatan_id" class="form-control" required>
                                @foreach ($kegiatans as $kegiatan)
                                    <option value="{{ $kegiatan->id }}">{{ $kegiatan->nama }} - {{ $kegiatan->desc }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mulai" class="col-sm-2 col-form-label">Tanggal Mulai</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control @error('mulai') is-invalid @enderror" id="mulai" name="mulai" placeholder="Tanggal Mulai Pelsaksanaan" value="{{ old('mulai') }}" maxlength="200" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="selesai" class="col-sm-2 col-form-label">Tanggal Selesai</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control @error('selesai') is-invalid @enderror" id="selesai" name="selesai" placeholder="Tanggal Selesai Pelsaksanaan" value="{{ old('selesai') }}" maxlength="200" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahun" class="col-sm-2 col-form-label">Tahun Pelaksanaan</label>
                        <div class="col-sm-3">
                            <select name="tahun" id="tahun" class="form-control" required>
                                @for ($tahun = date('Y'); $tahun >= env('GRADUATION_YEAR_BEGIN'); $tahun -= 1)
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
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

            </div>
        </div>

        </form>
    </div>
@endsection
