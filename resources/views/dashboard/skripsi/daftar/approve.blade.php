@extends('dashboard.template')
@section('addcss')
@endsection
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Pendaftar Skripsi | Persetujuan Pendaftaran</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        NIM : {{ $skripsi->mahasiswa->nim }}<br />
                        Nama : {{ $skripsi->mahasiswa->nama }}<br />
                    </div>
                    <div class="col-md-6">
                        Jurusan : {{ $skripsi->mahasiswa->jurusan->jenjang }} {{ $skripsi->mahasiswa->jurusan->jurusan }}<br />
                        Judul Skripsi : {{ strip_tags($skripsi->judul_skripsi) }}
                    </div>
                </div>
                <strong>Mata Kuliah Tidak Memenuhi Syarat</strong>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <table class="table table-hover responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode MK</th>
                                    <th>Nama MK</th>
                                    <th>Sks</th>
                                    <th>Nilai Angka</th>
                                    <th>Nilai Huruf</th>
                                </tr>
                            </thead>
                            @if (count($nilai) == 0)
                            <tr>
                                <td colspan="6"><span class="d-flex justify-content-center"><i>Tidak Ada Data Yang Di Tampilkan</i></span></td>
                            </tr>
                            @endif
                            <tbody>
                                <?php $no = 0; ?>
                                @foreach ($nilai as $n)
                                    <?php $no++; ?>
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $n['kdmk'] }}</td>
                                        <td>{{ $n['mk'] }}</td>
                                        <td>{{ $n['sks'] }}</td>
                                        <td>{{ $n['nilai'] }}</td>
                                        <td>{{ App\Http\Controllers\TranskripController::cariNilaiHuruf($n['nilai']) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6"><span class="d-flex justify-content-end"><i>* Jumlah SKS Yang Sudah Di Tempuh {{ $sks }} Detail Nilai Dapat Di Lihat Di  </i><strong><a href="{{ url('webmin/transkrip/edit?nim=') . $skripsi->mahasiswa->nim }}" >Data Nilai</a></strong></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <form class="form-horizontal" method="post" action="{{ url('webmin/skripsi/status') . '/' . $skripsi->id }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                    <div class="form-group row">
                        <label for="hp" class="col-sm-2 col-form-label">No HP/Whatsapp</label>
                        <div class="col-sm-2">
                            <input type="text" id="hp" name="hp" class="form-control-plaintext" value="{{ $hp }}" readonly>
                        </div>
                        <div class="col-sm-4">
                            <a href="https://api.whatsapp.com/send?phone={{ $hp }}&text=Assalamualaikum%20Wr.%20Wb" class="btn btn-success" target="_blank"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">Dosen Pembimbing</label>
                        <div class="col-sm-6">
                            <select id="status" name="status" class="form-control" required>
                                @if($skripsi->status == 0)
                                    <option value="0">-- Pilih Status --</option>
                                @else
                                <option value="{{ $skripsi->status }}">{{ App\Http\Controllers\SkripsiController::getStatus($skripsi->status) }}</option>
                                @endif
                                <option value="1">Teruskan Ke Koordinator Skripsi</option>
                                <option value="2">Teruskan Ke Kaprodi</option>
                                <option value="3">Penugasan Dosen Pembimbing</option>
                                <option value="4">Pendaftaran Tidak Diterima</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangn</label>
                        <div class="col-sm-10">
                            <textarea id="keterangan" name="keterangan" class="form-control">{{ old('keterangan', $skripsi->keterangan) }}</textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-warning" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>&nbsp;
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
            </div>
            <div class="card-footer">
                <i>* Sumber Data Nilai Dan SKS Dari Forlap/Feeder Dikti</i>
            </div>
        </div>
    </div>
@endsection
