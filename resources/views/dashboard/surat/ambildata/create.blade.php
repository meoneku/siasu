@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Pemohohon Surat Mengambil Data | Tambah</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/suratambildata') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="redirect_to" value="{{ url('webmin/suratambildata') }}">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nim" class="col-sm-3 col-form-label">NIM</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="nim" name="nim" readonly>
                            <input type="hidden" name="mahasiswa_id" id="mahasiswa_id" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jurusan_id" class="col-sm-3 col-form-label">Prodi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="jurusan_id" name="jurusan_id" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
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
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kecamatan" class="col-sm-3 col-form-label">Kecamatan</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kabupaten" class="col-sm-3 col-form-label">Kabupaten/Kota</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="kabupaten" name="kabupaten" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="provinsi" class="col-sm-3 col-form-label">Provinsi</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="provinsi" name="provinsi" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kebutuhan" class="col-sm-3 col-form-label">Data Yang Diambil</label>
                        <div class="col-sm-8" id="moreData">
                            <input type="text" class="form-control" id="kebutuhan" name="kebutuhan[]" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-warning" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>&nbsp;
                        <button type="button" class="btn btn-primary" id="addData"><i class="fa fa-plus"></i> Tambah Data</button>&nbsp;
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
                moreUploadTag += '<div class="input-group mt-2">'
                moreUploadTag += '<input type="text" class="form-control" id="kebutuhan" name="kebutuhan[]" required>'
                moreUploadTag += '<a href="javascript:del_data(' + upload_number + ')" class="btn btn-danger" type="button" id="hapusData"><i class="fa fa-trash"></i></a>'
                moreUploadTag += '</div>'
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
