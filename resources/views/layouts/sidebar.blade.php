<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">College SBD</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    @if(isAdmin())
        <li class="nav-item {{ Request::is('pasien') || Request::is('pasien/*') ? 'active' : ''}}">
            <a class="nav-link" href="{{ route('pasien') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Pasien</span></a>
        </li>
    @endif

    <li class="nav-item {{ Request::is('register-pasien') || Request::is('register-pasien/*') ? 'active' : ''}}">
        <a class="nav-link" href="{{ route('register-pasien') }}">
            <i class="fas fa-fw fa-medkit"></i>
            <span>Register Pasien</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
