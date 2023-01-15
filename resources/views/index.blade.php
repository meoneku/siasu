@extends('template')
@section('main')
    <div class="row">
        <div class="col-3">
            <div class="card p-2" data-tilt>
                <a href="#"><img src="img/svg/business-man-employee-general-svgrepo-com.svg" class="card-img-top" alt="SIP!" height="150px" width="150px" /></a>
                <div class="card-body text-center">
                    <p class="h6">Pendaftaran Magang</p>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card p-2" data-tilt>
                <a href="{{ url('/skripsi') }}"><img src="img/svg/document-general-letter-3-svgrepo-com.svg" class="card-img-top" alt="SIP!" height="150px" width="150px" /></a>
                <div class="card-body text-center">
                    <p class="h6">Pendaftaran Skripsi</p>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card p-2" data-tilt>
                <a href="#"><img src="img/svg/document-general-letter-svgrepo-com.svg" class="card-img-top" alt="SIP!" height="150px" width="150px" /></a>
                <div class="card-body text-center">
                    <p class="h6">Pendaftaran Seminar</p>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card p-2" data-tilt>
                <a href="#"><img src="img/svg/document-general-letter-2-svgrepo-com.svg" class="card-img-top" alt="SIP!" height="150px" width="150px" /></a>
                <div class="card-body text-center">
                    <p class="h6">Pendaftaran Seminar Hasil</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Surat -->
    <div class="row mt-3">
        <div class="col-3">
            <div class="card p-2" data-tilt>
                <a href="#"><img src="img/svg/brochure-document-menu-svgrepo-com.svg" class="card-img-top" alt="SIP!" height="150px" width="150px" /></a>
                <div class="card-body text-center">
                    <p class="h6">Surat Izin Magang</p>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card p-2" data-tilt>
                <a href="#"><img src="img/svg/bag-briefcase-business-bag-svgrepo-com.svg" class="card-img-top" alt="SIP!" height="150px" width="150px" /></a>
                <div class="card-body text-center">
                    <p class="h6">Surat Izin Penelitian</p>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card p-2" data-tilt>
                <a href="#"><img src="img/svg/folder-office-organize-svgrepo-com.svg" class="card-img-top" alt="SIP!" height="150px" width="150px" /></a>
                <div class="card-body text-center">
                    <p class="h6">Surat Keterangan Mahasiswa</p>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card p-2" data-tilt>
                <a href="#"><img src="img/svg/page-general-document-svgrepo-com.svg" class="card-img-top" alt="SIP!" height="150px" width="150px" /></a>
                <div class="card-body text-center">
                    <p class="h6">Yudisium</p>
                </div>
            </div>
        </div>
    </div>
@endsection
