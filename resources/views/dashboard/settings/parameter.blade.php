@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Params</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/parameter') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="tahunlulus" class="col-sm-3 col-form-label">Tahun Kelulusan Di Mulai</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" id="tahunlulus" name="tahunlulus" value="{{ env('GRADUATION_YEAR_BEGIN') }}" maxlength="4" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="semester" class="col-sm-3 col-form-label">Tahun Semester Di Mulai</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control" id="semester" name="semester" value="{{ env('SEMESTER_YEAR_BEGIN') }}" maxlength="4" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="separator" class="col-sm-3 col-form-label">Separator Cetak Transkrip</label>
                        <div class="row align-items-center col-sm-8">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="separator-true" name="separator" value="active" @if (env('SEPARATOR') == 'active') checked @endif>
                                <label class="form-check-label" for="separator-true">Aktif</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="separator-false" name="separator" value="deactive" @if (env('SEPARATOR') == 'deactive') checked @endif>
                                <label class="form-check-label" for="separator-false">Non Aktif</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
            </div>
            <div class="card-footer">
                *<i>Parameter Configuration
            </div>
        </div>

        </form>
    </div>
@endsection
