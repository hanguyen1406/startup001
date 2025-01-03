    <header class="header" id="header">
      <nav class="nav container">
        <a href="{{ route('home') }}" class="nav__logo"
          ><img
            width="250"
            style="height: 70px; object-fit: cover"
            src="{{ asset('frontend/assets/images/logo-go-lombok____.png') }}"
            alt=""
        /></a>

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
          </ul>
        </div>
      </nav>
    </header>