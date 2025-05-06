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
    <h3>Ubah Password</h3>
</div>

<div class="page-content">
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('setting.update') }}">
                        @csrf
                        <div class="form-group">
                            <label for="current_password">Password Lama</label>
                            <input type="password" class="form-control mt-2 @error('current_password') is-invalid @enderror" name="current_password" required>
                            @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="new_password">Password Baru</label>
                            <input type="password" class="form-control mt-2 @error('new_password') is-invalid @enderror" name="new_password" required>
                            @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" name="new_password_confirmation" required>
                        </div>
    
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection