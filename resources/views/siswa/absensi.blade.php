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

            <table class="table table-bordered" id="tableAbsensi">
                <thead class="bg-light-success">
                    <tr>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Kegiatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width: 15%">10-03-2025</td>
                        <td style="width: 15%">Hadir</td>
                        <td>Instalasi Router</td>
                        <td style="width: 15%">
                            <button type="button" class="btn btn-info">
                                <i class="bi bi-eye"></i> Detail
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="absensiModal" tabindex="-1" aria-labelledby="absensiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="absensiModalLabel">Laporkan Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('siswa.add-absensi')}}" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="idSiswa" name="idSiswa" value="{{ $siswaId }}">
                            <input type="hidden" id="idKelompok" name="idKelompok" value="{{ $kelompokId }}">
                            <input type="hidden" id="idPembimbing" name="idPembimbing" value="{{ $pembimbingId }}">

                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" class="form-control mt-2" id="tanggal" value="{{ date('Y-m-d') }}" readonly>
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
                                    <textarea class="form-control" id="kegiatan" name="kegiatan" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="buktiAbsensi">Foto Kegiatan</label>
                                    <input type="file" id="buktiAbsensi" name="buktiAbsensi"
                                        class="basic-filepond mt-2">
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