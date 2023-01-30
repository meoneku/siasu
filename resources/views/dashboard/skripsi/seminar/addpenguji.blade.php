@extends('dashboard.template')
@section('addcss')
    <link rel="stylesheet" href="{{ url('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Pendaftar Seminar Skripsi | Add Dosen Penguji</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/seminar/penguji') . '/' . $seminar->id }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                    <div class="form-group row">
                        <label for="dosen_id" class="col-sm-2 col-form-label">Nama Dosen</label>
                        <div class="col-sm-8">
                            <select id="dosen_id" name="dosen_id" class="form-control select2" required>
                                @foreach ($dosens as $dosen)
                                    <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-warning" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>&nbsp;
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
@endsection

@section('addjs')
    <script src="{{ url('plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: 'Dosen Pembimbing'
            })
        });
    </script>
@endsection
