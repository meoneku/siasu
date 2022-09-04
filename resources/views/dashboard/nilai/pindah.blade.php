@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Import Data Nilai Pindahan</h5>
            </div>
            <div class="card-body">
                <form action="{{ url('/webmin/nilai/pindah') }}" method="post" id="import-form" onsubmit="showBar()" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <input type="file" name="file" class="form-control rounded-0" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                        <select name="semester" class="form-control">
                            @for ($tahun = date('Y'); $tahun >= env('SEMESTER_YEAR_BEGIN'); $tahun -= 1)
                                @for ($angka = 2; $angka >= 1; $angka -= 1)
                                    @if ($tahun . $angka == date('Y') . '1')
                                        <option value="{{ $tahun . $angka }}" selected>{{ App\Http\Controllers\NilaiController::ConvertSemester($tahun . $angka) }}</option>
                                    @else
                                        <option value="{{ $tahun . $angka }}">{{ App\Http\Controllers\NilaiController::ConvertSemester($tahun . $angka) }}</option>
                                    @endif
                                @endfor
                            @endfor
                        </select>
                        <button type="button" class="btn btn-warning btn-flat" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-arrow-right"></i> Import</button>
                    </div>
                </form>
                <div class="progress mt-3 mb-5" id="bar" style="display:none">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                </div>
                <br />
                <div class="alert alert-info" role="alert">
                    Import Nilai Pindahan Hanya Bisa Di Gunakan Di Format Export Nilai Pindahan Dari Feeder
                </div>
            </div>
        </div>
    </div>
    <script>
        function showBar() {
            const bar = document.querySelector("#bar");
            bar.style.display = null;
        }
    </script>
@endsection
