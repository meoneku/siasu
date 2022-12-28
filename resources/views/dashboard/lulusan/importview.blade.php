@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Import Data Lulusan</h5>
            </div>
            <div class="card-body">
                <form action="{{ url('/webmin/lulusan/import') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <input type="hidden" name="file" value="{{ $file }}">
                        <input type="file" name="file" class="form-control rounded-0" disabled>
                        <button type="button" class="btn btn-warning btn-flat" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-arrow-right"></i> Import</button>
                    </div>
                </form>
                <div class="alert alert-success mt-2" role="alert">
                    <li>Untuk template File Excel Dapat di Unduh <a href="{{ url('webmin/lulusan/template') }}" targer="_blank">Di Sini</a></li>
                    <li>Saat menggunakan Import, Untuk data Foto tidak dapat di proses, dapat diedit Manual</li>
                </div>
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Jurusan/Prodi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < $CountRows; $i++)
                            <tr>
                                <td>{{ $rows[$i]['no'] }}</td>
                                <td>{{ $rows[$i]['nim'] }}</td>
                                <td>{{ $rows[$i]['nama'] }}</td>
                                <td>{{ tanggal_indonesia(date('Y-m-d', ($rows[$i]['tanggal_lahir'] - 25569) * 86400), false) }}</td>
                                <td>{{ $jurusan->where('id', $rows[$i]['jurusan'])->first()->jurusan }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
                <div class="card-footer d-flex justify-content-end">

                </div>
            </div>
        </div>
    </div>
@endsection
