@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="row align-items-end">
                    <div class="col">
                        <h5 class="card-title m-0">Homepage | Kerjasama</h5>
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('kerjasama.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Instansi</th>
                            <th>Logo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kerjasama as $data)
                            <tr>
                                <td>{{ $kerjasama->firstItem() + $loop->index }}</td>
                                <td>{{ $data->nm_instansi }}</td>
                                <td><img src="{{ url('uploads') . '/' . $data->logo }}" alt="..." width="120" height="auto" /></td>
                                <td><a href="{{ route('kerjasama.edit', $data->id) }}" class="badge bg-info me-1"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('kerjasama.destroy', $data->id) }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                        <button class="badge bg-danger border-0 button-delete" data-message="Kerjsama {{ $data->nm_instansi }}"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-end">
                {{ $kerjasama->links() }}
            </div>
        </div>
    </div>
@endsection
