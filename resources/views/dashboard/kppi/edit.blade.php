@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Pendaftar Praktik Industri/Kerja Praktik | Tambah</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/kppi') . '/' . $kppi->id }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $kppi->mahasiswa->nama) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="nim" name="nim" value="{{ old('nim', $kppi->mahasiswa->nim) }}" readonly>
                            <input type="hidden" name="mahasiswa_id" id="mahasiswa_id" value="{{ old('mahasiswa_id', $kppi->mahasiswa_id) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jurusan_id" class="col-sm-2 col-form-label">Prodi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="jurusan_id" name="jurusan_id" value="{{ old('jurusan_id', $kppi->mahasiswa->jurusan->jenjang .' '. $kppi->mahasiswa->jurusan->jurusan) }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi" class="col-sm-2 col-form-label">Lokasi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ old('lokasi', $kppi->lokasi) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $kppi->alamat) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hp" class="col-sm-2 col-form-label">Nomor Handphone / WA</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="hp" name="hp" value="{{ old('hp', $kppi->hp) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $kppi->email) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Pelaksanaan</label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control" id="tanggal" name="mulai" value="{{ old('mulai', $kppi->mulai) }}" required>
                        </div>
                        <label for="tanggal" class="col-sm-1 col-form-label text-center">Sampai</label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control" id="tanggal" name="selesai" value="{{ old('selesai', $kppi->selesai) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="batch_id" class="col-sm-2 col-form-label">Batch</label>
                        <div class="col-sm-5">
                            <select name="batch_id" id="batch_id" class="form-control">
                                @foreach ($batchs as $batch)
                                    @if ($batch->id == $kppi->batch_id)
                                        <option value="{{ $batch->id }}" selected>{{ $batch->nama }} - {{ $batch->kegiatan->nama }}</option>
                                    @else
                                        <option value="{{ $batch->id }}">{{ $batch->nama }} - {{ $batch->kegiatan->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-warning" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>&nbsp;
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
            </div>
            <div class="card-footer">
                *
            </div>
        </div>
    </div>
@endsection
@section('addjs')
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
