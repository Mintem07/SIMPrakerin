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
    <h3>Dashboard Pembimbing</h3>
</div>

<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="iconly-boldProfile"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Siswa Dibimbing</h6>
                                    <h6 class="font-extrabold mb-0">{{ isset($jumlahSiswa) ? $jumlahSiswa : "-" }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldShow"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Absensi Terkirim</h6>
                                    <h6 class="font-extrabold mb-0">{{ isset($jumlahAbsensi) ? $jumlahAbsensi : "-" }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="iconly-boldPaper"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Penilaian Tuntas</h6>
                                    <h6 class="font-extrabold mb-0">
                                        {{ isset($jumlahPenilaian) ? $jumlahPenilaian : "-" }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="iconly-boldDocument"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Laporan Akhir</h6>
                                    <h6 class="font-extrabold mb-0">{{ isset($jumlahLaporan) ? $jumlahLaporan : "-" }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="row">
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Progres Monitoring</h4>
                </div>
                <div class="card-body">
                    <div id="chart-monitoring-progress"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Aktivitas Hari Ini</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-lg">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Aktivitas</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($recentActivity))
                                @foreach($recentActivity as $siswa)
                                <tr class="border-b">
                                    <td class="py-2">{{ $siswa['nama'] }}</td>
                                    <td class="py-2">
                                        @if($siswa['status'] === 'Sudah Absen')
                                        <p class="mb-0">Sudah melakukan absen</p>
                                        @else
                                        <p class="mb-0">Belum melakukan absen</p>
                                        @endif
                                    </td>
                                    <td class="py-2">
                                        @if($siswa['status'] === 'Sudah Absen')
                                        <span class="">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                        </span>
                                        @else
                                        <span class="">
                                            <i class="bi bi-x-circle-fill text-danger"></i>
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-5">
                                        Tidak Ada Aktivitas
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('scripts')
<script>
let optionsMonitoring = {
		series: [{{ $monitored }}, {{ $notYet }}],
		labels: ['Sudah Dimonitoring', 'Belum Dimonitoring'],
		colors: ['#4ade80', '#f87171'],
		chart: {
			type: 'donut',
			width: '100%',
			height: '350px'
		},
		legend: {
			position: 'bottom'
		},
		plotOptions: {
			pie: {
				donut: {
					size: '30%'
				}
			}
		}
	}

	let chartMonitoring = new ApexCharts(document.getElementById('chart-monitoring-progress'), optionsMonitoring)
	chartMonitoring.render()
</script>
@endsection