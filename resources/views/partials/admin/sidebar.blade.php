<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-text mx-3">Trang chủ ADMIN</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Thống kê</span></a>
    </li>

    <li class="nav-item ">
        <a class="nav-link" href="{{ route('admin.categories.index') }}">
            <i class="fas fa-list-alt"></i>
            <span>Thể loại vé</span></a>
    </li>

    <li class="nav-item ">
        <a class="nav-link" href="{{ route('admin.travel-packages.index') }}">
            <i class="fas fa-fw fa-hotel"></i>
            <span>Các loại vé</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">


</ul>