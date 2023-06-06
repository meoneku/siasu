@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">Data Master | Inventaris</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ route('inventaris.update', $inven->id) }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <input type="hidden" id="num_inv" name="num_inv" value="{{ $inven->no_inventaris }}">
                    <input type="hidden" id="tahun" name="tahun" value="{{ substr($inven->tanggal_pembelian, 0, 4) }}">
                    <input type="hidden" name="redirect_to" value="{!! URL::previous() !!}">
                    <div class="form-group row">
                        <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" placeholder="Nama Barang" value="{{ old('nama_barang', $inven->nama_barang) }}" maxlength="128" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="penempatan" class="col-sm-2 col-form-label">Penempatan</label>
                        <div class="col-sm-4">
                            <select id="penempatan" name="penempatan" class="form-control" required>
                                <option value="">Pilih Salah Satu</option>
                                @foreach ($penempatan as $data)
                                    @if ($data == $inven->penempatan)
                                        <option value="{{ $data }}" selected>{{ $data }}</option>
                                    @else
                                        <option value="{{ $data }}">{{ $data }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="asal_barang" class="col-sm-2 col-form-label">Asal Barang</label>
                        <div class="col-sm-6">
                            <select id="asal_barang" name="asal_barang" class="form-control" required>
                                <option value="">Pilih Salah Satu</option>
                                @foreach ($asal as $data)
                                    @if ($data == $inven->asal_barang)
                                        <option value="{{ $data }}" selected>{{ $data }}</option>
                                    @else
                                        <option value="{{ $data }}">{{ $data }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenis_inventaris" class="col-sm-2 col-form-label">Jenis Inventaris</label>
                        <div class="col-sm-6">
                            <select id="jenis_inventaris" name="jenis_inventaris_id" class="form-control" required>
                                <option value="">Pilih Salah Satu</option>
                                @foreach ($jenis as $data)
                                    @if ($data->id == $inven->jenis_inventaris_id)
                                        <option value="{{ $data->id }}" selected>{{ $data->nama }}</option>
                                    @else
                                        <option value="{{ $data->id }}">{{ $data->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_pembelian" class="col-sm-2 col-form-label">Tanggal Pembelian</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control @error('tanggal_pembelian') is-invalid @enderror" id="tanggal_pembelian" name="tanggal_pembelian" placeholder="Tanggal Pembelian" value="{{ old('tanggal_pembelian', $inven->tanggal_pembelian) }}" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_barang" class="col-sm-2 col-form-label">Harga Barang</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control @error('harga_barang') is-invalid @enderror" id="harga_barang" name="harga_barang" placeholder="Harga Barang" value="{{ old('harga_barang', number_format($inven->harga_barang, 0, ',', '.')) }}" maxlength="20">
                            <span class="text-xs text-danger">Kosongkan Bila Tidak Mengetahui Harga</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_inventaris" class="col-sm-2 col-form-label">No Inventaris</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control @error('no_inventaris') is-invalid @enderror" id="no_inventaris" name="no_inventaris" placeholder="Nomor Inventaris" value="{{ old('no_inventaris', $inven->no_inventaris) }}" maxlength="128" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kondisi" class="col-sm-2 col-form-label">Kondisi</label>
                        <div class="col-sm-6">
                            <select id="kondisi" name="kondisi" class="form-control" required>
                                <option value="">Pilih Salah Satu</option>
                                @foreach ($kondisi as $data)
                                    @if ($data == $inven->kondisi)
                                        <option value="{{ $data }}" selected>{{ $data }}</option>
                                    @else
                                        <option value="{{ $data }}">{{ $data }}</option>
                                    @endif
                                @endforeach
                            </select>
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
@section('addjs')
    <script>
        $("#harga_barang").on({
            keyup: function() {
                formatCurrency($(this))
            },
            blur: function() {
                formatCurrency($(this), "blur")
            }
        })

        function formatNumber(n) {
            return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        }

        function formatCurrency(input, blur) {
            var input_val = input.val()

            if (input_val === "") {
                return
            }

            var original_len = input_val.length

            var caret_pos = input.prop("selectionStart")

            if (input_val.indexOf(",") >= 0) {
                var decimal_pos = input_val.indexOf(",")

                var left_side = input_val.substring(0, decimal_pos)
                var right_side = input_val.substring(decimal_pos)

                left_side = formatNumber(left_side)

                right_side = formatNumber(right_side)

                if (blur === "blur") {
                    right_side += "00"
                }

                right_side = right_side.substring(0, 2)

                input_val = left_side + "," + right_side

            } else {
                input_val = formatNumber(input_val)
                input_val = input_val

                if (blur === "blur") {
                    input_val += ""
                }
            }

            input.val(input_val)

            var updated_len = input_val.length
            caret_pos = updated_len - original_len + caret_pos
            input[0].setSelectionRange(caret_pos, caret_pos)
        }

        const Jenis = document.getElementById("jenis_inventaris")
        const Tanggal = document.getElementById("tanggal_pembelian")
        const Asal = document.getElementById("asal_barang")
        const num_inv = document.getElementById("num_inv")
        const tahun = document.getElementById("tahun")

        $(".form-control").on("change", function() {
            if (Jenis.value != "" && Tanggal.value != "" && Asal.value != '') {
                $.post("{{ route('getNoInventaris.api') }}", {
                        jenis: Jenis.value,
                        tanggal: Tanggal.value,
                        asal: Asal.value,
                        num_inv: num_inv.value,
                        tahun: tahun.value
                    },
                    function(data, status) {
                        document.getElementById("no_inventaris").value = data
                    })
            }
        })
    </script>
@endsection
