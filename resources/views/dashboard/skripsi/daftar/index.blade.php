@extends('dashboard.template')
@section('addcss')
    <style>
        .btn-link {
            border: none;
            outline: none;
            background: none;
            cursor: pointer;
            text-decoration: none;
            font-family: inherit;
            font-size: inherit;
        }
    </style>
@endsection
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Pendaftaran Skripsi</h5>
            </div>

            <div class="card-body">
                <form action="/webmin/skripsi">
                    <div class="input-group">
                        <input type="text" name="nama" class="form-control rounded-0 w-25" placeholder="Semua Nama" value="{{ request('nama') }}">
                        <select name="jurusan" class="form-control w-25">
                            <option value="">Semua Jurusan</option>
                            @foreach ($jurusan as $prodi)
                                @if (request('jurusan') == $prodi->id)
                                    <option value="{{ $prodi->id }}" selected>{{ $prodi->jenjang }} {{ $prodi->jurusan }}</option>
                                @else
                                    <option value="{{ $prodi->id }}">{{ $prodi->jenjang }} {{ $prodi->jurusan }}</option>
                                @endif
                            @endforeach
                        </select>
                        <select name="batch" class="form-control w-25">
                            <option value="">Semua Batch</option>
                            @foreach ($batchs as $batch)
                                @if (request('batch') == $batch->id)
                                    <option value="{{ $batch->id }}" selected>{{ $batch->nama }}</option>
                                @else
                                    <option value="{{ $batch->id }}">{{ $batch->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                        <button class="btn btn-danger btn-flat" type="submit"><i class="fas fa-search"></i></button>
                        <a href="/webmin/skripsi" class="btn btn-info btn-flat"><i class="fas fa-circle-notch"></i></a>
                        <a href="/webmin/skripsi/create" class="btn btn-primary btn-flat"><i class="fas fa-plus"></i></a>
                    </div>
                </form>
                <div class="row mt-4">
                    <table class="table table-hover responsive">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Tanggal Daftar</th>
                                <th>Batch</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($skripsi as $data)
                                <tr>
                                    <td>{{ $skripsi->firstItem() + $loop->index }}</td>
                                    <td>{{ $data->mahasiswa->nama }}</td>
                                    <td>{{ $data->mahasiswa->jurusan->jenjang }} {{ $data->mahasiswa->jurusan->jurusan }}</td>
                                    <td>{{ tanggal_indonesia($data->created_at) }}</td>
                                    <td>{{ $data->batch->nama }}</td>
                                    <td>{!! App\Http\Controllers\SkripsiController::getStatusPendaftaran($data->status) !!}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info btn-xs">#</button>
                                            <button type="button" class="btn btn-info btn-xs dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <a class="dropdown-item" href="/webmin/skripsi/{{ $data->id }}/edit"><i class="fas fa-edit"></i> Edit / Lihat</a>
                                                <a class="dropdown-item" href="/webmin/skripsi/{{ $data->id }}/approve"><i class="far fa-check-circle"></i> Status Pendaftar</a>
                                                <a class="dropdown-item" href="/webmin/skripsi/{{ $data->id }}/form" target="_blank"><i class="fas fa-file-pdf"></i> Form Pendaftaran</a>
                                                @if ($data->status == 3 or $data->status == 5)
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="/webmin/skripsi/{{ $data->id }}/setbimbing"><i class="fas fa-user-graduate"></i> Set Dosen Pembimbing</a>
                                                    @if ($data->status == 5)
                                                        <a class="dropdown-item" href="/webmin/skripsi/{{ $data->id }}/formbimbing" target="_blank"><i class="fas fa-sticky-note"></i> Form Pembimbing</a>
                                                        <a class="dropdown-item" href="/webmin/skripsi/{{ $data->id }}/tugas" target="_blank"><i class="fas fa-file-signature"></i> Surat Penugasan</a>
                                                    @endif
                                                @endif
                                                <div class="dropdown-divider"></div>
                                                <form action="/webmin/skripsi/{{ $data->id }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                                    <button class="btn-link button-delete dropdown-item" data-message="Data Pendaftar Skripsi {{ $data->mahasiswa->nama }}"><i class="fas fa-trash"></i> Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    {{ $skripsi->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('addjs')
    <script>
        $('.button-change').on('click', function(e) {
            const form = $(this).closest("form");
            const message = $(this).data("message");
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ?',
                text: "Apakah Anda Yakin " + message + "?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tolak!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });

        $('.button-chundo').on('click', function(e) {
            const form = $(this).closest("form");
            const message = $(this).data("message");
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ?',
                text: "Apakah Anda Yakin " + message + "?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Terima',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    </script>
@endsection
