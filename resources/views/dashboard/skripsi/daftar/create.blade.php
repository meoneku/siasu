@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Pendaftar Skripsi | Tambah</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/skripsi') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="redirect_to" value="{{ url('webmin/skripsi') }}">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="nim" name="nim" readonly>
                            <input type="hidden" name="mahasiswa_id" id="mahasiswa_id" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jurusan_id" class="col-sm-2 col-form-label">Prodi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="jurusan_id" name="jurusan_id" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="judul" class="col-sm-2 col-form-label">Judul Skripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="judul" name="judul_skripsi"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi" class="col-sm-2 col-form-label">Lokasi Penelitian</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="lokasi" name="lokasi_penelitian" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hp" class="col-sm-2 col-form-label">Nomor Handphone</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="hp" name="nomor_handphone" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Alamat Email</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sks" class="col-sm-2 col-form-label">SKS Yang Ditempuh</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" id="sks" name="sks" required>
                        </div>
                        <label for="sks" class="col-sm-2 col-form-label"><i>* Minimal 144 Sks</i></label>
                    </div>
                    <div class="form-group row">
                        <label for="ipk" class="col-sm-2 col-form-label">IPK</label>
                        <div class="col-sm-2">
                            <input type="number" step="0.01" class="form-control" id="ipk" name="ipk" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="batch_id" class="col-sm-2 col-form-label">Batch</label>
                        <div class="col-sm-4">
                            <select name="batch_id" id="batch_id" class="form-control">
                                @foreach ($batchs as $batch)
                                    <option value="{{ $batch->id }}">{{ $batch->nama }} - {{ $batch->kegiatan->nama }}</option>
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
                *<i>Perhatikan Penulisan Nama Lulusan
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
