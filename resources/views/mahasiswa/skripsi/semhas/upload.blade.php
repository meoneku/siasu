@extends('mahasiswa.layout')
@section('addcss')
    <link rel="stylesheet" href="{{ url('css/loading.css') }}">
@endsection
@section('main')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Unggah Berkas</h4>
                    <p>
                        1. Pastikan Ukuran File Berukuran Maksimal 500 kb<br />
                        2. Jenis File Bertipe Gambar (.jpg, jpeg, .png)<br />
                    </p>
                </div>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ route('semhas.updateUnggah', encrypt($data->id)) }}" enctype="multipart/form-data" onsubmit="return Animate()">
                    @csrf
                    <div class="form-group row mb-3 mt-3">
                        <label for="file_pembayaran" class="col-sm-2 col-form-label">Bukti Pembayaran</label>
                        <div class="col-sm-6">
                            <input type="file" name="file_pembayaran" id="file_pembayaran" class="form-control @error('file_pembayaran') is-invalid @enderror" accept="image/*" onchange="preview1()">
                            <small class="text-muted"><i>* Maksimum Ukuran Bekas 500 kb</i></small><br>
                            @if ($data->file_pembayaran == null or $data->file_pembayaran == '')
                                <img id="frame1" src="" width="140px" height="160px" style="display:none" />
                            @else
                                <img id="frame1" src="{{ url('uploads') . '/' . $data->file_pembayaran }}" width="140px" height="200px" />
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3 mt-3">
                        <label for="file_brica_seminar" class="col-sm-2 col-form-label">KRS</label>
                        <div class="col-sm-6">
                            <input type="file" name="file_brica_seminar" id="file_brica_seminar" class="form-control @error('file_brica_seminar') is-invalid @enderror" accept="image/*" onchange="preview2()">
                            <small class="text-muted"><i>* Maksimum Ukuran Bekas 500 kb</i></small><br>
                            @if ($data->file_brica_seminar == null or $data->file_brica_seminar == '')
                                <img id="frame2" src="" width="140px" height="200px" style="display:none" />
                            @else
                                <img id="frame2" src="{{ url('uploads') . '/' . $data->file_krs }}" width="140px" height="200px" />
                            @endif
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-warning" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>&nbsp;
                        <button type="submit" class="btn btn-primary"><i class="fas fa-upload"></i> Unggah</button>
                        <span id="loading" class="lds-hourglass" style="display: none"></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('addjs')
    <script>
        const loading = document.getElementById('loading')

        function Animate() {
            loading.style.display = "block"

            return true
        }

        function preview1() {
            frame1.style.display = "block";
            frame1.src = URL.createObjectURL(event.target.files[0]);
        }

        function preview2() {
            frame2.style.display = "block";
            frame2.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
