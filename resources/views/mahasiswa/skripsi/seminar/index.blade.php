@extends('mahasiswa.layout')
@section('main')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Syarat Pendaftaran Seminar Skripsi</h4>
                    <p>
                        1. Telah Melunasi Pembayaran Semester Berjalan<br />
                        2. Melakukan Pembayaran Seminar Skripsi<br />
                        3. Foto Copy KRS Semester Berjalan
                    </p>
                    <hr>
                    <p class="mb-0">
                        <i>* Pastikan semua persyaratan di atas terpenuhi</i><br />
                        <i>* Panduan Pembayaran melalui VA (Virtual Account) <a href="https://drive.google.com/file/d/1ajIAlCY4T6O5v3xaR3wUbYSrttD6eZr_/view" target="_blank">Klik Disini</a></i>
                    </p>
                </div>
                <form action="{{ route('seminar.index') }}">
                    <div class="input-group">
                        <input type="text" name="judul" class="form-control rounded-0 w-25" placeholder="Semua Judul" value="{{ request('judul') }}">
                        <button class="btn btn-danger btn-flat" type="submit"><i class="fas fa-search"></i></button>
                        <a href="{{ route('seminar.index') }}" class="btn btn-info btn-flat"><i class="fas fa-circle-notch"></i></a>
                        <a href="{{ route('seminar.create') }}" class="btn btn-primary btn-flat"><i class="fas fa-plus"></i> Daftar</a>
                    </div>
                </form>
                <div class="row mt-4 mb-4">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">No</th>
                                    <th scope="col">Judul Skripsi</th>
                                    <th scope="col">Gelombang</th>
                                    <th scope="col">No. VA</th>
                                    <th scope="col">Nominal</th>
                                    <th scope="col">Waktu Ujian</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($seminars as $seminar)
                                <tr>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info btn-xs">#</button>
                                            <button type="button" class="btn btn-info btn-xs dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <a class="dropdown-item" href="{{ route('seminar.edit', encrypt($seminar->id)) }}"><i class="fas fa-edit"></i> Edit / Lihat</a>
                                                <a class="dropdown-item" href="{{ route('seminar.cetakForm', encrypt($seminar->id))}}" target="_blank"><i class="fas fa-file-pdf"></i> Form Pendaftaran</a>
                                                @if ($seminar->status == 5)
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{ route('seminar.cetakBrica', encrypt($seminar->id))}}" target="_blank"><i class="fas fa-sticky-note"></i> Berita Acara</a>
                                                    <a class="dropdown-item" href="{{ route('seminar.cetakPeng', encrypt($seminar->id))}}" target="_blank"><i class="fas fa-sticky-note"></i> Form Penguji</a>
                                                    <a class="dropdown-item" href="{{ route('seminar.cetakSurat', encrypt($seminar->id))}}" target="_blank"><i class="fas fa-envelope"></i> Surat Tugas</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <th scope="col">{{ $seminars->firstItem() + $loop->index }}</th>
                                    <td>{{ strip_tags($seminar->judul_skripsi) }}</td>
                                    <td>{{ $seminar->batch->nama }} {{ $seminar->batch->tahun }}</td>
                                    <td>
                                        @if ($seminar->status_pembayaran == 'SDH')
                                            <button class="btn btn-sm btn-success">{{ $seminar->va }}</button>
                                        @else
                                            <button class="btn btn-sm btn-danger">{{ $seminar->va }}</button>
                                        @endif
                                    </td>
                                    <td>{{ number_format($seminar->nominal, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($seminar->tanggal_seminar)
                                            {{ \App\Helpers\IndoTanggal::tanggal($seminar->tanggal_seminar, false) }} {{ $seminar->jam_mulai }} - {{ $seminar->jam_selesai }} {{ $seminar->ruang }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($seminar->status == 0)
                                            <button class="btn btn-sm btn-primary">BRU</button>
                                        @elseif ($seminar->status == 5)
                                            <button class="btn btn-sm btn-success">SLS</button>
                                        @else
                                            <button class="btn btn-sm btn-warning">PRS</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br/>
                        <br/>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection