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
    <h3>Profil Siswa</h3>
</div>

<div class="page-content">
    <div class="card">
        <div class="card-header">

            @if($siswa)
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#lengkapiDataDiriModal"
                disabled>
                Lengkapi Data Diri
            </button>
            @else
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#lengkapiDataDiriModal">
                Lengkapi Data Diri
            </button>
            @endif

            @if($siswa && $siswa->id)
            <button type="button" class="btn btn-warning ms-2" data-bs-toggle="modal"
                data-bs-target="#editDataDiriModal">
                Edit Data Diri
            </button>
            @else
            <button type="button" class="btn btn-secondary ms-2" data-bs-toggle="modal"
                data-bs-target="#editDataDiriModal" disabled>
                Edit Data Diri
            </button>
            @endif

        </div>
        <div class="card-body">
            @if($siswa)
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="form-group">
                        <label for="namaSiswa">Nama Lengkap</label>
                        <input type="text" class="form-control mt-2" id="namaSiswa" name="namaSiswa"
                            value="{{ $siswa->nama_siswa }}" readonly>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control mt-2" id="kelas" name="kelas" value="{{ $siswa->kelas }}" readonly>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="form-group">
                        <label for="jurusan">Jurusan</label>
                        <input type="text" class="form-control mt-2" id="jurusan" name="jurusan" value="{{ $siswa->jurusan }}" readonly>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="form-group">
                        <label for="jenisKelamin">Jenis Kelamin</label>
                        <input type="text" class="form-control mt-2" id="jenisKelamin" name="jenisKelamin" value="{{ $siswa->jenis_kelamin }}" readonly>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="form-group">
                        <label for="telp">No. Telpon</label>
                        <input type="number" class="form-control mt-2" id="telp" name="telp" value="{{ $siswa->telp }}"
                            readonly>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="form-group mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3"
                            readonly>{{ $siswa->alamat }}</textarea>
                    </div>
                </div>
            </div>
            @else
            <p>Data diri belum tersedia. Silakan lengkapi data diri Anda.</p>
            @endif
        </div>
    </div>
</div>

<!-- Modal Lengkapi Data Diri -->
<div class="modal fade" id="lengkapiDataDiriModal" tabindex="-1" aria-labelledby="lengkapiDataDiriModalLabel"
    aria-hidden="true">
    <div class="modal-lg modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lengkapiDataDiriModalLabel">Lengkapi Data Diri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('siswa.add-profil')}}" method="POST" class="form form-vertical">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <input type="hidden" id="userId" name="userId" value="{{Auth::user()->id}}">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="namaSiswa">Nama Lengkap</label>
                                    <input type="text" class="form-control mt-2" id="namaSiswa" name="namaSiswa"
                                        placeholder="masukkan nama lengkap" required>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3">
                                <label for="kelas">Kelas</label>
                                <fieldset class="form-group">
                                    <select class="form-select mt-2" id="kelas" name="kelas">
                                        <option value="XI">XI</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-6 col-lg-3">
                                <label for="jurusan">Jurusan</label>
                                <fieldset class="form-group">
                                    <select class="form-select mt-2" id="jurusan" name="jurusan">
                                        <option value="TKJ">TKJ</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-6 col-lg-3">
                                <label for="jenisKelamin">Jenis Kelamin</label>
                                <fieldset class="form-group">
                                    <select class="form-select mt-2" id="jenisKelamin" name="jenisKelamin">
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="form-group">
                                    <label for="telp">No. Telpon</label>
                                    <input type="number" class="form-control mt-2" id="telp" name="telp"
                                        placeholder="08xx-xxxx-xxxx" required>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Data Diri -->
@if($siswa && $siswa->id)
<div class="modal fade" id="editDataDiriModal" tabindex="-1" aria-labelledby="editDataDiriModalLabel"
    aria-hidden="true">
    <div class="modal-lg modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataDiriModalLabel">Edit Data Diri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('siswa.update-profil', $siswa->id)}}" method="POST" class="form form-vertical">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <input type="hidden" id="userId" name="userId" value="{{Auth::user()->id}}">
                            <div class="col-12 col-lg-6">
                                <div class="form-group">
                                    <label for="namaSiswa">Nama Lengkap</label>
                                    <input type="text" class="form-control mt-2" id="namaSiswa" name="namaSiswa"
                                        value="{{ $siswa->nama_siswa }}" required>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3">
                                <label for="kelas">Kelas</label>
                                <fieldset class="form-group">
                                    <select class="form-select mt-2" id="kelas" name="kelas">
                                        <option value="XI" {{ $siswa->kelas == 'XI' ? 'selected' : '' }}>XI</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-6 col-lg-3">
                                <label for="jurusan">Jurusan</label>
                                <fieldset class="form-group">
                                    <select class="form-select mt-2" id="jurusan" name="jurusan">
                                        <option value="TKJ" {{ $siswa->jurusan == 'TKJ' ? 'selected' : '' }}">TKJ
                                        </option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-6 col-lg-3">
                                <label for="jenisKelamin">Jenis Kelamin</label>
                                <fieldset class="form-group">
                                    <select class="form-select mt-2" id="jenisKelamin" name="jenisKelamin">
                                        <option value="Laki-laki"
                                            {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                        </option>
                                        <option value="Perempuan"
                                            {{ $siswa->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="form-group">
                                    <label for="telp">No. Telpon</label>
                                    <input type="number" class="form-control mt-2" id="telp" name="telp"
                                        value="{{ $siswa->telp }}" required>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3"
                                        required>{{ $siswa->alamat }}</textarea>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

@endsection