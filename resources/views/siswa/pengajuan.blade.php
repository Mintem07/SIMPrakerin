@extends('siswa.index')
@section('contentSiswa')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h3>Pengajuan Kelompok</h3>
</div>

<div class="page-content">
    @if(!$kelompok)
    <form action="{{ route('siswa.simpan-pengajuan') }}" method="POST" class="form form-vertical">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-body">
                            <h4 class="card-title mb-3">Kelompok</h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="namaKelompok">Nama Kelompok</label>
                                        <input type="text" class="form-control mt-2" id="namaKelompok"
                                            name="nama_kelompok" placeholder="masukkan nama kelompok">
                                    </div>
                                </div>
                            </div>
                            <h4 class="card-title mt-4 mb-3">Tempat</h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="namaIndustri">Nama Industri</label>
                                        <input type="text" class="form-control mt-2" id="namaIndustri"
                                            name="nama_industri" placeholder="masukkan nama industri">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea class="form-control" id="alamat" name="alamat" rows="2"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-body">
                            <h4 class="card-title mb-3">Anggota Kelompok</h4>
                            <div id="anggotaContainer" class="row">
                                <div class="col-12">
                                    <label for="anggota1">Anggota 1</label>
                                    <div class="form-group mt-2">
                                        <select class="choices form-select" name="anggota[]" id="anggota1">
                                            @foreach($siswaList as $s)
                                            <option value="{{ $s->id }}">{{ $s->nama_siswa }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="anggota2" class="mt-2">Anggota 2</label>
                                    <div class="form-group mt-2">
                                        <select class="choices form-select" name="anggota[]" id="anggota2">
                                            @foreach($siswaList as $s)
                                            <option value="{{ $s->id }}">{{ $s->nama_siswa }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="button" class="btn btn-secondary mt-2 w-100" id="addAnggotaBtn">Tambah Anggota</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>
    @else
    <form class="form form-vertical">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="form-body">
                            <h4 class="card-title mb-3">Kelompok</h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="namaKelompok">Nama Kelompok</label>
                                        <input type="text" class="form-control mt-2" id="namaKelompok"
                                            name="nama_kelompok" value="{{ $kelompok->nama_kelompok }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <h4 class="card-title mt-4 mb-3">Tempat</h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="namaIndustri">Nama Industri</label>
                                        <input type="text" class="form-control mt-2" id="namaIndustri"
                                            name="nama_industri" value="{{ $kelompok->industri->nama_industri }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="alamat" class="form-label">Alamat</label>
                                        <textarea class="form-control" id="alamat" name="alamat" rows="2"
                                            readonly>{{ $kelompok->industri->alamat }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="form-body">
                            <h4 class="card-title mb-3">Anggota Kelompok</h4>
                            <div id="anggotaContainer" class="row">
                                @foreach($kelompok->anggotaKelompok as $index => $anggota)
                                <div class="col-12">
                                    <label for="anggota{{ $index + 1 }}">Anggota {{ $index + 1 }}</label>
                                    <div class="form-group mt-2">
                                        <input type="text" class="form-control" value="{{ $anggota->siswa->nama_siswa }}"
                                            readonly>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let anggotaCount = 2;
    const maxAnggota = 4;
    const anggotaContainer = document.getElementById('anggotaContainer');
    const addAnggotaBtn = document.getElementById('addAnggotaBtn');

    addAnggotaBtn.addEventListener('click', function() {
        if (anggotaCount < maxAnggota) {
            anggotaCount++;

            const newCol = document.createElement('div');
            newCol.className = 'col-12';

            const newLabel = document.createElement('label');
            newLabel.setAttribute('for', 'anggota' + anggotaCount);
            newLabel.className = 'mt-2';
            newLabel.textContent = 'Anggota ' + anggotaCount;

            const newFormGroup = document.createElement('div');
            newFormGroup.className = 'form-group mt-2';

            const newSelect = document.createElement('select');
            newSelect.className = 'choices form-select';
            newSelect.name = 'anggota[]';
            newSelect.id = 'anggota' + anggotaCount;

            newSelect.innerHTML = `
                @foreach($siswaList as $s)
                <option value="{{ $s->id }}">{{ $s->nama_siswa }}</option>
                @endforeach
            `;

            newFormGroup.appendChild(newSelect);
            newCol.appendChild(newLabel);
            newCol.appendChild(newFormGroup);

            anggotaContainer.insertBefore(newCol, addAnggotaBtn.parentElement);

            new Choices(newSelect, {
                searchEnabled: true,
                shouldSort: false,
            });

            if (anggotaCount === maxAnggota) {
                addAnggotaBtn.disabled = true;
            }
        }
    });
});
</script>

@endsection