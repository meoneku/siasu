@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Pendaftar Seminar Hasil Skripsi | Status Daftar</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td class="col-sm-2"><strong>NIM</strong></td>
                        <td class="col-sm-4">{{ $seminar->mahasiswa->nim }}</td>
                        <td class="col-sm-2"><strong>Prodi</strong></td>
                        <td class="col-sm-4">{{ $seminar->mahasiswa->jurusan->jenjang }} {{ $seminar->mahasiswa->jurusan->jurusan }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nama</strong></td>
                        <td>{{ $seminar->mahasiswa->nama }}</td>
                        <td><strong>Judul Skripsi</strong></td>
                        <td>{{ strip_tags($seminar->judul_skripsi) }}</td>
                    </tr>
                </table>
                <form class="form-horizontal" method="post" action="{{ url('webmin/semhas/status') . '/' . $seminar->id }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                    <div class="form-group row">
                        <label for="status" class="col-sm-2 col-form-label">Status Pendaftaran</label>
                        <div class="col-sm-6">
                            <select id="status" name="status" class="form-control" required>
                                @if ($seminar->status == 0)
                                    <option value="0">-- Pilih Status --</option>
                                @else
                                    <option value="{{ $seminar->status }}">{{ App\Helpers\Codes::getStatusSeminar($seminar->status) }}</option>
                                @endif
                                <option value="1">Teruskan Ke Koordinator Skripsi</option>
                                <option value="2">Teruskan Ke Kaprodi</option>
                                <option value="3">Penugasan Dosen Penguji</option>
                                <option value="4">Seminar Tidak Diterima</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangn</label>
                        <div class="col-sm-10">
                            <textarea id="keterangan" name="keterangan" class="form-control">{{ old('keterangan', $seminar->keterangan) }}</textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-warning" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>&nbsp;
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
@endsection
