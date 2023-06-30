@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Homepage | Kategori Berita</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ route('kategori.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Nama Kategori</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Kategori" value="{{ old('name') }}" maxlength="128" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="slug" class="col-sm-2 col-form-label">URL</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}" maxlength="128" readonly required>
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
        const name = document.getElementById('name')
        const slug = document.getElementById('slug')

        name.addEventListener('change', function() {
            fetch('/api/kategori/makeSlug?name=' + name.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        })
    </script>
@endsection
