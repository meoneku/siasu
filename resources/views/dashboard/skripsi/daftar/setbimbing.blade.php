@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Pendaftar Skripsi | Dosen Pembimbing</h5>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td class="col-sm-2"><strong>NIM</strong></td>
                        <td class="col-sm-4">{{ $skripsi->mahasiswa->nim }}</td>
                        <td class="col-sm-2"><strong>Prodi</strong></td>
                        <td class="col-sm-4">{{ $skripsi->mahasiswa->jurusan->jenjang }} {{ $skripsi->mahasiswa->jurusan->jurusan }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nama</strong></td>
                        <td>{{ $skripsi->mahasiswa->nama }}</td>
                        <td><strong>Judul Skripsi</strong></td>
                        <td>{{ strip_tags($skripsi->judul_skripsi) }}</td>
                    </tr>
                </table>
                <div class="d-flex justify-content-end mt-2 mb-2">
                    @if ($skripsi->status != 5)
                        <a href="{{ url('webmin/skripsi') . '/' . $skripsi->id . '/addbimbing' }}" class="btn btn-primary"><i class="fas fa-plus"></i> Input Pembimbing</a>
                    @endif
                </div>
                <table class="table table-striped">
                    <tr>
                        <th>No</th>
                        <th>NIY</th>
                        <th>Nama</th>
                        <th>Homebase</th>
                        <th>Pembimbing</th>
                        <th></th>
                    </tr>
                    @foreach ($skripsi->dosen as $dosen)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dosen->niy }}</td>
                            <td>{{ $dosen->nama }}</td>
                            <td>{{ $dosen->jurusan->jenjang }} {{ $dosen->jurusan->jurusan }}</td>
                            <td>{{ $dosen->pivot->pembimbing }}</td>
                            <td>
                                @if ($skripsi->status != 5)
                                    <form action="/webmin/skripsi/pembimbing/{{ $skripsi->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                        <input type="hidden" name="dosen_id" value="{{ $dosen->id }}">
                                        <button class="badge bg-danger border-0 button-delete" data-message=" Pembimbing {{ $dosen->nama }} "><i class="fas fa-trash"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
                @if ($skripsi->status == 5)
                <div class="form-group row  mt-3 mb-2">
                    <label for="awal_penugasan" class="col-sm-2 col-form-label">Awal Penugasan</label>
                    <div class="col-sm-4">
                        <input type="date" id="awal_penugasan" name="awal_penugasan" class="form-control" value="{{ $skripsi->awal_penugasan }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="akhir_penugasan" class="col-sm-2 col-form-label">Akhir Penugasan</label>
                    <div class="col-sm-4">
                        <input type="date" id="akhir_penugasan" name="akhir_penugasan" class="form-control" value="{{ $skripsi->akhir_penugasan }}" readonly>
                    </div>
                </div>
                    <div class="d-flex justify-content-end mt-2 mb-2">
                        <a href="{{ url('webmin/skripsi') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>&nbsp;
                        <a href="/webmin/skripsi/penugasan/{{ $skripsi->id }}" class="btn btn-success" target="_blank"><i class="fa fa-envelope"></i> Cetak Surat Penugasan</a>
                    </div>
                @else
                    <form action="/webmin/skripsi/penerbitan/{{ $skripsi->id }}" method="post" enctype="multipart/form-data" class="mt-3 mb-2">
                        @csrf
                        <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                        <div class="form-group row">
                            <label for="awal_penugasan" class="col-sm-2 col-form-label">Awal Penugasan</label>
                            <div class="col-sm-4">
                                <input type="date" id="awal_penugasan" name="awal_penugasan" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="akhir_penugasan" class="col-sm-2 col-form-label">Akhir Penugasan</label>
                            <div class="col-sm-4">
                                <input type="date" id="akhir_penugasan" name="akhir_penugasan" class="form-control" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-2 mb-2">
                            <a href="{{ url('webmin/skripsi') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>&nbsp;
                            <button type="submit" class="btn btn-primary"><i class="fa fa-envelope"></i> Terbitkan Surat Penugasan</button>
                        </div>
                    </form>
                @endif
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
@endsection
