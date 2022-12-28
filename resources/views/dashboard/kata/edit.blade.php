@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Edit Kata | Tambah</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/kata') . '/' . $kata->id }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                    <div class="form-group row">
                        <label for="kata_cari" class="col-sm-2 col-form-label">Kata Cari</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('kata_cari') is-invalid @enderror" id="kata_cari" name="kata_cari" placeholder="Kata Yang Di Cari" value="{{ old('kata_cari', $kata->kata_cari) }}" maxlength="200" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kata_ganti" class="col-sm-2 col-form-label">Kata Ganti</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('kata_ganti') is-invalid @enderror" id="kata_ganti" name="kata_ganti" placeholder="Kata Di Ganti" value="{{ old('kata_ganti', $kata->kata_ganti) }}" maxlength="200" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-warning" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>&nbsp;
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
            </div>
            <div class="card-footer">
                *<i>Perhatikan
            </div>
        </div>

        </form>
    </div>
@endsection
