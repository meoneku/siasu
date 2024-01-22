@extends('mahasiswa.layout')
@section('main')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Syarat Pendaftaran Skripsi</h4>
                    <p>
                        1. Telah Melunasi Pembayaran Semester Berjalan<br />
                        2. Menyertakan foto kopi Transkrip Nilai
                    </p>
                    <hr>
                    <p class="mb-0"><i>* Pastikan semua persyaratan di atas terpenuhi</i></p>
                </div>
                <form action="{{ route('judul.index') }}">
                    <div class="input-group">
                        <input type="text" name="judul" class="form-control rounded-0 w-25" placeholder="Semua Judul" value="{{ request('judul') }}">
                        <button class="btn btn-danger btn-flat" type="submit"><i class="fas fa-search"></i></button>
                        <a href="{{ route('judul.index') }}" class="btn btn-info btn-flat"><i class="fas fa-circle-notch"></i></a>
                        <a href="{{ route('judul.create') }}" class="btn btn-primary btn-flat"><i class="fas fa-plus"></i> Daftar</a>
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Tanggal Daftar</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($skripsis as $skripsi)
                                <tr>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info btn-xs">#</button>
                                            <button type="button" class="btn btn-info btn-xs dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <a class="dropdown-item" href="{{ route('judul.edit', $skripsi->id) }}"><i class="fas fa-edit"></i> Edit / Lihat</a>
                                                <a class="dropdown-item" href="/mahasiswa/skripsi/judul/{{ $skripsi->id }}/form" target="_blank"><i class="fas fa-file-pdf"></i> Form Pendaftaran</a>
                                                <div class="dropdown-divider"></div>
                                                @if ($skripsi->status == 5)
                                                    <a class="dropdown-item" href="/mahasiswa/skripsi/judul/{{ $skripsi->id }}/formbimbing" target="_blank"><i class="fas fa-sticky-note"></i> Form Pembimbing</a>
                                                    <a class="dropdown-item" href="/mahasiswa/skripsi/judul/penugasan/{{ $skripsi->id }}" target="_blank"><i class="fas fa-envelope"></i> Cetak Surat Tugas</a>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <th scope="col">{{ $skripsis->firstItem() + $loop->index }}</th>
                                    <td>{{ strip_tags($skripsi->judul_skripsi) }}</td>
                                    <td>{{ $skripsi->batch->nama }} {{ $skripsi->batch->tahun }}</td>
                                    <td>
                                        @if ($skripsi->status == 1)
                                            <button class="btn btn-sm btn-primary">BRU</button>
                                        @elseif ($skripsi->status == 5)
                                            <button class="btn btn-sm btn-success">SLS</button>
                                        @else
                                            <button class="btn btn-sm btn-warning">PRS</button>
                                        @endif
                                    </td>
                                    <td>{{ \App\Helpers\IndoTanggal::tanggal($skripsi->created_at, false) }}</td>
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