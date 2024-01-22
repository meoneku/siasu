@extends('mahasiswa.layout')
@section('main')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Syarat Pendaftaran Skripsi</h4>
                    <p>
                        1. Telah Melunasi Pembayaran Semester Berjalan<br />
                        2. Menyertakan foto kopi Transkrip Nilai
                    </p>
                    <hr>
                    <p class="mb-0"><i>* Pastikan semua persyaratan di atas terpenuhi</i></p>
                </div>
            </div>
            <div class="card-body">
                <form class="form-control" method="post" action="/skripsi" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="redirect_to" value="{{ url('webmin/skripsi') }}">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-warning" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>&nbsp;
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection