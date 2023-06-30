@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Homepage | Kerjasama</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ route('kerjasama.update', $kerjasama->id) }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                    <div class="form-group row">
                        <label for="nm_instansi" class="col-sm-2 col-form-label">Nama Instansi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('nm_instansi') is-invalid @enderror" id="nm_instansi" name="nm_instansi" placeholder="nm_instansi" value="{{ old('nm_instansi', $kerjasama->nm_instansi) }}" maxlength="128" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="logo" class="col-sm-2 col-form-label">Logo</label>
                        <div class="col-sm-6">
                            <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*" onchange="preview()">
                            <small class="text-muted"><i>* Maksimum Ukuran Logo 2 MB (2048 KB)</i></small><br>
                            <img id="frame" src="{{ url('uploads') . '/' . $kerjasama->logo }}" width="140px" height="auto" />
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
@section('addjs')
    <script>
        function preview() {
            frame.style.display = "block";
            frame.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
