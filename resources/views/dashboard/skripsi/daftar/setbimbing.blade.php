@extends('dashboard.template')
@section('addcss')
<link rel="stylesheet" href="{{ url('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Pendaftar Skripsi | Set Dosen Pembimbing</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/skripsi/setbimbing') . '/' . $skripsi->id }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control-plaintext" id="nama" name="nama" value="{{ $skripsi->mahasiswa->nama }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control-plaintext" id="nim" name="nim" value="{{ $skripsi->mahasiswa->nim }}" readonly>
                            <input type="hidden" name="mahasiswa_id" id="mahasiswa_id" value="{{ $skripsi->mahasiswa_id }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jurusan_id" class="col-sm-2 col-form-label">Prodi</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control-plaintext" id="jurusan_id" name="jurusan_id" value="{{ $skripsi->mahasiswa->jurusan->jurusan }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="judul" class="col-sm-2 col-form-label">Judul Skripsi</label>
                        <div class="col-sm-10">
                            {!!  $skripsi->judul_skripsi !!}
                            {{-- <textarea class="form-control-plaintext" id="judul" name="judul_skripsi" readonly>{{ old('judul_skripsi', $skripsi->judul_skripsi) }}</textarea> --}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi" class="col-sm-2 col-form-label">Lokasi Penelitian</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control-plaintext" id="lokasi" name="lokasi_penelitian" value="{{ old('lokasi_penelitian', $skripsi->lokasi_penelitian) }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dosen_id" class="col-sm-2 col-form-label">Dosen Pembimbing</label>
                        <div class="col-sm-6">
                            <select id="dosen_id" name="dosen_id" class="form-control select2">
                                <option value="">Dosen Pembimbing</option>
                                @foreach ($dosens as $dosen)
                                    @if ($dosen->id == $skripsi->dosen_id)
                                        <option value="{{ $dosen->id }}" selected>{{ $dosen->nama }}</option>
                                    @else
                                        <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="awal_penugasan" class="col-sm-2 col-form-label">Awal Penugasan</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="awal_penugasan" name="awal_penugasan" value="{{ old('awal_penugasan', $skripsi->awal_penugasan) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="akhir_penugasan" class="col-sm-2 col-form-label">akhir Penugasan</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="akhir_penugasan" name="akhir_penugasan" value="{{ old('akhir_penugasan', $skripsi->akhir_penugasan) }}" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-warning" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>&nbsp;
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
            </div>
            <div class="card-footer">
                *<i>Perhatikan Semuanya
            </div>
        </div>
    </div>
@endsection
@section('addjs')
    <script src="{{ url('plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(function () {
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: 'Dosen Pembimbing'
            })
        });
    </script>
@endsection
