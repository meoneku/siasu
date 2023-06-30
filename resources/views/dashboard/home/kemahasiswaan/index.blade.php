@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Homepage | Kemahsiswaan</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('kemahasiswaan.index') }}">
                    <div class="input-group">
                        <input type="text" name="judul" class="form-control rounded-0 w-25" placeholder="Semua" value="{{ request('judul') }}">
                        <button class="btn btn-danger btn-flat" type="submit"><i class="fas fa-search"></i></button>
                        <a href="{{ route('kemahasiswaan.index') }}" class="btn btn-info btn-flat"><i class="fas fa-circle-notch"></i></a>
                        <a href="{{ route('kemahasiswaan.create') }}" class="btn btn-primary btn-flat"><i class="fas fa-plus"></i></a>
                    </div>
                </form>
                <div class="row mt-4">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Teks</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kemahasiswaan as $data)
                                <tr>
                                    <td>{{ $kemahasiswaan->firstItem() + $loop->index }}</td>
                                    <td>{{ $data->judul }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit(strip_tags($data->body), 40, '...') }}</td>
                                    <td><a href="{{ route('kemahasiswaan.edit', $data->slug) }}" class="badge bg-info me-1"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('kemahasiswaan.destroy', $data->slug) }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                            <button class="badge bg-danger border-0 button-delete" data-message="Tentang kemahasiswaan {{ $data->judul }}"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                    {{ $kemahasiswaan->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
