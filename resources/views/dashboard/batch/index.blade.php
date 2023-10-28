@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Batch / Gelombang Kegiatan</h5>
            </div>

            <div class="card-body">
                <form action="/webmin/batch">
                    <div class="input-group">
                        <input type="text" name="nama" class="form-control rounded-0 w-25" placeholder="Semua Nama Batch" value="{{ request('nama') }}">
                        <select name="tahun" class="form-control">
                            <option value="">Semua Tahun</option>
                            @for ($tahun = date('Y'); $tahun >= env('GRADUATION_YEAR_BEGIN'); $tahun -= 1)
                                @if ($tahun == request('tahun'))
                                    <option value="{{ $tahun }}" selected>{{ $tahun }}</option>
                                @else
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                @endif
                            @endfor
                        </select>
                        <button class="btn btn-danger btn-flat" type="submit"><i class="fas fa-search"></i></button>
                        <a href="/webmin/batch" class="btn btn-info btn-flat"><i class="fas fa-circle-notch"></i></a>
                        <a href="/webmin/batch/create" class="btn btn-primary btn-flat"><i class="fas fa-plus"></i></a>
                    </div>
                </form>
                <div class="row mt-4">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Batch</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($batchs as $batch)
                                <tr>
                                    <td>{{ $batchs->firstItem() + $loop->index }}</td>
                                    <td>{{ $batch->kegiatan->nama }} {{ $batch->tahun }} {{ $batch->nama }}</td>
                                    <td>{{ \App\Helpers\IndoTanggal::tanggal($batch->mulai) }}</td>
                                    <td>{{ \App\Helpers\IndoTanggal::tanggal($batch->selesai) }}</td>
                                    <td><a href="/webmin/batch/{{ $batch->id }}/edit" class="badge bg-info me-1" title="Edit Data Pengajaran"><i class="fas fa-edit"></i></a>
                                        <form action="/webmin/batch/{{ $batch->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                            <button class="badge bg-danger border-0 button-delete" data-message="Data Batch Kegiatan {{ $batch->nama }}"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    {{ $batchs->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
