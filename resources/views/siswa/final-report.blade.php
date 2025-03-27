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
                    <h4 class="card-title">Panduan Laporan Akhir</h4>
                </div>
                <div class="card-body">
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Suscipit doloremque hic
                        sapiente, quam iure animi explicabo quisquam natus? Consequuntur, blanditiis? Illum
                        repellendus dolor reiciendis et itaque nemo suscipit. At qui dolorem voluptate.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <form action="{{route('siswa.upload-laporan-akhir')}}" method="post" class="form form-vertical" enctype="multipart/form-data">
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
                                        <input class="form-control" type="file" id="finalReport" name="finalReport" require>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
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