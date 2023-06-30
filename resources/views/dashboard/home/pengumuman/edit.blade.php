@extends('dashboard.template')
@section('addcss')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ url('') }}/plugins/summernote/summernote.min.css">
@endsection
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Homepage | Fasilitas</h5>
            </div>
            <div class="card-body">
                <form method="post" id="form" action="{{ route('pengumuman.update', $pengumuman->slug) }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                    <div class="form-group row">
                        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" id="judul" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul', $pengumuman->judul) }}" required>
                            @error('judul')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="slug" class="col-sm-2 col-form-label">SEO/URL</label>
                        <div class="col-sm-10">
                            <input type="text" id="slug" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ old('slug', $pengumuman->slug) }}" readonly required>
                            @error('slug')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="body" class="col-sm-2 col-form-label">Teks</label>
                        <div class="col-sm-10">
                            <textarea id="body" class="form-control @error('body') is-invalid @enderror" name="body" required>{{ old('body', $pengumuman->body) }}</textarea>
                            @error('body')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="publish_at" class="col-sm-2 col-form-label">Tanggal Publish</label>
                        <div class="col-sm-4">
                            <input type="datetime-local" id="publish_at" class="form-control @error('publish_at') is-invalid @enderror" name="publish_at" value="{{ old('publish_at', $pengumuman->publish_at) }}">
                            @error('publish_at')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
                        <div class="col-sm-10">
                            <div class="input-grup">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
                                    <label class="custom-file-label" for="file">Pilih Berkas</label>
                                    @error('gambar')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="progress progress-xs" id="progressi" style="display: none">
                                <div class="progress-bar progress-xs progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                            </div>
                            <span class="text-danger text-xs">Maksimal Gambar 2 Mb</span><br />
                            <img src="{{ url('uploads') . '/' . $pengumuman->gambar }}" alt="{{ $pengumuman->gambar }}" width="50%" height="auto">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="file" class="col-sm-2 col-form-label">File Pengumuman</label>
                        <div class="col-sm-10">
                            <div class="input-grup">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('file') is-invalid @enderror" id="file" name="file">
                                    <label class="custom-file-label" for="file">Pilih Berkas</label>
                                    @error('file')
                                        <span class="text-sm text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="progress progress-xs" id="progress" style="display: none">
                                <div class="progress-bar progress-xs progress-bar-striped progress-bar-animated bg-primary" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                            </div>
                            <span class="text-danger text-xs">Maksimal file 2 Mb</span>
                            @if ($pengumuman->file != null)
                                <br /><a href="{{ url('uploads') . '/' . $pengumuman->file }}" class="btn btn-success"><i class="fas fa-download"></i> Unduh Berkas Pengumuman</a>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <a href="" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>&nbsp;
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
    </div>
@endsection
@section('addjs')
    <!-- bs-custom-file-input -->
    <script src="{{ url('') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- Summernote -->
    <script src="{{ url('') }}/plugins/summernote/summernote.min.js"></script>
    <script src="{{ url('') }}/plugins/summernote/lang/summernote-id-ID.min.js"></script>
    <!-- Jquery Form -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script>
        $(function() {
            //Summer Note
            $('#body').summernote({
                height: 300,
                lang: 'id-ID',
                callbacks: {
                    onPaste: function(e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

                        e.preventDefault();

                        // Firefox fix
                        setTimeout(function() {
                            document.execCommand('insertText', false, bufferText);
                        }, 10);
                    }
                }
            })
            //Custom File Input
            bsCustomFileInput.init()
        });

        //Upload Image Progress Bar
        $("form").submit(function() {
            document.getElementById('progress').style.display = 'grid'
            document.getElementById('progressi').style.display = 'grid'
        });

        const judul = document.getElementById('judul')
        const slug = document.getElementById('slug')

        judul.addEventListener('change', function() {
            fetch('/api/pengumuman/makeSlug?judul=' + judul.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        })
    </script>
@endsection
