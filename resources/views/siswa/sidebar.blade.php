<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item  {{ request()->is('siswa') ? 'active' : '' }}">
                    <a href="{{ url('/siswa')}}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <div class="divider">
                    <div class="divider-text">Pendaftaran</div>
                </div>

                <li class="sidebar-item {{ request()->is('siswa/profil') ? 'active' : '' }}">
                    <a href="{{ url('/siswa/profil')}}" class='sidebar-link'>
                        <i class="bi bi-person-fill"></i>
                        <span>Profil Siswa</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->is('siswa/pengajuan-kelompok') ? 'active' : '' }}">
                    <a href="{{ url('/siswa/pengajuan-kelompok')}}" class='sidebar-link'>
                        <i class="bi bi-people-fill"></i>
                        <span>Pengajuan</span>
                    </a>
                </li>

                <div class="divider">
                    <div class="divider-text">Pelaksanaan</div>
                </div>

                <li class="sidebar-item {{ request()->is('siswa/absensi-mingguan') ? 'active' : '' }}">
                    <a href="{{ url('/siswa/absensi')}}" class='sidebar-link'>
                        <i class="bi bi-calendar-event-fill"></i>
                        <span>Absensi</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->is('siswa/laporan-akhir') ? 'active' : '' }}">
                    <a href="{{ url('/siswa/laporan-akhir')}}" class='sidebar-link'>
                        <i class="bi bi-cloud-arrow-up-fill"></i>
                        <span>Laporan Akhir</span>
                    </a>
                </li>

                <hr class="mb-2">

                <li class="sidebar-item {{ request()->is('siswa/setting') ? 'active' : '' }}">
                    <a href="{{ url('/siswa/setting')}}" class='sidebar-link'>
                        <i class="bi bi-gear-fill"></i>
                        <span>Setting</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a href="{{ route('logout') }}" class='sidebar-link'
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>