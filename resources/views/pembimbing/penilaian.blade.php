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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#penilaianModal">
                Nilai Siswa
            </button>
        </div>
        <div class="card-body">
            <h4 class="card-title mb-3">Daftar Nilai Siswa</h4>

            <table class="table table-bordered" id="tablePenilaian">
                <thead class="table-secondary">
                    <tr>
                        <th>Nama</th>
                        <th>Kelompok</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Hery Maguire</td>
                        <td>Kelompok Singa</td>
                        <td style="width: 15%">
                            <span class="badge bg-light-success p-2">Lulus</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="penilaianModal" tabindex="-1" aria-labelledby="penilaianModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="penilaianModalLabel">Penilaian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <!-- id pembimbing -->
                        <input type="hidden" id="idPembimbing" value="">
                        <!-- end id pembimbing -->

                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="student">Nama Siswa</label>
                                <select class="choices form-select mt-2" id="student" name="student">
                                    <option value="Budi">Budi</option>
                                    <option value="Heri">Heri</option>
                                    <option value="Jamal">Jamal</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="kelompok">Kelompok</label>
                                <select class="choices form-select mt-2" id="kelompok" name="kelompok">
                                    <option value="Kelompok Singa">Kelompok Singa</option>
                                    <option value="Kelompok Harimau">Kelompok Harimau</option>
                                    <option value="Kelompok Elang">Kelompok Elang</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group mb-3">
                                <label for="status">Status</label>
                                <select class="choices form-select mt-2" id="status" name="status">
                                    <option value="Lulus">Lulus</option>
                                    <option value="Tidak Lulus">Tidak Lulus</option>
                                </select>
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
@endsection