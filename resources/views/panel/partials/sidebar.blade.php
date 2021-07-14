<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('panel.dashboard')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item @if(getCurrentRouteName() == 'panel.dashboard') active @endif">
        <a class="nav-link" href="{{route('panel.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <li class="nav-item @if(getCurrentRouteName() == 'panel.users') active @endif">
        <a class="nav-link" href="{{route('panel.users')}}">
            <i class="fas fa-users"></i>
            <span>Users</span></a>
    </li>
    <li class="nav-item @if(getCurrentRouteName() == 'panel.category.index') active @endif">
        <a class="nav-link" href="{{route('panel.category.index')}}">
            <i class="fas fa-sticky-note"></i>
            <span>Categories</span></a>
    </li>

    <li class="nav-item @if(getCurrentRouteName() == 'panel.brand.index') active @endif">
        <a class="nav-link" href="{{route('panel.brand.index')}}">
            <i class="fas fa-sticky-note"></i>
            <span>Brands</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>