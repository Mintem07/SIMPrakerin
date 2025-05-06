<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anda Tersesat - SIM Prakerin</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/pages/error.css')}}">
</head>

<body>
    <div class="error-page container mt-5">
        <div class="col-md-8 col-12 offset-md-2">
            <div class="d-flex justify-content-center">
                <img width="480" src="{{asset('assets/images/samples/error-403.png')}}" alt="Not Found">
            </div>
            <div class="text-center">
                <h3 class="error-title">Anda Tidak Punya Akses</h3>
                <p class="fs-5 text-gray-600">Silahkan kembali ke halaman anda!</p>
                @if(auth()->check() && auth()->user()->role === 'pembimbing')
                <a href="/pembimbing" class="btn btn-lg btn-outline-primary mt-3">Kembali</a>
                @elseif(auth()->check() && auth()->user()->role === 'siswa')
                <a href="/siswa" class="btn btn-lg btn-outline-primary mt-3">Kembali</a>
                @else
                <a href="/kepala-sekolah" class="btn btn-lg btn-outline-primary mt-3">Kembali</a>
                @endif
            </div>
        </div>
    </div>
</body>

</html>