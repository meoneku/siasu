@extends('dashboard.template')
@section('addcss')
@endsection
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Inventaris</h5>
            </div>

            <div class="card-body">
                <form action="/webmin/suket">
                    <div class="input-group">
                        <input type="text" name="nama" class="form-control rounded-0 w-25" placeholder="Semua Nama" value="{{ request('nama') }}">
                        <select name="penempatan" class="form-control w-25">
                            <option value="">Semua Penempatan</option>
                            @foreach ($penempatan as $tempat)
                                @if ($tempat == request('penempatan'))
                                    <option value="{{ $tempat }}" selected>{{ $tempat }}</option>
                                @else
                                    <option value="{{ $tempat }}">{{ $tempat }}</option>
                                @endif
                            @endforeach
                        </select>
                        <select name="tahun" class="form-control w-25">
                            <option value="">Semua Tahun</option>
                        </select>
                        <button class="btn btn-danger btn-flat" type="submit"><i class="fas fa-search"></i></button>
                        <a href="/webmin/inventaris" class="btn btn-info btn-flat"><i class="fas fa-circle-notch"></i></a>
                        <a href="/webmin/inventaris/create" class="btn btn-primary btn-flat"><i class="fas fa-plus"></i></a>
                    </div>
                </form>
                <div class="row mt-4">
                    <table class="table table-hover responsive">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
                                <th>Penempatan</th>
                                <th>Kondisi</th>
                                <th>Asal Barang</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventaris as $data)
                                <tr>
                                    <td>{{ $surat->firstItem() + $loop->index }}</td>
                                    <td>{{ $data->nama_barang }}</td>
                                    <td>{{ $data->jenis->nama }}</td>
                                    <td>{{ $data->penempatan }}</td>
                                    <td>{{ $data->kondisi }}</td>
                                    <td>{{ $data->asal_barang }}</td>
                                    <td>{{ $data->harga_barang }}</td>
                                    <td>{{ $data->status }}</td>
                                    <td>
                                        <a href="/webmin/inventaris/{{ $data->id }}/edit" class="badge bg-info me-1"><i class="fas fa-edit"></i></a>
                                        <form action="/webmin/inventaris/{{ $data->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                            <button class="badge bg-danger border-0 button-delete" data-message="Inventaris {{ $data->nama_barang }}"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    {{ $inventaris->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('addjs')
@endsection
