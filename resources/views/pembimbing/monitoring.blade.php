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
    <h3>Monitoring Siswa</h3>
</div>

<div class="page-content">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Belum dipantau</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-lg" id="tableMonitoring">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notYet as $data)
                        <tr>
                            <td>{{ $data->siswa->nama_siswa }}</td>
                            <td>{{ $data->tanggal }}</td>
                            <td>{{ $data->keterangan }}</td>
                            <td>
                                <button type="button" class="btn icon btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#detailAbsensiModal{{ $data->id }}">
                                    <i class="bi bi-info-circle"></i>
                                </button>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#catatanModal{{ $data->id }}">
                                    Catatan
                                </button>

                                <!-- Modal Detail Absensi -->
                                <div class="modal fade" id="detailAbsensiModal{{ $data->id }}" tabindex="-1"
                                    aria-labelledby="detailAbsensiModalLabel{{ $data->id }}" aria-hidden="true">
                                    <div class="modal-lg modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailAbsensiModalLabel{{ $data->id }}">
                                                    Detail Absensi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body row">
                                                <div class="col-lg-5 col-12">
                                                    @if($data->foto_kegiatan)
                                                    <div
                                                        style="width: 320px; height: 320px; overflow: hidden; display: flex; justify-content: center; align-items: center; border: 1px solid #ddd;">
                                                        <img src="{{ asset('storage/' . $data->foto_kegiatan) }}"
                                                            alt="Bukti Absensi" class="img-fluid">
                                                    </div>
                                                    @else
                                                    <p><strong>Foto Kegiatan:</strong> Tidak ada</p>
                                                    @endif
                                                </div>
                                                <div class="col-lg-7 col-12">
                                                    <h6>Nama</h6>
                                                    <p class="text-secondary">{{ $data->siswa->nama_siswa }}</p>
                                                    <h6>Tanggal</h6>
                                                    <p class="text-secondary">
                                                        {{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</p>
                                                    <h6>Keterangan</h6>
                                                    <p class="text-secondary">{{ $data->keterangan }}</p>
                                                    <h6>Kegiatan</h6>
                                                    <p class="text-secondary">{{ $data->kegiatan }}</p>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#catatanModal{{ $data->id }}">Catatan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Catatan -->
                                <div class="modal fade" id="catatanModal{{ $data->id }}" tabindex="-1"
                                    aria-labelledby="catatanModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('pembimbing.add-catatan' )}}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="catatanModalLabel">Tambah Catatan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Input hidden untuk menyimpan ID -->
                                                    <input type="hidden" name="absensi_id" value="{{ $data->id }}">

                                                    <!-- Input text untuk catatan -->
                                                    <div class="mb-3">
                                                        <label for="catatan" class="form-label">Catatan
                                                            Pembimbing</label>
                                                        <textarea class="form-control" id="catatan" name="catatan"
                                                            rows="3" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Tidak ada siswa yang perlu dimonitor.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Sudah terpantau</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-lg" id="tableTerMonitoring">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($monitoring as $data)
                        <tr>
                            <td style="width: 20%;">{{ $data->siswa->nama_siswa ?? '-' }}</td>
                            <td style="width: 15%;">{{ $data->tanggal }}</td>
                            <td>{{ $data->catatanPembimbing->catatan ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">Belum ada siswa yang terpantau.</td>
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
let tableMonitoring = document.querySelector('#tableMonitoring');
let tableTerMonitoring = document.querySelector('#tableTerMonitoring');
let dataTableMonitoring = new simpleDatatables.DataTable(tableMonitoring);
let dataTableTerMonitoring = new simpleDatatables.DataTable(tableTerMonitoring);
</script>
@endsection