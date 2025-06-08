    <header class="header" id="header">
      <nav class="nav container">
        <a href="{{ route('home') }}" class="nav__logo"
          >VNTRAVEL</a>

        <div class="nav__menu" id="nav-menu">
          <ul class="nav__list">
            <li class="nav__item">
              <a href="{{ route('home') }}" class="nav__link {{ request()->is('/') ? ' active-link' : '' }}"">
                <i class="bx bx-home-alt nav__icon"></i>
                <span class="nav__name">Trang chủ</span>
              </a>
            </li>
            <li class="nav__item">
              <a href="{{ route('package') }}" class="nav__link {{ request()->is('paket-travel') ? ' active-link' : '' }}">
                <i class="bx bx-briefcase-alt nav__icon"></i>
                <span class="nav__name">Các loại vé</span>
              </a>
            </li>

            <li class="nav__item">
              <a href="{{ route('contact') }}" class="nav__link {{ request()->is('contact') ? ' active-link' : '' }}"">
                <i class="bx bx-message-square-detail nav__icon"></i>
                <span class="nav__name">Liên hệ</span>
              </a>
            </li>
            @if(Auth::check())
            <li class="nav__item dropdown">
              <a href="#" class="dropdown-toggle" id="userDropdown" role="button">
                Xin chào, {{ Auth::user()->name }}!
              </a>
              <ul class="dropdown-menu" id="dropdownMenu">
                @if(!Auth::user()->is_admin)
                  <li><a href="{{ route('my_tickets') }}">Vé của tôi</a></li>
                @else
                  <li><a href="{{ route('admin.dashboard') }}">Trang quản trị</a></li>
                @endif
                <li>
                  <a href="{{ route('logout') }}" 
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      Đăng xuất
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
                </li>
              </ul>
            </li>
            @endif

            <style>
                .dropdown-menu {
                    display: none;
                    position: absolute;
                    background: white;
                    list-style: none;
                    padding: 10px;
                    border: 1px solid #ccc;
                }
            </style>

            <script>
                document.getElementById("userDropdown").addEventListener("click", function(event) {
                  event.preventDefault();
                  let menu = document.getElementById("dropdownMenu");
                  menu.style.display = menu.style.display === "block" ? "none" : "block";
              });

              document.addEventListener("click", function(event) {
                  let dropdown = document.getElementById("dropdownMenu");
                  if (!event.target.closest(".dropdown")) {
                      dropdown.style.display = "none";
                  }
              });
            </script>
          </ul>
        </div>
      </nav>
    </header>