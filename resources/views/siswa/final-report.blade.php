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
    <h3>Laporan Akhir</h3>
</div>

<div class="page-content">
    @if(isset($kelompok) && isset($pembimbing))
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Panduan Laporan Akhir Prakerin</h4>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        Laporan akhir Prakerin adalah dokumen yang berisi rangkuman kegiatan siswa selama pelaksanaan
                        Praktik Kerja Industri.
                    </p>
                    <ul class="card-text">
                        <li><strong>Laporan dibuat dalam bentuk file presentasi (PPT)</strong>, berisi ringkasan
                            kegiatan, pengalaman, dan pembelajaran selama Prakerin.</li>
                        <li><strong>Disusun secara kelompok</strong>, menggunakan bahasa yang baik, rapi, dan mudah
                            dipahami.</li>
                        <li>Berisi poin-poin penting seperti:
                            <ul>
                                <li>Identitas siswa dan instansi tempat Prakerin</li>
                                <li>Ringkasan kegiatan harian/mingguan</li>
                                <li>Pengetahuan dan keterampilan yang didapat</li>
                                <li>Kendala dan solusi</li>
                                <li>Kesimpulan & saran</li>
                            </ul>
                        </li>
                        <li><strong>Wajib mengandung unsur visual</strong>, seperti foto kegiatan Prakerin (jika ada).
                        </li>
                        <li><strong>Diserahkan dalam format digital (PPT atau PDF)</strong>, dan dikumpulkan sesuai
                            batas waktu yang ditentukan.</li>
                    </ul>
                    <p class="card-text mt-3">
                        Silakan ikuti arahan dari pembimbing masing-masing untuk format dan teknis pengumpulan.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">

            @if(isset($file))
            <div class="div">
                <div class="alert alert-light">
                    <div class="fs-5">
                        <i class="bi bi-file-earmark-ruled-fill text-danger me-2 fs-3"></i>
                        {{ $file->file_laporan_akhir }} terunggah
                    </div>
                </div>
            </div>
            @endif

            <form action="{{route('siswa.upload-laporan-akhir')}}" method="post" class="form form-vertical"
                enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Unggah Laporan Akhir</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            <div class="row">
                                <!-- id kelompok -->
                                <input type="hidden" id="idKelompok" name="idKelompok" value="{{ $kelompok->id }}">
                                <!-- end id kelompok -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="finalReport" class="form-label">File Laporan Akhir</label>
                                        <input class="form-control" type="file" id="finalReport" name="finalReport"
                                            require>
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