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
                <h5 class="card-title m-0">Data Pemohon Surat PI/KP</h5>
            </div>

            <div class="card-body">
                <form action="/webmin/suratpi">
                    <div class="input-group">
                        <input type="text" name="tempat" class="form-control rounded-0 w-25" placeholder="Semua Tempat" value="{{ request('tempat') }}">
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
                        <button class="btn btn-danger btn-flat" type="submit"><i class="fas fa-search"></i></button>
                        <a href="/webmin/suratpi" class="btn btn-info btn-flat"><i class="fas fa-circle-notch"></i></a>
                        <a href="/webmin/suratpi/create" class="btn btn-primary btn-flat"><i class="fas fa-plus"></i></a>
                    </div>
                </form>
                <div class="row mt-4">
                    <table class="table table-hover responsive">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tempat/Lokasi</th>
                                <th>Jurusan</th>
                                <th>Tanggal Daftar</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratpi as $data)
                                <tr>
                                    <td>{{ $suratpi->firstItem() + $loop->index }}</td>
                                    <td>{{ $data->tempat }}</td>
                                    <td>{{ $data->jurusan->jenjang }} {{ $data->jurusan->jurusan }}</td>
                                    <td>{{ tanggal_indonesia($data->created_at) }}</td>
                                    <td>{!! App\Helpers\Codes::getStatusSuratPI($data->status) !!}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info btn-xs">#</button>
                                            <button type="button" class="btn btn-info btn-xs dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu">
                                                <a class="dropdown-item" href="/webmin/suratpi/{{ $data->id }}/edit"><i class="fas fa-edit"></i> Edit / Lihat</a>
                                                @if ($data->status == 0)
                                                    <form action="/webmin/suratpi/surat/{{ $data->id }}" method="post" class="d-inline">
                                                        @method('put')
                                                        @csrf
                                                        <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                                        <button class="btn-link button-change dropdown-item" data-message="Pastikan Mahasiswa Yang PI/KP di {{ $data->tempat }} Sudah Melakukan Pembayaran"><i class="fas fa-file-pdf"></i> Terbitkan Surat</button>
                                                    </form>
                                                @else
                                                    <a class="dropdown-item" href="/webmin/suratpi/surat/{{ $data->id }}" target="_blank"><i class="fas fa-file-pdf"></i> Cetak Surat</a>
                                                @endif
                                                @if (Auth::guard('admin')->user()->role == 'root')
                                                    <div class="dropdown-divider"></div>
                                                    <form action="/webmin/suratpi/{{ $data->id }}" method="post" class="d-inline">
                                                        @method('delete')
                                                        @csrf
                                                        <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                                        <button class="btn-link button-delete dropdown-item" data-message="Data Pemohon {{ $data->tempat }}"><i class="fas fa-trash"></i> Hapus</button>
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
                    {{ $suratpi->links() }}
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
                confirmButtonText: 'Lanjutken!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    </script>
@endsection
