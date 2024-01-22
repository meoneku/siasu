@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Import Data VA</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('va.import.post') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <input type="file" name="file" class="form-control rounded-0" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                        <button type="button" class="btn btn-warning btn-flat" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-arrow-right"></i> Import</button>
                    </div>
                </form>
                <div class="alert alert-success mt-2" role="alert">
                    <li>Untuk template File Excel Dapat di Unduh <a href="{{ url('webmin/va/template') }}" targer="_blank">Di Sini</a></li>
                </div>
                <div class="card-footer d-flex justify-content-end">

                </div>
            </div>
        </div>
    </div>
@endsection
