@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="row align-items-end">
                    <div class="col">
                        <h5 class="card-title m-0">Data Jurusan</h5>
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-end">
                            <a href="jurusan/create" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jurusan</th>
                            <th>Jenjang</th>
                            <th>Akreditasi</th>
                            <th>Nomor SK Akreditasi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jurusan as $data)
                            <tr>
                                <td>{{ $jurusan->firstItem() + $loop->index }}</td>
                                <td>{{ $data->jurusan }}</td>
                                <td>{{ $data->jenjang }}</td>
                                <td>{{ $data->akreditasi }}</td>
                                <td>{{ $data->nomor_akreditasi }}</td>
                                <td><a href="/webmin/jurusan/{{ $data->id }}/edit" class="badge bg-info me-1"><i class="fas fa-edit"></i></a>
                                    <form action="/webmin/jurusan/{{ $data->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                        <button class="badge bg-danger border-0 button-delete" data-message="Jurusan {{ $data->jurusan }}"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-end">
                {{ $jurusan->links() }}
            </div>
        </div>
    </div>
@endsection
