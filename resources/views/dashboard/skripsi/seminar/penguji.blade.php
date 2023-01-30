@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Pendaftar Seminar Skripsi | Dosen Penguji</h5>
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
                        <td><strong>Judul seminar</strong></td>
                        <td>{{ strip_tags($seminar->judul_skripsi) }}</td>
                    </tr>
                </table>
                <div class="d-flex justify-content-end mt-2 mb-2">
                    @if ($seminar->status != 5)
                        <a href="{{ url('webmin/seminar/penguji') . '/' . $seminar->id . '/add' }}" class="btn btn-primary"><i class="fas fa-plus"></i> Input Penguji</a>
                    @endif
                </div>
                <table class="table table-striped">
                    <tr>
                        <th>No</th>
                        <th>NIY</th>
                        <th>Nama</th>
                        <th>Homebase</th>
                        <th></th>
                    </tr>
                    @foreach ($seminar->dosen as $dosen)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dosen->niy }}</td>
                            <td>{{ $dosen->nama }}</td>
                            <td>{{ $dosen->jurusan->jenjang }} {{ $dosen->jurusan->jurusan }}</td>
                            <td>
                                @if ($seminar->status != 5)
                                    <form action="/webmin/seminar/penguji/{{ $seminar->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                        <input type="hidden" name="dosen_id" value="{{ $dosen->id }}">
                                        <button class="badge bg-danger border-0 button-delete" data-message=" Penguji {{ $dosen->nama }} "><i class="fas fa-trash"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
                @if ($seminar->status == 5)
                    <div class="d-flex justify-content-end mt-2 mb-2">
                        <a href="{{ url('webmin/seminar') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>&nbsp;
                        <a href="/webmin/seminar/{{ $seminar->id }}/tugas" class="btn btn-success" target="_blank"><i class="fa fa-envelope"></i> Cetak Surat Penugasan</a>
                    </div>
                @else
                    <form action="/webmin/seminar/penerbitan/{{ $seminar->id }}" method="post" enctype="multipart/form-data" class="mb-2 mt-2">
                        @method('put')
                        @csrf
                        <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                        <div class="form-group row">
                            <label for="waktu_seminar" class="col-sm-2 col-form-label">Waktu Seminar</label>
                            <div class="col-sm-4">
                                <input type="datetime-local" id="waktu_seminar" name="waktu_seminar" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ruang" class="col-sm-2 col-form-label">Ruang</label>
                            <div class="col-sm-4">
                                <input type="text" id="ruang" name="ruang" class="form-control" placeholder="Ruang" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-2 mb-2">
                            <a href="{{ url('webmin/seminar') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>&nbsp;
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
