@extends('template')
@section('css')
    <!-- JQuery UI -->
    <link rel="stylesheet" href="{{ url('plugins/jquery/jquery-ui.min.css') }}">
@endsection
@section('main')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pendaftaran Skripsi</li>
        </ol>
    </nav>
    @if (empty($batch))
        <div class="d-flex justify-content-center">
            <h2>Pendaftaran Di Tutup</h2>
        </div>
        <div class="d-flex justify-content-center">
            <img src="img/svg/undraw_taken.svg" alt="Alien Go Away" class="img-fluid">
        </div>
        <a href="/" class="btn btn-warning"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
    @else
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Syarat Pendaftaran Skripsi</h4>
            <p>
                1. Telah Melunasi Pembayaran Semester Berjalan<br />
                2. Tidak memiliki nilai D Dan E pada transkrip
            </p>
            <hr>
            <p class="mb-0"><i>* Pastikan semua persyaratan di atas terpenuhi</i></p>
        </div>
        @if (session()->has('success'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form class="form-control" method="post" action="/skripsi" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="redirect_to" value="{{ url('skripsi') }}">
            <div class="mb-3 mt-3 row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="nim" name="nim" readonly>
                    <input type="hidden" name="mahasiswa_id" id="mahasiswa_id" value="">
                    <input type="hidden" name="batch_id" id="batch_id" value="{{ old('batch_id', $batch->id, '0') }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="jurusan_id" class="col-sm-2 col-form-label">Prodi</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="jurusan_id" name="jurusan_id" readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="judul" class="col-sm-2 col-form-label">Judul Skripsi</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="judul" name="judul_skripsi"></textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="lokasi" class="col-sm-2 col-form-label">Lokasi Penelitian</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="lokasi" name="lokasi_penelitian" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="hp" class="col-sm-2 col-form-label">Nomor Handphone</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" id="hp" name="nomor_handphone" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Alamat Email</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="sks" class="col-sm-2 col-form-label">SKS Yang Ditempuh</label>
                <div class="col-sm-2">
                    <input type="number" class="form-control" id="sks" name="sks" min="110" required>
                </div>
                <label for="sks" class="col-sm-2 col-form-label"><i>* Minimal 110 Sks</i></label>
            </div>
            <div class="mb-3 row">
                <label for="ipk" class="col-sm-2 col-form-label">IPK</label>
                <div class="col-sm-2">
                    <input type="number" step="0.01" class="form-control" id="ipk" name="ipk" required>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="/" class="btn btn-warning"><i class="fa-solid fa-arrow-left"></i> Kembali</a>&nbsp;<button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Daftar</button>
            </div>
        </form>
    @endif
@endsection
@section('js')
    <script src="https://kit.fontawesome.com/ea8c0b4fa9.js" crossorigin="anonymous"></script>
    <script src="{{ url('plugins/jquery/jquery-ui.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {

            $("#nama").autocomplete({
                source: function(request, response) {
                    // Fetch data
                    $.ajax({
                        url: "{{ url('api/getMahasiswa') }}",
                        type: 'post',
                        dataType: "json",
                        data: {
                            _token: CSRF_TOKEN,
                            search: request.term
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                select: function(event, ui) {
                    // Set selection
                    // $('#nim').val(ui.item.label);
                    $('#nim').val(ui.item.nim);
                    $('#mahasiswa_id').val(ui.item.id);
                    $('#nama').val(ui.item.nama);
                    $('#jurusan_id').val(ui.item.jurusan);
                    return false;
                }
            });
        });

        ClassicEditor
            .create(document.querySelector('#judul'), {
                toolbar: ['bold', 'italic'],
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
