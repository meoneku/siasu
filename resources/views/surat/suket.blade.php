@extends('template')
@section('css')
    <!-- JQuery UI -->
    <link rel="stylesheet" href="{{ url('plugins/jquery/jquery-ui.min.css') }}">
@endsection
@section('main')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Permohonan Surat Keterangan Aktif</li>
        </ol>
    </nav>
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Syarat Permohonan Keterangan Aktif</h4>
        <p>
            1. Telah Terdaftar Sebagai Mahasiswa Aktif Di Semester Berjalan<br />
        </p>
        <hr>
        <p class="mb-0"><i>* Pastikan persyaratan telah terpenuhi</i></p>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form class="form-control" method="post" action="/suket" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="redirect_to" value="{{ url('suket') }}">
        <div class="mb-3 mt-3 row">
            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="nim" class="col-sm-3 col-form-label">NIM</label>
            <div class="col-sm-4">
                <input type="number" class="form-control" id="nim" name="nim" readonly>
                <input type="hidden" name="mahasiswa_id" id="mahasiswa_id" value="">
                <input type="hidden" name="semester" id="semester" value="{{ App\Helpers\Codes::getSemesterNow() }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jurusan_id" class="col-sm-3 col-form-label">Prodi</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="jurusan_id" name="jurusan_id" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="angkatan" class="col-sm-3 col-form-label">Semester</label>
            <div class="col-sm-2">
                <input type="number" class="form-control" id="angkatan" name="angkatan" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="keperluan" class="col-sm-3 col-form-label">Keperluan</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="keperluan" name="keperluan" required>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <a href="/" class="btn btn-warning"><i class="fa-solid fa-arrow-left"></i> Kembali</a>&nbsp;
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Daftar</button>
        </div>
    </form>
@endsection
@section('js')
    <script src="https://kit.fontawesome.com/ea8c0b4fa9.js" crossorigin="anonymous"></script>
    <script src="{{ url('plugins/jquery/jquery-ui.min.js') }}"></script>
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
    </script>
@endsection
