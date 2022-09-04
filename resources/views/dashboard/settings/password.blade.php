@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">🦊Password</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/password') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="old_password" class="col-sm-2 col-form-label">Password Lama</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password" value="{{ old('old_password') }}" maxlength="128" required autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new_password" class="col-sm-2 col-form-label">Password Baru</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" value="{{ old('new_password') }}" maxlength="128" required autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new_password_confirmation" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" id="new_password_confirmation" name="new_password_confirmation" value="{{ old('new_password_confirmation') }}" maxlength="128" required autofocus>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success">🦊</button>
                    </div>
            </div>
            <div class="card-footer">
                *<i>Password Changer
            </div>
        </div>

        </form>
    </div>
@endsection
