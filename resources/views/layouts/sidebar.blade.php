<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('dashboard') }}">
        <div class="sidebar-brand-text mx-3">Presensi Online <small> Dinas Kominfo </small></div><br>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->segment(1) == 'dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Management
    </div>
    @if(session('role_id') == 1)
    <!-- Nav Item - Charts -->
    <li class="nav-item {{ (request()->segment(1) == 'user') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('user') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span></a>
    </li>

    <!-- Nav Item - Attendance -->
    <li class="nav-item {{ (request()->segment(1) == 'attendance') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('attendance') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Attendance</span></a>
    </li>

    <li class="nav-item {{ (request()->segment(1) == 'role') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('role') }}">
            <i class="fas fa-fw fa-lock"></i>
            <span>Roles</span></a>
    </li>
    <li class="nav-item {{ (request()->segment(1) == 'concession') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('concession') }}">
            <i class="fas fa-fw fa-edit"></i>
            <span>Concession</span></a>
    </li>

    <!-- Laporan -->
    <li class="nav-item {{ (request()->routeIs('laporan.harian')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('laporan.harian') }}">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Laporan</span>
        </a>
    </li>

    <!-- Instansi -->
    <li class="nav-item {{ (request()->routeIs('instansi')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('instansi.index') }}">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Instansi</span>
        </a>
    </li>
    @endif

    @if(session('role_id') == 2)
    <li class="nav-item {{ (request()->segment(1) == 'salary') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('salary') }}">
            <i class="fas fa-fw fa-dollar-sign"></i>
            <span>Salary</span></a>
    </li>
    <li class="nav-item {{ (request()->segment(1) == 'attendance') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('attendance') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Report Attendance</span></a>
    </li>
    @endif

    @if(session('role_id') == 3)
    <li class="nav-item {{ (request()->segment(1) == 'attendance') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('attendance') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Report Attendance</span></a>
    </li>
    <li class="nav-item {{ (request()->segment(1) == 'concession') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('concession') }}">
            <i class="fas fa-fw fa-edit"></i>
            <span>Report Concession</span></a>
    </li>
    @endif

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Nav Item - Logout -->
    <li class="nav-item">
        <a class="nav-link" href="{{ url('logout') }}">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

</ul>
<!-- End of Sidebar -->
