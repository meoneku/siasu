@extends('dashboard.template')
@section('main')
    <div class="col-lg-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="card-title m-0">🦊Profil</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="post" action="{{ url('webmin/profil') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control  @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama',auth()->guard('admin')->user()->nama) }}" maxlength="128" required autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control  @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username',auth()->guard('admin')->user()->username) }}" maxlength="128" required autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">E-Mail</label>
                        <div class="col-sm-4">
                            <input type="email" class="form-control  @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email',auth()->guard('admin')->user()->email) }}" maxlength="50" required autofocus>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control  @error('role') is-invalid @enderror" id="role" name="role" value="{{ old('role',auth()->guard('admin')->user()->role) }}" maxlength="20" required autofocus>
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
