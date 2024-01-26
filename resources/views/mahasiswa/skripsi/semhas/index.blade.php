@extends('mahasiswa.layout')
@section('main')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Syarat Pendaftaran Seminar Hasil Skripsi</h4>
                    <p>
                        1. Melakukan Pembayaran Seminar Hasil<br />
                        2. Telah Menyerahkan Kopi Berita Acara Seminar Skripsi
                    </p>
                    <hr>
                    <p class="mb-0">
                        <i>* Pastikan semua persyaratan di atas terpenuhi</i><br />
                        <i>* Panduan Pembayaran melalui VA (Virtual Account) <a href="https://drive.google.com/file/d/1ajIAlCY4T6O5v3xaR3wUbYSrttD6eZr_/view" target="_blank">Klik Disini</a></i>
                    </p>
                </div>
                <form action="{{ route('semhas.index') }}">
                    <div class="input-group">
                        <input type="text" name="judul" class="form-control rounded-0 w-25" placeholder="Semua Judul" value="{{ request('judul') }}">
                        <button class="btn btn-danger btn-flat" type="submit"><i class="fas fa-search"></i></button>
                        <a href="{{ route('semhas.index') }}" class="btn btn-info btn-flat"><i class="fas fa-circle-notch"></i></a>
                        <a href="{{ route('semhas.create') }}" class="btn btn-primary btn-flat"><i class="fas fa-plus"></i> Daftar</a>
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
                                @foreach ($semhass as $semhas)
                                    <tr>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info btn-xs">#</button>
                                                <button type="button" class="btn btn-info btn-xs dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <a class="dropdown-item" href="{{ route('semhas.edit', encrypt($semhas->id)) }}"><i class="fas fa-edit"></i> Edit / Lihat</a>
                                                    <a class="dropdown-item" href="{{ route('semhas.cetakForm', encrypt($semhas->id)) }}" target="_blank"><i class="fas fa-file-pdf"></i> Form Pendaftaran</a>
                                                    @if ($semhas->status == 5)
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="{{ route('semhas.cetakBrica', encrypt($semhas->id)) }}" target="_blank"><i class="fas fa-sticky-note"></i> Berita Acara</a>
                                                        <a class="dropdown-item" href="{{ route('semhas.cetakPeng', encrypt($semhas->id)) }}" target="_blank"><i class="fas fa-sticky-note"></i> Form Penguji</a>
                                                        <a class="dropdown-item" href="{{ route('semhas.cetakSurat', encrypt($semhas->id)) }}" target="_blank"><i class="fas fa-envelope"></i> Surat Tugas</a>
                                                    @endif
                                                    <a class="dropdown-item" href="{{ route('semhas.unggah', encrypt($semhas->id)) }}"><i class="fas fa-upload"></i> Unggah Berkas</a>
                                                </div>
                                            </div>
                                        </td>
                                        <th scope="col">{{ $semhass->firstItem() + $loop->index }}</th>
                                        <td>{{ strip_tags($semhas->judul_skripsi) }}</td>
                                        <td>{{ $semhas->batch->nama }} {{ $semhas->batch->tahun }}</td>
                                        <td>
                                            @if ($semhas->status_pembayaran == 'SDH')
                                                <button class="btn btn-sm btn-success">{{ $semhas->va }}</button>
                                            @else
                                                <button class="btn btn-sm btn-danger">{{ $semhas->va }}</button>
                                            @endif
                                        </td>
                                        <td>{{ number_format($semhas->nominal, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($semhas->tanggal_ujian)
                                                {{ \App\Helpers\IndoTanggal::tanggal($semhas->tanggal_ujian, false) }} {{ $semhas->jam_mulai }} - {{ $semhas->jam_selesai }} {{ $semhas->ruang }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($semhas->status == 0)
                                                <button class="btn btn-sm btn-primary">BRU</button>
                                            @elseif ($semhas->status == 5)
                                                <button class="btn btn-sm btn-success">SLS</button>
                                            @else
                                                <button class="btn btn-sm btn-warning">PRS</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br />
                        <br />
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
