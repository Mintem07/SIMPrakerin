@extends('pembimbing.index')
@section('contentPembimbing')

<!-- header -->
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<!-- end header -->

<div class="page-heading">
    <h3>Daftar Absensi Mingguan Siswa</h3>
</div>

<div class="page-content">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Monitoring</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="tableMonitoring">
                <thead class="table-info">
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Heri Maguire</td>
                        <td>12-03-2025</td>
                        <td>Hadir</td>
                        <td>
                            <button type="button" class="btn icon btn-primary" data-bs-toggle="modal"
                                data-bs-target="#detailMonitoring">
                                <i class="bi bi-info-circle"></i>
                            </button>
                            <button type="button" class="btn btn-success" onclick="feedback()">Catatan</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailMonitoring" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailMonitoringLabel">Detail Pengajuan</h5>
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