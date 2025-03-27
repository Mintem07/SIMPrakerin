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
                    @foreach($absensiData as $data)
                    <tr>
                        <td>{{ $data->siswa->nama_siswa }}</td>
                        <td>{{ $data->tanggal }}</td>
                        <td>{{ $data->keterangan }}</td>
                        <td>
                            <button type="button" class="btn icon btn-primary" data-bs-toggle="modal"
                                data-bs-target="#detailAbsensiModal{{ $data->id }}">
                                <i class="bi bi-info-circle"></i>
                            </button>
                            <button type="button" class="btn btn-success" onclick="feedback()">Catatan</button>
                        </td>
                    </tr>
                    @endforeach
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

<!-- Modal Detail Absensi -->
@foreach($absensiData as $data)
<div class="modal fade" id="detailAbsensiModal{{ $data->id }}" tabindex="-1"
    aria-labelledby="detailAbsensiModalLabel{{ $data->id }}" aria-hidden="true">
    <div class="modal-lg modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailAbsensiModalLabel{{ $data->id }}">Detail Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row">
                <div class="col-lg-5 col-12">
                    @if($data->foto_kegiatan)
                    <div style="width: 320px; height: 320px; overflow: hidden; display: flex; justify-content: center; align-items: center; border: 1px solid #ddd;">
                        <img src="{{ asset('storage/' . $data->foto_kegiatan) }}" alt="Bukti Absensi" class="img-fluid">
                    </div>
                    @else
                    <p><strong>Foto Kegiatan:</strong> Tidak ada</p>
                    @endif
                </div>
                <div class="col-lg-7 col-12">
                    <h6>Nama</h6>
                    <p class="text-secondary">{{ $data->siswa->nama_siswa }}</p>
                    <h6>Tanggal</h6>
                    <p class="text-secondary">{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</p>
                    <h6>Keterangan</h6>
                    <p class="text-secondary">{{ $data->keterangan }}</p>
                    <h6>Kegiatan</h6>
                    <p class="text-secondary">{{ $data->kegiatan }}</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection