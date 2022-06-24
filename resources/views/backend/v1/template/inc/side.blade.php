<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            {{ Auth::user()->name }}
                            <span class="user-level">{{ Auth::user()->role }}</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="{{ route('profile.show') }}">
                                    <span class="link-collapse">Pengaturan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt fa-fw"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Navigasi Utama</h4>
                </li>
                @if (Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#base">
                            <i class="fas fa-layer-group"></i>
                            <p>Data Master</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="base">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{ route('employee.index') }}">
                                        <span class="sub-item">Karyawan</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('judge.index') }}">
                                        <span class="sub-item">Hakim</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('lawyer.index') }}">
                                        <span class="sub-item">Pengacara</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('filing-of-matter.index') }}">
                                        <span class="sub-item">Jenis Perkara</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('room.index') }}">
                                        <span class="sub-item">Ruangan</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('plaintiff.index') }}">
                            <i class="fas fa-users"></i>
                            <p>Penggugat</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('filing-of-matters.index') }}">
                        <i class="fas fa-hand-holding"></i>
                        <p>Pengajuan Perkara</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('data-fom.index') }}">
                        <i class="fas fa-table"></i>
                        <p>Perkara Saya</p>
                        <span class="badge badge-danger">0</span>
                    </a>
                </li>
                @if (Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('report.index') }}">
                            <i class="fas fa-file-alt"></i>
                            <p>Laporan</p>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
