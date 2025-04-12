@extends('siswa.index')
@section('contentSiswa')

<header class="mb-3">
    <a href="#" class="burger-btn d-block d-xl-none">
        <i class="bi bi-justify fs-3"></i>
    </a>
</header>

<div class="page-heading">
    <h3>Dashboard</h3>
</div>

<div class="page-content">
    <section class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <!-- notif -->
                    <div class="tempat-notif">

                    </div>
                    <!-- end notif -->
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="m-0">Catatan Pembimbing</h4>
                                <div class="d-flex align-items-center">
                                    <div class="">
                                        <p class="font-bold text-end m-0">{{ $pembimbing->nama_pembimbing }}</p>
                                        <p class="font-muted text-end m-0">Pembimbing</p>
                                    </div>
                                    <div class="avatar avatar-xl ms-3 mb-0">
                                        @if($pembimbing->jenis_kelamin == 'Perempuan')
                                        <img src="{{asset('assets/images/faces/3.jpg')}}">
                                        @else
                                        <img src="{{asset('assets/images/faces/2.jpg')}}">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Catatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($newNote) > 0)
                                        @foreach($newNote as $note)
                                        <tr>
                                            <td class="col-3">
                                                <p class="font-bold mb-0">
                                                    {{ $note->created_at->translatedFormat('j M') }}</p>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0" style="
                                                display: -webkit-box;
                                                -webkit-line-clamp: 2;
                                                -webkit-box-orient: vertical;
                                                overflow: hidden;
                                                text-overflow: ellipsis;">
                                                    {{ $note->catatan }}

                                                </p>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="2" class="text-center text-muted py-5">
                                                Belum ada catatan dari pembimbing
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <div class="divider">
                                <h5 class="divider-text">Jadwal Kegiatan</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="timeline-with-icons">
                                @foreach($jadwal as $data)
                                <li class="timeline-item mb-5 @if(!$data->is_active) text-muted opacity-75 @endif">
                                    <span class="timeline-icon">
                                        <i
                                            class="bi bi-circle-fill @if(!$data->is_active) text-muted @else text-success @endif"></i>
                                    </span>
                                    <h5 class="fw-bold @if(!$data->is_active) text-secondary @endif">
                                        {{ $data->kegiatan }}
                                    </h5>
                                    <p
                                        class="mb-2 fw-bold @if(!$data->is_active) text-secondary @else text-muted @endif">
                                        {{ $data->tgl_selesai ? 
    (\Carbon\Carbon::parse($data->tgl_mulai)->format('Y-m') == \Carbon\Carbon::parse($data->tgl_selesai)->format('Y-m') ? 
        \Carbon\Carbon::parse($data->tgl_mulai)->translatedFormat('j').' - '.\Carbon\Carbon::parse($data->tgl_selesai)->translatedFormat('j M Y') : 
        \Carbon\Carbon::parse($data->tgl_mulai)->translatedFormat('j M').' - '.\Carbon\Carbon::parse($data->tgl_selesai)->translatedFormat('j M Y')) : 
    \Carbon\Carbon::parse($data->tgl_mulai)->translatedFormat('j M Y') }}
                                    </p>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const notifContainer = document.querySelector('.tempat-notif');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    function showNotification(message) {
        // Hapus notifikasi lama
        notifContainer.innerHTML = '';

        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-info alert-dismissible fade show';
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        notifContainer.appendChild(alertDiv);

        // Auto close setelah 5 detik
        // setTimeout(() => {
        //     const bsAlert = bootstrap.Alert.getOrCreateInstance(alertDiv);
        //     bsAlert.close();
        // }, 5000);
    }

    function checkNotes() {
        fetch('/check-new-notes', {
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                credentials: 'same-origin'
            })
            .then(response => response.json())
            .then(data => {
                if (data.has_new_notes) {
                    const msg = data.count > 1 ?
                        `Ada ${data.count} catatan baru dari pembimbing!` :
                        'Ada 1 catatan baru dari pembimbing!';
                    showNotification(msg);
                }
            })
            .catch(console.error);
    }

    // Polling setiap 30 detik
    setInterval(checkNotes, 30000);

    // Jalankan segera setelah page load
    checkNotes();
});
</script>
@endsection