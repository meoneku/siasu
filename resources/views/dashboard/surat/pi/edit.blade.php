@extends('dashboard.template')
@section('addcss')
    <!-- Select 2 -->
    <link rel="stylesheet" href="{{ url('plugins/select2/css/select2.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Pendaftar Seminar Hasil Skripsi | Tambah</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/suratpi') . '/' . $suratpi->id }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                    <div class="form-group row">
                        <label for="tempat" class="col-sm-2 col-form-label">Tempat PI/KP</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tempat" name="tempat" value="{{ old('tempat', $suratpi->tempat) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat', $suratpi->alamat) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kecamatan" class="col-sm-2 col-form-label">Kecamatan</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $suratpi->kecamatan) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kabupaten" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="kabupaten" name="kabupaten" value="{{ old('kabupaten', $suratpi->kabupaten) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="provinsi" class="col-sm-2 col-form-label">Provinsi</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="provinsi" name="provinsi" value="{{ old('provinsi', $suratpi->provinsi) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Pelaksanaan</label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control" id="tanggal" name="mulai_tanggal" value="{{ old('mulai_tanggal', $suratpi->mulai_tanggal) }}" required>
                        </div>
                        <label for="sks" class="col-sm-1 col-form-label text-center">Sampai </label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control" id="tanggal" name="selesai_tanggal" value="{{ old('selesai_tanggal', $suratpi->selesai_tanggal) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mahasiswa_id" class="col-sm-2 col-form-label">Mahasiswa</label>
                        <div class="col-sm-8">
                            <select class="form-control select2" id="mahasiswa_id" name="mahasiswa_id[]" multiple required>
                                @foreach ($suratpi->mahasiswa as $mahasiswa)
                                    <option value="{{ $mahasiswa->id }}" selected>{{ $mahasiswa->nim }} | {{ $mahasiswa->nama }} | {{ $mahasiswa->jurusan->jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jurusan_id" class="col-sm-2 col-form-label">Prodi</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="jurusan_id" name="jurusan_id" required>
                                @foreach ($jurusan as $j)
                                    @if ($j->id == $suratpi->jurusan_id)
                                        <option value="{{ $j->id }}" selected>{{ $j->jenjang }} {{ $j->jurusan }}</option>
                                    @else
                                        <option value="{{ $j->id }}">{{ $j->jenjang }} {{ $j->jurusan }}</option>
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
