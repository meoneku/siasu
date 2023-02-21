@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="row align-items-end">
                    <div class="col">
                        <h5 class="card-title m-0">Data Jenis Inventaris</h5>
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-end">
                            <a href="jenisinven/create" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis Inventaris</th>
                            <th>Kode</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jenis as $data)
                            <tr>
                                <td>{{ $jenis->firstItem() + $loop->index }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->kode }}</td>
                                <td><a href="/webmin/jenisinven/{{ $data->id }}/edit" class="badge bg-info me-1"><i class="fas fa-edit"></i></a>
                                    <form action="/webmin/jenisinven/{{ $data->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                        <button class="badge bg-danger border-0 button-delete" data-message="Jenis Inventaris {{ $data->nama }}"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-end">
                {{ $jenis->links() }}
            </div>
        </div>
    </div>
@endsection
