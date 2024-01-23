@extends('mahasiswa.layout')
@section('main')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ route('seminar.update', encrypt($data->id)) }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                    <div class="mb-3 mt-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $data->mahasiswa->nama }}" readonly>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control" id="nim" name="nim" value="{{ $data->mahasiswa->nim }}" readonly>
                            <input type="hidden" name="mahasiswa_id" id="mahasiswa_id" value="{{ Auth::guard('mahasiswa')->user()->id }}">
                            <input type="hidden" name="batch_id" id="batch_id" value="{{ old('batch_id', $data->batch_id, '0') }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="judul" class="col-sm-2 col-form-label">Judul Skripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="judul" name="judul_skripsi">{{ $data->judul_skripsi }}</textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="lokasi" class="col-sm-2 col-form-label">Lokasi Penelitian</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="lokasi" name="lokasi_penelitian" value="{{ $data->lokasi_penelitian }}" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-warning" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>&nbsp;
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('addjs')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#judul'), {
                toolbar: ['bold', 'italic'],
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
