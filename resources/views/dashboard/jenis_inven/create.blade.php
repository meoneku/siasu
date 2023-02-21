@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Jenis Inventaris | Tambah</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/jenisinven') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Jenis Inventaris</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="nama" name="nama" placeholder="Nama Jenis Inventaris" value="{{ old('nama') }}" maxlength="128" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode" class="col-sm-2 col-form-label">Kode</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="kode" name="kode" placeholder="Kode Jenis Inventaris" value="{{ old('kode') }}" maxlength="10" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-warning" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>&nbsp;
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
            </div>
            <div class="card-footer">
                *
            </div>
        </div>

        </form>
    </div>
@endsection
