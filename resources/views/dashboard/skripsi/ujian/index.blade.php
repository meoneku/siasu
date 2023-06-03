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
                <h5 class="card-title m-0">Data Pendaftaran Seminar Hasil</h5>
            </div>

            <div class="card-body">
                <form action="/webmin/semhas">
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
                                    <option value="{{ $batch->id }}" selected>{{ $batch->kegiatan->nama }} {{ $batch->nama }} {{ $batch->tahun }}/option>
                                    @else
                                    <option value="{{ $batch->id }}">{{ $batch->kegiatan->nama }} {{ $batch->nama }} {{ $batch->tahun }}</option>
                                @endif
                            @endforeach
                        </select>
                        <button class="btn btn-danger btn-flat" type="submit"><i class="fas fa-search"></i></button>
                        <a href="/webmin/semhas" class="btn btn-info btn-flat"><i class="fas fa-circle-notch"></i></a>
                        <a href="/webmin/semhas/create" class="btn btn-primary btn-flat"><i class="fas fa-plus"></i></a>
                        <a href="/webmin/semhas/jadwal?jurusan={{ request('jurusan') }}&batch={{ request('batch') }}" class="btn btn-warning btn-flat" target="_blank"><i class="fas fa-clock"></i></a>
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
                            @foreach ($semhas as $data)
                                <tr>
                                    <td>{{ $semhas->firstItem() + $loop->index }}</td>
                                    <td>{{ $data->mahasiswa->nama }}</td>
                                    <td>{{ $data->mahasiswa->jurusan->jenjang }} {{ $data->mahasiswa->jurusan->jurusan }}</td>
                                    <td>{{ tanggal_indonesia($data->created_at) }}</td>
                                    <td>{{ $data->batch->kegiatan->nama }} - {{ $data->batch->nama }} - {{ $data->batch->tahun }}</td>
                                    <td>{!! App\Http\Controllers\SkripsiController::getStatusPendaftaran($data->status) !!}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info btn-xs">#</button>
                                            <button type="button" class="btn btn-info btn-xs dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <a class="dropdown-item" href="/webmin/semhas/{{ $data->id }}/edit"><i class="fas fa-edit"></i> Edit / Lihat</a>
                                                {{-- <a class="dropdown-item" href="/webmin/semhas/status/{{ $data->id }}"><i class="far fa-check-circle"></i> Status</a> --}}
                                                <a class="dropdown-item" href="/webmin/semhas/formulir/{{ $data->id }}" target="_blank"><i class="fas fa-file-pdf"></i> Form Daftar</a>
                                                {{-- @if ($data->status == 3 or $data->status == 5) --}}
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="/webmin/semhas/penguji/{{ $data->id }}"><i class="fas fa-user-graduate"></i> Set Penguji</a>
                                                @if ($data->status == 5)
                                                    <a class="dropdown-item" href="/webmin/semhas/berita/{{ $data->id }}" target="_blank"><i class="fas fa-sticky-note"></i> Berita Acara</a>
                                                    <a class="dropdown-item" href="/webmin/semhas/formuji/{{ $data->id }}" target="_blank"><i class="fas fa-briefcase"></i> Form Penguji</a>
                                                    <a class="dropdown-item" href="/webmin/semhas/penugasan/{{ $data->id }}" target="_blank"><i class="fas fa-file-signature"></i> Surat Penugasan</a>
                                                @endif
                                                {{-- @endif --}}
                                                @if (Auth::guard('admin')->user()->role == 'root')
                                                    <div class="dropdown-divider"></div>
                                                    <form action="/webmin/semhas/{{ $data->id }}" method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                                        <button class="btn-link button-delete dropdown-item" data-message="Data Pendaftar Seminar Hasil {{ $data->mahasiswa->nama }}"><i class="fas fa-trash"></i> Hapus</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    {{ $semhas->links() }}
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
    </script>
@endsection
