@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Homepage | Fasilitas</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ route('fasilitas.update', $fasilitas->id) }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                    <div class="form-group row">
                        <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" placeholder="deskripsi" value="{{ old('deskripsi', $fasilitas->deskripsi) }}" maxlength="128" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-6">
                            <input type="file" name="gambar" id="gambar" class="form-control @error('gambar') is-invalid @enderror" accept="image/*" onchange="preview()">
                            <small class="text-muted"><i>* Maksimum Ukuran gambar 2 MB (2048 KB)</i></small><br>
                            <img id="frame" src="{{ url('uploads') . '/' . $fasilitas->gambar }}" width="140px" height="auto" />
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
