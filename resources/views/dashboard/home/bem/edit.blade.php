@extends('dashboard.template')
@section('addcss')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ url('') }}/plugins/summernote/summernote.min.css">
@endsection
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Homepage | BEM</h5>
            </div>
            <div class="card-body">
                <form method="post" id="form" action="{{ route('bem.update', $bem->id) }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                    <div class="form-group row">
                        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" id="judul" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul', $bem->judul) }}" required>
                            @error('judul')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="body" class="col-sm-2 col-form-label">Teks</label>
                        <div class="col-sm-10">
                            <textarea id="body" class="form-control summer @error('body') is-invalid @enderror" name="body" required>{{ old('body', $bem->body) }}</textarea>
                            @error('body')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="publish_at" class="col-sm-2 col-form-label">Tanggal Publish</label>
                        <div class="col-sm-4">
                            <input type="datetime-local" id="publish_at" class="form-control @error('publish_at') is-invalid @enderror" name="publish_at" value="{{ old('publish_at', $bem->publish_at) }}">
                            @error('publish_at')
                                <span class="text-sm text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
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
    <!-- Summernote -->
    <script src="{{ url('') }}/plugins/summernote/summernote.min.js"></script>
    <script src="{{ url('') }}/plugins/summernote/lang/summernote-id-ID.min.js"></script>
    <!-- Jquery Form -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script>
        $(function() {
            //Summer Note
            $('.summer').summernote({
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
        });
    </script>
@endsection