<ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #0000aa !important;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-text mx-3 fw-bold text-white fs-4">Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-1 border-white">

    <!-- Dashboard -->
    <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-th-large"></i>
            <span class="ms-2">Bảng điều khiển</span>
        </a>
    </li>

    <!-- Quản lí người dùng -->
    <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('admin.usermanager') }}">
            <i class="fas fa-user-cog"></i>
            <span class="ms-2">Quản lí người dùng</span>
        </a>
    </li>

    <!-- Quản lí chuyến đi -->
    <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('admin.travel-packages.index') }}">
            <i class="fas fa-map-marked-alt"></i>
            <span class="ms-2">Quản lí chuyến đi</span>
        </a>
    </li>
     <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('admin.categories.index') }}">
            <i class="fas fa-ticket-alt"></i>
            <span class="ms-2">Quản lí thể loại du lịch</span>
        </a>
    </li>
    <!-- Khuyến mãi -->
    <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('admin.promotion.index') }}">
            <i class="fas fa-tags"></i>
            <span class="ms-2">Khuyến mãi</span>
        </a>
    </li>

    <!-- Cấu hình thanh toán -->
    <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('admin.payment.index') }}">
            <i class="fas fa-credit-card"></i>
            <span class="ms-2">Cấu hình thanh toán</span>
        </a>
    </li>

    <!-- Hỗ trợ -->
    <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('admin.support.index') }}">
            <i class="fas fa-headset"></i>
            <span class="ms-2">Hỗ trợ</span>
        </a>
    </li>

    <!-- Bảo mật -->
    <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('admin.security.index') }}">
            <i class="fas fa-shield-alt"></i>
            <span class="ms-2">Bảo mật</span>
        </a>
    </li>

</ul>
