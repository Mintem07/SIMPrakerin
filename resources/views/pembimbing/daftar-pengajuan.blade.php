@extends('pembimbing.index')
@section('contentPembimbing')

<!-- konten -->
<div id="main">
    <!-- header -->
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <!-- end header -->

    <div class="page-heading">
        <h3>Daftar Pengajuan Proposal</h3>
    </div>

    <div class="page-content">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Menunggu Persetujuan</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="tableDaftarPengajuan">
                    <thead class="table-info">
                        <tr>
                            <th>Nama Kelompok</th>
                            <th>Industri</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 25%">Kelompok Singa</td>
                            <td style="width: 45%">PT. Abadi Jaya Group</td>
                            <td>
                                <button type="button" class="btn icon btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#detailPengajuan">
                                    <i class="bi bi-info-circle"></i>
                                </button>
                                <button type="button" class="btn btn-success" onclick="approveRequest()">Setujui</button>
                                <button type="button" class="btn btn-danger" onclick="rejectRequest()">Tolak</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Riwayat</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="tableDaftarPengajuan">
                    <thead class="table-secondary">
                        <tr>
                            <th>Nama Kelompok</th>
                            <th>Industri</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 25%">Kelompok Singa</td>
                            <td style="width: 45%">PT. Abadi Jaya Group</td>
                            <td>
                                <span class="badge bg-light-success p-2">Disetujui</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 25%">Kelompok Singa</td>
                            <td style="width: 45%">PT. Abadi Jaya Group</td>
                            <td>
                                <span class="badge bg-light-success p-2">Disetujui</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('footer')
</div>
<!-- end konten -->

<!-- Modal -->
<div class="modal fade" id="detailPengajuan" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Detail data goes here -->
                <p>Nama Kelompok: Kelompok Singa</p>
                <p>Industri: PT. Abadi Jaya Group</p>
                <!-- Add more details as needed -->
            </div>
        </div>
    </div>
</div>
@endsection