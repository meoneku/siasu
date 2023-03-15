@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Master | Inventaris</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/inventaris') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" placeholder="Nama Barang" value="{{ old('nama_barang') }}" maxlength="128" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="penempatan" class="col-sm-2 col-form-label">Penempatan</label>
                        <div class="col-sm-4">
                            <select id="penempatan" name="penempatan" class="form-control" required>
                                <option value="">Pilih Salah Satu</option>
                                @foreach ($penempatan as $data)
                                    <option value="{{ $data }}">{{ $data }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tahun_beli" class="col-sm-2 col-form-label">Tahun Beli</label>
                        <div class="col-sm-2">
                            <input type="number" class="form-control @error('tahun_beli') is-invalid @enderror" id="tahun_beli" name="tahun_beli" placeholder="Tahun" value="{{ old('tahun_beli') }}" maxlength="4" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="asal_barang" class="col-sm-2 col-form-label">Asal Barang</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control @error('asal_barang') is-invalid @enderror" id="asal_barang" name="asal_barang" placeholder="Asal Barang" value="{{ old('asal_barang') }}" maxlength="128" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_inventaris" class="col-sm-2 col-form-label">Jenis Inventaris</label>
                        <div class="col-sm-6">
                            <select id="jenis_inventaris" name="jenis_inventaris_id" class="form-control" required>
                                <option value="">Pilih Salah Satu</option>
                                @foreach ($jenis as $data)
                                    <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_pembelian" class="col-sm-2 col-form-label">Tanggal Pembelian</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control @error('tanggal_pembelian') is-invalid @enderror" id="tanggal_pembelian" name="tanggal_pembelian" placeholder="Tanggal Pembelian" value="{{ old('tanggal_pembelian') }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_inventaris" class="col-sm-2 col-form-label">No Inventaris</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control @error('no_inventaris') is-invalid @enderror" id="no_inventaris" name="no_inventaris" placeholder="Nomor Inventaris" value="{{ old('no_inventaris') }}" maxlength="128" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-warning" onclick="history.back()"><i class="fa fa-arrow-left"></i> Kembali</button>&nbsp;
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                    </div>
            </div>
            <div class="card-footer">
                *
            </div>
        </div>

        </form>
    </div>
@endsection
