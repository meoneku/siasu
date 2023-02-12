@extends('template')
@section('css')
    <!-- JQuery UI -->
    <link rel="stylesheet" href="{{ url('plugins/jquery/jquery-ui.min.css') }}">
    <!-- Select 2 -->
    <link rel="stylesheet" href="{{ url('plugins/select2/css/select2.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection
@section('main')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Permohonan Surat Izin Praktik Industri / Kerja Praktik</li>
        </ol>
    </nav>
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Syarat Permohonan Surat Izin Praktik Industri / Kerja Praktik</h4>
        <p>
            1. Telah Melunasi Pembayaran Praktik Industri / Kerja Praktik<br />
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
    <form class="form-control" method="post" action="/suratpi" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="redirect_to" value="{{ url('suratpi') }}">
        <div class="mb-3 mt-3 row">
            <label for="tempat" class="col-sm-2 col-form-label">Tempat PI/KP</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="tempat" name="tempat" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="alamat" name="alamat" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="kabupaten" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="kabupaten" name="kabupaten" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="provinsi" name="provinsi" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Pelaksanaan</label>
            <div class="col-sm-2">
                <input type="date" class="form-control" id="tanggal" name="mulai_tanggal" required>
            </div>
            <label for="sks" class="col-sm-1 col-form-label text-center">Sampai </label>
            <div class="col-sm-2">
                <input type="date" class="form-control" id="tanggal" name="selesai_tanggal" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="mahasiswa_id" class="col-sm-2 col-form-label">Mahasiswa</label>
            <div class="col-sm-8">
                <select class="form-control select2" id="mahasiswa_id" name="mahasiswa_id[]" multiple required></select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="jurusan_id" class="col-sm-2 col-form-label">Prodi</label>
            <div class="col-sm-8">
                <select class="form-control" id="jurusan_id" name="jurusan_id" required>
                    @foreach ($jurusan as $j)
                        <option value="{{ $j->id }}">{{ $j->jenjang }} {{ $j->jurusan }}</option>
                    @endforeach
                </select>
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
    <script src="{{ url('plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2({
                theme: 'bootstrap-5',
                placeholder: 'Cari Nama Mahasiswa',
                ajax: {
                    url: '{{ url('api/getMahasiswaId') }}',
                    dateType: 'json',
                    data: function(params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            })
        });
    </script>
@endsection
