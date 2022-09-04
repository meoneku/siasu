@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Jurusan | Tambah</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/jurusan') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Jurusan/Prodi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" placeholder="Jurusan" value="{{ old('jurusan') }}" maxlength="128" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="singkatan" class="col-sm-2 col-form-label">Singkatan Jurusan</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control @error('singkatan') is-invalid @enderror" id="singkatan" name="singkatan" placeholder="Singkatan Jurusan" value="{{ old('singkatan') }}" maxlength="10" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenjang" class="col-sm-2 col-form-label">Jenjang</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control @error('jenjang') is-invalid @enderror" id="jenjang" name="jenjang" placeholder="D3/S1/S2" value="{{ old('jenjang') }}" maxlength="2" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fakultas" class="col-sm-2 col-form-label">Fakultas</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control @error('fakultas') is-invalid @enderror" id="fakultas" name="fakultas" placeholder="D3/S1/S2" value="{{ old('fakultas') }}" maxlength="30" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="akreditasi" class="col-sm-2 col-form-label">Akreditasi</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control @error('akreditasi') is-invalid @enderror" id="akreditasi" name="akreditasi" placeholder="A/B/C/ Atau Baik/Baik Sekali/Unggul" value="{{ old('akreditasi') }}" maxlength="20" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nomor" class="col-sm-2 col-form-label">Nomor SK Akreditasi</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control @error('nomor_akreditasi') is-invalid @enderror" id="nomor" name="nomor_akreditasi" placeholder="xxxx/xx/x/xxxx" value="{{ old('nomor_akreditasi') }}" maxlength="50" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-warning" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>&nbsp;
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
            </div>
            <div class="card-footer">
                *<i>Perhatikan Penulisan Nama Jurusan Dan Nomor SK Akreditasi
            </div>
        </div>

        </form>
    </div>
@endsection
