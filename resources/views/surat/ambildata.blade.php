@extends('template')
@section('css')
    <!-- JQuery UI -->
    <link rel="stylesheet" href="{{ url('plugins/jquery/jquery-ui.min.css') }}">
@endsection
@section('main')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Permohonan Surat Izin Pengambilan Data</li>
        </ol>
    </nav>
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Syarat Permohonan Surat Pengambilan Data</h4>
        <p>
            1. Telah Terdaftar Sebagai Mahasiswa Skripsi<br />
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
    <form class="form-control" method="post" action="/ambildata" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="redirect_to" value="{{ url('ambildata') }}">
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
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jurusan_id" class="col-sm-3 col-form-label">Prodi</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="jurusan_id" name="jurusan_id" readonly>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="judul" class="col-sm-3 col-form-label">Judul Skripsi</label>
            <div class="col-sm-9">
                <textarea class="form-control" id="judul" name="judul_skripsi"></textarea>
            </div>
        </div>
        <div class="mb-3 mt-3 row">
            <label for="lembaga" class="col-sm-3 col-form-label">Lembaga/Instansi/Perusahaan</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="lembaga" name="lembaga" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="kecamatan" class="col-sm-3 col-form-label">Kecamatan</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="kabupaten" class="col-sm-3 col-form-label">Kabupaten/Kota</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="kabupaten" name="kabupaten" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="provinsi" class="col-sm-3 col-form-label">Provinsi</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="provinsi" name="provinsi" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="kebutuhan" class="col-sm-3 col-form-label">Data Yang Diambil</label>
            <div class="col-sm-8" id="moreData">
                <input type="text" class="form-control" id="kebutuhan" name="kebutuhan[]" required>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <a href="/" class="btn btn-warning"><i class="fa-solid fa-arrow-left"></i> Kembali</a>&nbsp;
            <button type="button" class="btn btn-success" id="addData">Tambah Data</button>&nbsp;
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Daftar</button>
        </div>
    </form>
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

        $(document).ready(function() {
            var upload_number = 2;
            $('#addData').click(function() {
                var moreUploadTag = ''
                moreUploadTag += '<div class="input-group col-sm-8 mt-2">'
                moreUploadTag += '<input type="text" class="form-control" id="kebutuhan" name="kebutuhan[]" required>'
                moreUploadTag += '<a href="javascript:del_data(' + upload_number + ')" class="btn btn-danger" type="button" id="hapusData"><i class="fa fa-trash"></i></a>'
                moreUploadTag += '</div'
                $('<dl id="delete_data' + upload_number + '">' + moreUploadTag + '</dl>').fadeIn('slow').appendTo('#moreData')
                upload_number++
            })
        })

        function del_data(eleId) {
            var ele = document.getElementById("delete_data" + eleId)
            ele.parentNode.removeChild(ele)
        }
    </script>
@endsection
