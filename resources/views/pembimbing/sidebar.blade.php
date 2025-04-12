<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="{{asset('assets/images/logo/logo.png')}}" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item  {{ request()->is('pembimbing') ? 'active' : '' }}">
                    <a href="{{ url('/pembimbing')}}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <div class="divider">
                    <div class="divider-text">Pelaksanaan</div>
                </div>

                <li class="sidebar-item {{ request()->is('pembimbing/monitoring-siswa') ? 'active' : '' }}">
                    <a href="{{ url('/pembimbing/monitoring-siswa')}}" class='sidebar-link'>
                        <i class="bi bi-display-fill"></i>
                        <span>Monitoring Siswa</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->is('pembimbing/laporan-prakerin') ? 'active' : '' }}">
                    <a href="{{ url('/pembimbing/laporan-prakerin')}}" class='sidebar-link'>
                        <i class="bi bi-folder-fill"></i>
                        <span>Laporan Akhir</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->is('pembimbing/penilaian-siswa') ? 'active' : '' }}">
                    <a href="{{ url('/pembimbing/penilaian-siswa')}}" class='sidebar-link'>
                        <i class="bi bi-file-earmark-ruled-fill"></i>
                        <span>Penilaian</span>
                    </a>
                </li>

                <hr class="my-3">

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