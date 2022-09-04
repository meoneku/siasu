@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <div class="row align-items-end">
                    <div class="col">
                        <h5 class="card-title m-0">Daftar Kata Replacemesnt For Transkrip</h5>
                    </div>
                    <div class="col">
                        <div class="d-flex justify-content-end">
                            <a href="kata/create" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kata Cari</th>
                            <th>Kata Ganti</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kata2 as $kata)
                            <tr>
                                <td>{{ $kata2->firstItem() + $loop->index }}</td>
                                <td>{{ $kata->kata_cari }}</td>
                                <td>{{ $kata->kata_ganti }}</td>
                                <td><a href="/webmin/kata/{{ $kata->id }}/edit" class="badge bg-info me-1"><i class="fas fa-edit"></i></a>
                                    <form action="/webmin/kata/{{ $kata->id }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <input type="hidden" name="redirect_to" value="{!! URL::full() !!}">
                                        <button class="badge bg-danger border-0 button-delete" data-message="Kata Ganti {{ $kata->kata_ganti }}"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-end">
                {{ $kata2->links() }}
            </div>
        </div>
    </div>
@endsection
