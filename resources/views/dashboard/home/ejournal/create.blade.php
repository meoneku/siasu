@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Homepage | Link Ejournal</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ route('ejournal.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="nm_menu" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('nm_menu') is-invalid @enderror" id="nm_menu" name="nm_menu" placeholder="Nama Jurnal" value="{{ old('nm_menu') }}" maxlength="128" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="link" class="col-sm-2 col-form-label">URL</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" placeholder="https://urljurnal.ac.id" value="{{ old('link') }}" required>
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
