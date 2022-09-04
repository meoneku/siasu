@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Lulusan | Tambah</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/lulusan') . '/' . $lulusan->id }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                    <div class="form-group row">
                        <label for="nim" class="col-sm-2 col-form-label">NIM</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" placeholder="Nomor Induk Mahasiswa" value="{{ old('nim', $lulusan->nim) }}" maxlength="10" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama Lengkap" value="{{ old('nama', $lulusan->nama) }}" maxlength="128" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Jurusan/Prodi</label>
                        <div class="col-sm-8">
                            <select id="jurusan" name="jurusan_id" class="form-control" required>
                                @foreach ($jurusan as $prodi)
                                    @if ($prodi->id == old('jurusan_id', $lulusan->jurusan_id))
                                        <option value="{{ $prodi->id }}" selected>{{ $prodi->jenjang }} {{ $prodi->jurusan }}</option>
                                    @else
                                        <option value="{{ $prodi->id }}">{{ $prodi->jenjang }} {{ $prodi->jurusan }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tempat" class="col-sm-2 col-form-label">Tempat Lahir</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ old('tempat_lahir', $lulusan->tempat_lahir) }}" maxlength="128" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal" name="tanggal_lahir" value="{{ old('tanggal_lahir', $lulusan->tanggal_lahir) }}"required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gender" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-2">
                            <select id="gender" name="gender" class="form-control" required>
                                <option value="{{ $lulusan->gender }}" selected>{{ $lulusan->gender }}</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_lulus" class="col-sm-2 col-form-label">Tanggal Lulus</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control @error('tanggal_lulus') is-invalid @enderror" id="tanggal_lulus" name="tanggal_lulus" value="{{ old('tanggal_lulus', $lulusan->tanggal_lulus) }}"required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_wisuda" class="col-sm-2 col-form-label">Tanggal Wisuda</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control @error('tanggal_wisuda') is-invalid @enderror" id="tanggal_wisuda" name="tanggal_wisuda" value="{{ old('tanggal_wisuda', $lulusan->tanggal_wisuda) }}"required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pin" class="col-sm-2 col-form-label">PIN</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control @error('pin') is-invalid @enderror" id="pin" name="pin" placeholder="Penomoran Ijazah Nasional" value="{{ old('pin', $lulusan->pin) }}" maxlength="20" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nomorijazah" class="col-sm-2 col-form-label">Nomor Ijazah</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control @error('nomorijazah') is-invalid @enderror" id="nomorijazah" name="nomorijazah" placeholder="Nomor Urut Ijazah" value="{{ old('nomorijazah', $lulusan->nomorijazah) }}" maxlength="20" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="judul" class="col-sm-2 col-form-label">Judul Skripsi</label>
                        <div class="col-sm-10">
                            <textarea id="judul" name="judul_skripsi" class="form-control" required>{{ old('judul_skripsi', $lulusan->judul_skripsi, 'Judul-judulan') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label">foto</label>
                        <div class="col-sm-6">
                            <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*" onchange="preview()">
                            <small class="text-muted"><i>* Maksimum Ukuran Foto 2 MB (2048 KB)</i></small><br>
                            <img id="frame" src="{{ url('uploads') . '/' . $lulusan->foto }}" width="140px" height="160px" />
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
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
    <script>
        function preview() {
            frame.style.display = "block";
            frame.src = URL.createObjectURL(event.target.files[0]);
        }
        ClassicEditor
            .create(document.querySelector('#judul'), {
                toolbar: ['bold', 'italic'],
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
