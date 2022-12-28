@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Dosen | Tambah</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/mahasiswa') . '/' . $mahasiswa->id }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                    <div class="form-group row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" placeholder="Nomor Induk Mahasiswa" value="{{ old('nim', $mahasiswa->nim) }}" maxlength="15" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama Lengkap" value="{{ old('nama', $mahasiswa->nama) }}" maxlength="128" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Jurusan/Prodi</label>
                        <div class="col-sm-8">
                            <select id="jurusan" name="jurusan_id" class="form-control" required>
                                @foreach ($jurusan as $prodi)
                                    @if ($prodi->id == $mahasiswa->jurusan_id)
                                        <option value="{{ $prodi->id }}" selected>{{ $prodi->jenjang }} {{ $prodi->jurusan }}</option>
                                    @else
                                        <option value="{{ $prodi->id }}">{{ $prodi->jenjang }} {{ $prodi->jurusan }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-4">
                            <select id="status" name="status" class="form-control" required>
                                @foreach ($status as $kondisi)
                                    @if ($kondisi == $mahasiswa->status)
                                        <option value="{{ $kondisi }}" selected>{{ $kondisi }}</option>
                                    @else
                                        <option value="{{ $kondisi }}">{{ $kondisi }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label">foto</label>
                        <div class="col-sm-6">
                            <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*" onchange="preview()">
                            <small class="text-muted"><i>* Maksimum Ukuran Foto 2 MB (2048 KB)</i></small><br>
                            <img id="frame" src="{{ url('uploads') . '/' . $mahasiswa->foto }}" width="140px" height="160px" />
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-warning" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>&nbsp;
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
            </div>
            <div class="card-footer">
                *<i>Perhatikan Penulisan Nama Dosen
            </div>
        </div>
    </div>
    <script>
        function preview() {
            frame.style.display = "block";
            frame.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
@endsection
