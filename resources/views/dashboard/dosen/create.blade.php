@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Dosen | Tambah</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/dosen') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="niy" class="col-sm-2 col-form-label">NIY</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control @error('niy') is-invalid @enderror" id="niy" name="niy" placeholder="Nomor Induk Yayasan" value="{{ old('niy') }}" maxlength="15" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nidn" class="col-sm-2 col-form-label">NIDN</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control @error('nidn') is-invalid @enderror" id="nidn" name="nidn" placeholder="Nomor Induk Dosen Nasional" value="{{ old('nidn') }}" maxlength="15" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}" maxlength="128" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jurusan" class="col-sm-2 col-form-label">Jurusan/Prodi</label>
                        <div class="col-sm-8">
                            <select id="jurusan" name="jurusan_id" class="form-control" required>
                                @foreach ($jurusan as $prodi)
                                    <option value="{{ $prodi->id }}">{{ $prodi->jenjang }} {{ $prodi->jurusan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tmt" class="col-sm-2 col-form-label">TMT</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control @error('tmt') is-invalid @enderror" id="tmt" name="tmt" placeholder="dd/mm/yyyy" value="{{ old('tmt') }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                        <div class="col-sm-4">
                            <select id="jabatan" name="jabatan" class="form-control" required>
                                @foreach ($jabatan as $pos)
                                    <option value="{{ $pos }}">{{ $pos }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jafung" class="col-sm-2 col-form-label">Jabatan Fungsional</label>
                        <div class="col-sm-3">
                            <select id="jafung" name="jafung" class="form-control" required>
                                @foreach ($jafung as $jf)
                                    <option value="{{ $jf }}">{{ $jf }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="golongan" class="col-sm-2 col-form-label">Pangkat Golongan</label>
                        <div class="col-sm-3">
                            <select id="golongan" name="golongan" class="form-control" required>
                                @foreach ($golongan as $gol)
                                    <option value="{{ $gol }}">{{ $gol }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="foto" class="col-sm-2 col-form-label">foto</label>
                        <div class="col-sm-6">
                            <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*" onchange="preview()">
                            <small class="text-muted"><i>* Maksimum Ukuran Foto 2 MB (2048 KB)</i></small><br>
                            <img id="frame" src="" width="140px" height="160px" style="display:none" />
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
