@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Homepage | Pengumuman</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('pengumuman.index') }}">
                    <div class="input-group">
                        <input type="text" name="judul" class="form-control rounded-0 w-25" placeholder="Semua Pengumuman" value="{{ request('judul') }}">
                        <button class="btn btn-danger btn-flat" type="submit"><i class="fas fa-search"></i></button>
                        <a href="{{ route('pengumuman.index') }}" class="btn btn-info btn-flat"><i class="fas fa-circle-notch"></i></a>
                        <a href="{{ route('pengumuman.create') }}" class="btn btn-primary btn-flat"><i class="fas fa-plus"></i></a>
                    </div>
                </form>
                <div class="row mt-4">
                    @foreach ($pengumumans as $pengumuman)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="position-relative">
                                    <img src="{{ url('uploads') . '/' . $pengumuman->gambar }}" class="card-img-top" alt="Pengumuman">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><strong>{{ \Illuminate\Support\Str::limit($pengumuman->judul, 30, '...') }}</strong></h5><br />
                                    <h5 class="card-title text-muted text-xs"><i class="far fa-clock"></i> {{ tanggal_indonesia($pengumuman->publish_at, false) }}</h5>
                                    <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($pengumuman->body), 120, '...') }}</p>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('pengumuman.edit', $pengumuman->slug) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>&nbsp;
                                        <form action="{{ route('pengumuman.destroy', $pengumuman->slug) }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                            <button class="btn btn-danger button-delete" data-message="Pengumuman Dengan Judul {{ $pengumuman->judul }}"><i class="fas fa-trash"></i> Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer d-flex justify-content-end">
                    {{ $pengumumans->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
