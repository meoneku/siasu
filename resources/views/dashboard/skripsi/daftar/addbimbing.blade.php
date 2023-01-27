@extends('dashboard.template')
@section('addcss')
<link rel="stylesheet" href="{{ url('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ url('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Pendaftar Skripsi | Add Dosen Pembimbing</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/skripsi/setbimbing') . '/' . $skripsi->id }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                    <div class="form-group row">
                        <label for="dosen_id" class="col-sm-2 col-form-label">Nama Dosen</label>
                        <div class="col-sm-8">
                            <select id="dosen_id" name="dosen_id" class="form-control select2" required>
                                @foreach($dosens as $dosen)
                                    <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pembimbing" class="col-sm-2 col-form-label">Pembimbing</label>
                        <div class="col-sm-4">
                            <select id="pembimbing" name="pembimbing" class="form-control" required>
                                <option value="Utama">Utama</option>
                                <option value="Pendamping">Pendamping</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mulai" class="col-sm-2 col-form-label">Mulai Penugasan</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="mulai" name="mulai" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="selesai" class="col-sm-2 col-form-label">Selesai Penugasan</label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="selesai" name="selesai" required>
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
        $(function () {
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: 'Dosen Pembimbing'
            })
        });
    </script>
@endsection
