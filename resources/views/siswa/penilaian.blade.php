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
    <h3>Berkas dan Penilaian</h3>
</div>

<div class="page-content">
    @if(isset($kelompok) && isset($pembimbing))
    <div class="row">
        <div class="col-12 col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Unduh Berkas</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-lg">
                            <thead>
                                <tr>
                                    <th>Nama File</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($berkas as $file)
                                <tr>
                                    <td>
                                        <p class="m-0"><span><i
                                                    class="bi bi-file-earmark-ruled-fill text-success me-2"></i></span>{{ $file->nama_berkas }}
                                        </p>
                                    </td>
                                    <td>
                                        <a href="{{ route('berkas.download', $file->id) }}"
                                            class="btn icon btn-primary">Unduh</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-5">
            <form action="{{route('siswa.upload-bukti')}}" method="post" class="form form-vertical"
                enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Bukti Penilaian</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            <div class="row">
                                <input type="hidden" id="idSiswa" name="idSiswa" value="{{ $siswa->id }}">
                                <input type="hidden" id="idKelompok" name="idKelompok" value="{{ $kelompok->id }}">
                                <input type="hidden" id="idPembimbing" name="idPembimbing"
                                    value="{{ $pembimbing->id }}">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="finalReport" class="form-label">File Scan/Foto Form
                                            Penilaian</label>
                                        <input class="form-control" type="file" id="finalReport" name="finalReport"
                                            require>
                                        <p><small class="text-muted">File dalam bentuk png/jpg/jpeg</small></p>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Unggah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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