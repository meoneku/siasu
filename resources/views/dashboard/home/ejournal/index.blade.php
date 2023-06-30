@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="row align-items-end">
                    <div class="col">
                        <h5 class="card-title m-0">Homepage | Link EJournal</h5>
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('ejournal.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>URL</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($journal as $data)
                            <tr>
                                <td>{{ $journal->firstItem() + $loop->index }}</td>
                                <td>{{ $data->nm_menu }}</td>
                                <td><a href="{{ $data->link }}" target="_blank">{{ $data->link }}</a></td>
                                <td><a href="{{ route('ejournal.edit', $data->id) }}" class="badge bg-info me-1"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('ejournal.destroy', $data->id) }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                        <button class="badge bg-danger border-0 button-delete" data-message="Link EJournal {{ $data->nm_menu }}"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-end">
                {{ $journal->links() }}
            </div>
        </div>
    </div>
@endsection
