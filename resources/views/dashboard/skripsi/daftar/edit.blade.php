@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Pendaftar Skripsi | Edit</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/skripsi') . '/' . $skripsi->id }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $skripsi->mahasiswa->nama }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="nim" name="nim" value="{{ $skripsi->mahasiswa->nim }}" readonly>
                            <input type="hidden" name="mahasiswa_id" id="mahasiswa_id" value="{{ $skripsi->mahasiswa_id }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jurusan_id" class="col-sm-2 col-form-label">Prodi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="jurusan_id" name="jurusan_id" value="{{ $skripsi->mahasiswa->jurusan->jurusan }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="judul" class="col-sm-2 col-form-label">Judul Skripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="judul" name="judul_skripsi">{{ old('judul_skripsi', $skripsi->judul_skripsi) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi" class="col-sm-2 col-form-label">Lokasi Penelitian</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="lokasi" name="lokasi_penelitian" value="{{ old('lokasi_penelitian', $skripsi->lokasi_penelitian) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="hp" class="col-sm-2 col-form-label">Nomor Handphone</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="hp" name="nomor_handphone" value="{{ old('nomor_handphone', $skripsi->nomor_handphone) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Alamat Email</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $skripsi->email) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="sks" class="col-sm-2 col-form-label">SKS Yang Ditempuh</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" id="sks" name="sks" value="{{ old('sks', $skripsi->sks) }}" required>
                        </div>
                        <label for="sks" class="col-sm-2 col-form-label"><i>* Minimal 144 Sks</i></label>
                    </div>
                    <div class="form-group row">
                        <label for="ipk" class="col-sm-2 col-form-label">IPK</label>
                        <div class="col-sm-2">
                            <input type="number" step="0.01" class="form-control" id="ipk" name="ipk" value="{{ old('ipk', $skripsi->ipk) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="batch_id" class="col-sm-2 col-form-label">Batch</label>
                        <div class="col-sm-4">
                            <select name="batch_id" id="batch_id" class="form-control">
                                @foreach ($batchs as $batch)
                                    @if ($batch->id == $skripsi->batch_id)
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
