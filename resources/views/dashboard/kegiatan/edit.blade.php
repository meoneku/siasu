@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Kegiatan | Edit</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/kegiatan') . '/' . $kegiatan->id }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Kegiatan</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama Kegiatan" value="{{ old('nama', $kegiatan->nama) }}" maxlength="128" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="desc" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('desc') is-invalid @enderror" id="desc" name="desc" placeholder="Deskripsi Kegiatan" value="{{ old('desc', $kegiatan->desc) }}" maxlength="255" required>
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
