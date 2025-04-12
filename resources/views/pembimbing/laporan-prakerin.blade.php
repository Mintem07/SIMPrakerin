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
    <h3>Laporan Akhir Prakerin</h3>
</div>

<div class="page-content">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Daftar Laporan</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-lg" id="tableLaporan">
                    <thead>
                        <tr>
                            <th>Kelompok</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporan as $data)
                        <tr>
                            <td>{{ $data->kelompok->nama_kelompok }}</td>
                            <td>{{ $data->tanggal_upload ? $data->tanggal_upload->format('d-m-Y') : '-' }}</td>
                            <td>
                                <a href="{{ asset('storage/' . $data->file_laporan_akhir) }}" target="_blank"
                                    class="btn btn-sm btn-primary">Lihat Laporan</a>
                                <a href="{{ asset('storage/' . $data->file_laporan_akhir) }}" download
                                    class="btn btn-sm btn-success ml-2">Download</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Siswa belum mengunggah laporan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
let tableLaporan = document.querySelector('#tableLaporan');
let dataTableLaporan = new simpleDatatables.DataTable(tableLaporan);
</script>
@endsection