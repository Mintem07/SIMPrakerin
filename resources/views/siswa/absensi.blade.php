@extends('siswa.index')
@section('contentSiswa')

<!-- header -->
<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>
<!-- end header -->

<div class="page-heading">
    <h3>Absensi</h3>
</div>

<div class="page-content">
    @if(isset($siswaId) && isset($kelompokId) && isset($pembimbingId))
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#absensiModal">
                Absensi
            </button>
        </div>
        <div class="card-body">
            <h4 class="card-title mb-3">Riwayat Absensi</h4>
            @if(count($absensi) === 0)
            <p>Lakukan absen dengan menekan tombol "Absensi" di atas!.</p>
            @else
            <div class="table-responsive">
                <table class="table table-hover table-lg" id="tableAbsensi">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Kegiatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($absensi as $data)
                        <tr>
                            <td style="width: 15%">{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
                            <td style="width: 15%">{{ $data->keterangan }}</td>
                            <td>{{ $data->kegiatan }}</td>
                            <td style="width: 15%">
                                <button type="button" class="btn icon icon-left btn-info" data-bs-toggle="modal"
                                    data-bs-target="#detailAbsensiModal{{ $data->id }}">
                                    <i class="bi bi-eye"></i>
                                </button>
    
                                <!-- Modal Detail Absensi -->
                                <div class="modal fade" id="detailAbsensiModal{{ $data->id }}" tabindex="-1"
                                    aria-labelledby="detailAbsensiModalLabel{{ $data->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailAbsensiModalLabel{{ $data->id }}">Detail
                                                    Absensi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-6 col-12">
                                                        @if($data->foto_kegiatan)
                                                        <div style="width: 100%; aspect-ratio: 1/1; overflow: hidden; display: flex; justify-content: center; align-items: center; border: 1px solid #ddd;">
                                                            <img src="{{ asset('storage/absensi/' . $data->foto_kegiatan) }}"
                                                                alt="Bukti Absensi" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                                                        </div>
                                                        @else
                                                        <p><strong>Foto Kegiatan:</strong> Tidak ada</p>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-6 col-12">
                                                        <p><strong>Tanggal:</strong>
                                                            {{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</p>
                                                        <p><strong>Keterangan:</strong> {{ $data->keterangan }}</p>
                                                        <p><strong>Kegiatan:</strong> {{ $data->kegiatan }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            <div class="modal fade" id="absensiModal" tabindex="-1" aria-labelledby="absensiModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="absensiModalLabel">Laporkan Kegiatan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('siswa.add-absensi')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <input type="hidden" id="idSiswa" name="idSiswa" value="{{ $siswaId }}">
                                    <input type="hidden" id="idKelompok" name="idKelompok" value="{{ $kelompokId }}">
                                    <input type="hidden" id="idPembimbing" name="idPembimbing"
                                        value="{{ $pembimbingId }}">

                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="tanggal">Tanggal</label>
                                            <input type="date" class="form-control mt-2" id="tanggal"
                                                value="{{ date('Y-m-d') }}" readonly>
                                            <span class="text-muted small">*tanggal sudah terisi otomatis</span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <fieldset class="form-group">
                                                <select class="form-select mt-2" id="keterangan" name="keterangan">
                                                    <option value="Hadir">Hadir</option>
                                                    <option value="Izin">Izin</option>
                                                    <option value="Sakit">Sakit</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <label for="kegiatan" class="form-label">Kegiatan</label>
                                            <textarea class="form-control" id="kegiatan" name="kegiatan"
                                                rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="buktiAbsensi">Foto Kegiatan</label>
                                            <input type="file" id="buktiAbsensi" name="buktiAbsensi"
                                                class="form-control mt-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Informasi</h4>
            <div class="alert alert-warning">
                Pendaftaran kamu belum disetujui. Silahkan hubungi koordinator Prakerin!
            </div>
        </div>
    </div>
    @endif
</div>

@endsection

@section('scripts')
<script>
let tableAbsensi = document.querySelector('#tableAbsensi');
let datatableAbsensi = new simpleDatatables.DataTable(tableAbsensi);
</script>
@endsection