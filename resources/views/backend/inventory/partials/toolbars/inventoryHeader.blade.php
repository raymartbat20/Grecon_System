<!-- partial:partials/_navbar.html -->
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
      <ul class="navbar-nav mr-lg-2 d-none d-lg-flex">
        <li class="nav-item nav-toggler-item">
          <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
        </li>
      </ul>
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="/inventory/dashboard"><img src="/__backend/assets/images/grecon_background.png" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="/inventory/dashboard"><img src="/__backend/assets/images/grecon_background.png" alt="logo"/></a>
      </div>
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item nav-profile dropdown">
          <div class="dropdown-divider"></div>
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
            <img src="/__backend/assets/images/avatars/{{Auth::user()->image}}" alt="profile"/>
            <span class="nav-profile-name">{{Auth::user()->getFullName()}}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{url('/inventory_clerk/profile')}}">
            <i class="icon-user text-primary"></i>
              Profile
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{url('/inventory_clerk/change_password')}}">
              <i class="icon-lock text-primary"></i>
              Change Password
            </a>
            <div class="dropdown-divider"></div>
            <form action="{{route('auth.signOut')}}" method="get">
              <button type="submit" class="dropdown-item">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </button>
            </form>
          </div>
        </li>
        <li class="nav-item nav-toggler-item-right d-lg-none">
          <button class="navbar-toggler align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </li>
      </ul>
    </div>
  </nav>
  <!-- partial -->