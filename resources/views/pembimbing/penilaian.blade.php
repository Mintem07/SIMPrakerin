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
    <h3>Penilaian Akhir Siswa</h3>
</div>

<div class="page-content">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-3">Daftar Nilai Siswa</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-lg" id="tablePenilaian">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Rata-rata</th>
                            <th>Laporan</th>
                            <th>Aksi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penilaian as $data)
                        <tr>
                            <td style="width: 40%;">{{ $data->siswa->nama_siswa }}</td>
                            <td>
                                @if($data->average_poin !== null)
                                {{ $data->average_poin }}
                                @else
                                -
                                @endif
                            </td>
                            <td>
                                @if($data->report_poin !== null)
                                {{ $data->report_poin }}
                                @else
                                -
                                @endif
                            </td>
                            <td style="width: 15%">
                                @if($data->status === 'Lulus')
                                <span class="badge bg-light-success p-2">Lulus</span>
                                @elseif($data->status === 'Tidak Lulus')
                                <span class="badge bg-light-danger p-2">Tidak Lulus</span>
                                @else
                                <span class="badge bg-light-secondary p-2">Pending</span>
                                @endif
                            </td>
                            <td>
                                @if(isset($data->form_bukti))
                                @php
                                $extension = pathinfo($data->form_bukti, PATHINFO_EXTENSION);
                                $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                $isImage = in_array(strtolower($extension), $imageExtensions);
                                @endphp

                                @if($isImage)
                                <button type="button" class="btn icon btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#buktiModal{{ $data->id }}">
                                    <i class="bi bi-eye-fill"></i>
                                </button>

                                <div class="modal fade" id="buktiModal{{ $data->id }}" tabindex="-1"
                                    aria-labelledby="buktiModalLabel{{ $data->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="buktiModalLabel{{ $data->id }}">Form Nilai
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        @if($data->form_bukti)
                                                        <div style="width: 100%;">
                                                            <p>{{$data->form_bukti}}</p>
                                                            <img src="{{ asset('storage/bukti_nilai/' . $data->form_bukti) }}"
                                                                alt="Bukti Absensi" class="img-fluid"
                                                                style="width: 100%; height: 100%; object-fit: cover;">
                                                        </div>
                                                        @else
                                                        <p><strong>Foto Kegiatan:</strong> Tidak ada</p>
                                                        @endif
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
                                @elseif(strtolower($extension) === 'pdf')

                                <a href="{{ asset('storage/bukti_nilai/' . $data->form_bukti) }}" target="_blank"
                                    class="btn icon btn-sm btn-info">
                                    <i class="bi bi-eye-fill"></i>
                                </a>

                                @else

                                <button type="button" class="btn icon btn-sm btn-info">
                                    <i class="bi bi-cross"></i>
                                </button>

                                @endif
                                @endif


                                <button type="button" class="btn icon btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editNilai{{ $data->id }}">
                                    <i class="bi bi-pencil-fill"></i>
                                </button>

                                <div class="modal fade" id="editNilai{{ $data->id }}" tabindex="-1"
                                    aria-labelledby="editNilaiLabel{{ $data->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{route('pembimbing.edit-nilai')}}" method="post"
                                                class="form form-vertical" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editNilaiLabel{{ $data->id }}">Input
                                                        Nilai
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="id" value="{{ $data->id }}">

                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <div class="form-group">
                                                                <label for="rata-rata">Nilai dari Industri</label>
                                                                <input type="number" class="form-control" name="avgPoin"
                                                                    id="rata-rata" step="0.01" min="0" max="100"
                                                                    value="{{ old('avgPoin', $data->average_poin) }}"
                                                                    required>
                                                                <p><small class="text-muted">Nilai rata-rata (contoh:
                                                                        85.50)</small></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="form-group">
                                                                <label for="presentasi">Laporan Akhir/Presentasi</label>
                                                                <input type="number" class="form-control"
                                                                    name="reportPoin" id="presentasi" step="0.01"
                                                                    min="0" max="100"
                                                                    value="{{ old('reportPoin', $data->report_poin) }}"
                                                                    required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada siswa yang menyelesaikan laporan
                            </td>
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
let tablePenilaian = document.querySelector('#tablePenilaian');
let datatablePenilaian = new simpleDatatables.DataTable(tablePenilaian);
</script>
@endsection