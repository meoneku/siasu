@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Homepage | Berita</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('berita.index') }}">
                    <div class="input-group">
                        <input type="text" name="judul" class="form-control rounded-0 w-25" placeholder="Semua Berita" value="{{ request('judul') }}">
                        <select name="kategori" class="form-control w-25">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategoris as $kategori)
                                @if (request('kategori') == $kategori->slug)
                                    <option value="{{ $kategori->slug }}" selected>{{ $kategori->name }}</option>
                                @else
                                    <option value="{{ $kategori->slug }}">{{ $kategori->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <button class="btn btn-danger btn-flat" type="submit"><i class="fas fa-search"></i></button>
                        <a href="{{ route('berita.index') }}" class="btn btn-info btn-flat"><i class="fas fa-circle-notch"></i></a>
                        <a href="{{ route('berita.create') }}" class="btn btn-primary btn-flat"><i class="fas fa-plus"></i></a>
                    </div>
                </form>
                <div class="row mt-4">
                    @foreach ($beritas as $berita)
                        <div class="col-md-4">
                            <div class="card">
                                <div class="position-relative">
                                    <img src="{{ url('uploads') . '/' . $berita->gambar }}" class="card-img-top" alt="Berita">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><strong>{{ \Illuminate\Support\Str::limit($berita->judul, 30, '...') }}</strong></h5><br />
                                    <h5 class="card-title text-muted text-xs"><i class="far fa-clock"></i> {{ \App\Helpers\IndoTanggal::tanggal($berita->publish_at, false) }} in {{ $berita->kategori->name }} by {{ $berita->penulis }}</h5>
                                    <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($berita->body), 120, '...') }}</p>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('berita.edit', $berita->slug) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>&nbsp;
                                        <form action="{{ route('berita.destroy', $berita->slug) }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                            <button class="btn btn-danger button-delete" data-message="Berita Dengan Judul {{ $berita->judul }}"><i class="fas fa-trash"></i> Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer d-flex justify-content-end">
                    {{ $beritas->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
