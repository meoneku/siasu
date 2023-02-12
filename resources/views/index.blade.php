@extends('template')
@section('main')
    <div class="row">
        <div class="mt-2 mb-2">
            <h5>Permohonan Surat</h5>
        </div>
        <div class="col-6 col-md-3 mb-1">
            <div class="card p-2 h-100" data-tilt>
                <a href="/suratpi"><img src="img/svg/brochure-document-menu-svgrepo-com.svg" class="card-img-top" alt="SIP!" height="96px" width="96px" /></a>
                <div class="card-body text-center">
                    <span class="fw-bold fs-6">Surat Izin PI / KP</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-1">
            <div class="card p-2 h-100" data-tilt>
                <a href="/suratobservasi"><img src="img/svg/bag-briefcase-business-bag-svgrepo-com.svg" class="card-img-top" alt="SIP!" height="96px" width="96px" /></a>
                <div class="card-body text-center">
                    <span class="fw-bold fs-6">Surat Izin Observasi</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-1">
            <div class="card p-2 h-100" data-tilt>
                <a href="#"><img src="img/svg/undraw_text_files_au1q.svg" class="card-img-top" alt="SIP!" height="96px" width="96px" /></a>
                <div class="card-body text-center">
                    <span class="fw-bold fs-6">Surat Izin Pengambilan Data</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-1">
            <div class="card p-2 h-100" data-tilt>
                <a href="#"><img src="img/svg/folder-office-organize-svgrepo-com.svg" class="card-img-top" alt="SIP!" height="96px" width="96px" /></a>
                <div class="card-body text-center">
                    <span class="fw-bold fs-6">Surat Keterangan Mahasiswa</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-1">
            <div class="card p-2 h-100" data-tilt>
                <a href="/semhas"><img src="img/svg/document-general-letter-2-svgrepo-com.svg" class="card-img-top" alt="SIP!" height="96px" width="96px" /></a>
                <div class="card-body text-center">
                    <span class="fw-bold fs-6">Dispensasi</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Surat -->
    <div class="row mt-2">
        <h5>Pendaftaran Praktik Industri / Kerja Praktek</h5>
        <div class="col-6 col-md-3 mb-1">
            <div class="card p-2 h-100" data-tilt>
                <a href="{{ url('/kppi') }}"><img src="img/svg/business-man-employee-general-svgrepo-com.svg" class="card-img-top" alt="SIP!" height="96px" width="96px" /></a>
                <div class="card-body text-center">
                    <span class="fw-bold fs-6">Pendaftaran PI / KP</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Pendaftaran Skripsi -->
    <div class="row mt-2">
        <div class="mt-2 mb-2">
            <h5>Pendaftaran Skripsi</h5>
        </div>
        <div class="col-6 col-md-3 mb-1">
            <div class="card p-2 h-100" data-tilt>
                <a href="{{ url('/skripsi') }}"><img src="img/svg/document-general-letter-3-svgrepo-com.svg" class="card-img-top" alt="SIP!" height="96px" width="96px" /></a>
                <div class="card-body text-center">
                    <span class="fw-bold fs-6">Judul</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-1">
            <div class="card p-2 h-100" data-tilt>
                <a href="{{ url('/seminar') }}"><img src="img/svg/document-general-letter-svgrepo-com.svg" class="card-img-top" alt="SIP!" height="96px" width="96px" /></a>
                <div class="card-body text-center">
                    <span class="fw-bold fs-6">Seminar Proposal</span>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-1">
            <div class="card p-2 h-100" data-tilt>
                <a href="/semhas"><img src="img/svg/document-general-letter-2-svgrepo-com.svg" class="card-img-top" alt="SIP!" height="96px" width="96px" /></a>
                <div class="card-body text-center">
                    <span class="fw-bold fs-6">Seminar Hasil</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="mt-2 mb-2">
            <h5>Yudisium</h5>
        </div>
        <div class="col-6 col-md-3 mb-1">
            <div class="card p-2 h-100" data-tilt>
                <a href="#"><img src="img/svg/page-general-document-svgrepo-com.svg" class="card-img-top" alt="SIP!" height="96px" width="96px" /></a>
                <div class="card-body text-center">
                    <span class="fw-bold fs-6">Pendaftaran Yudisium</span>
                </div>
            </div>
        </div>
    </div>
@endsection
