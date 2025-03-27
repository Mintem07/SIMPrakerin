@extends('siswa.index')
@section('contentSiswa')

<!-- header -->
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<!-- end header -->

<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <ul class="timeline-with-icons">
                                <li class="timeline-item mb-5">
                                    <span class="timeline-icon">
                                        <i class="bi bi-person-plus-fill"></i>
                                    </span>
                                    <h5 class="fw-bold">Pendaftaran</h5>
                                    <p class="text-muted mb-2 fw-bold">1-10 Juli 2025</p>
                                </li>
                                <li class="timeline-item mb-5">
                                    <span class="timeline-icon">
                                        <i class="bi bi-journal-bookmark-fill"></i>
                                    </span>
                                    <h5 class="fw-bold">Pembekalan</h5>
                                    <p class="text-muted mb-2 fw-bold">11 juli 2025</p>
                                </li>
                                <li class="timeline-item mb-5">
                                    <span class="timeline-icon">
                                        <i class="bi bi-gear-fill"></i>
                                    </span>
                                    <h5 class="fw-bold">Pelaksanaan</h5>
                                    <p class="text-muted mb-2 fw-bold">16 Juni - 2 September</p>
                                </li>
                                <li class="timeline-item mb-5">
                                    <span class="timeline-icon">
                                        <i class="bi bi-file-text-fill"></i>
                                    </span>
                                    <h5 class="fw-bold">Penyelesaian Laporan Akhir</h5>
                                    <p class="text-muted mb-2 fw-bold">3-19 September</p>
                                </li>
                                <li class="timeline-item mb-5">
                                    <span class="timeline-icon">
                                        <i class="bi bi-mic-fill"></i>
                                    </span>
                                    <h5 class="fw-bold">Presentasi</h5>
                                    <p class="text-muted mb-2 fw-bold">20-23 September</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-7">
                    <div class="alert alert-info alert-dismissible show fade">
                        1 Catatan baru dari Pembimbing.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="m-0">Catatan Pembimbing</h4>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="font-bold text-end m-0">Salmna Btyine</p>
                                        <p class="font-muted text-end m-0">Pembimbing</p>
                                    </div>
                                    <div class="avatar avatar-xl ms-3 mb-0">
                                        <img src="assets/images/faces/2.jpg">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Catatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="col-3">
                                                <p class="font-bold mb-0">10 Sep 2025</p>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0">Congratulations on your graduation!</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                <p class="font-bold mb-0">10 Sep 2025</p>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0">Congratulations on your graduation!</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                <p class="font-bold mb-0">10 Sep 2025</p>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0">Congratulations on your graduation!</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection