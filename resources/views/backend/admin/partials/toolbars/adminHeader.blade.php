<!-- partial:partials/_navbar.html -->
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
      <ul class="navbar-nav mr-lg-2 d-none d-lg-flex">
        <li class="nav-item nav-toggler-item">
          <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
        </li>
<<<<<<< HEAD
        <li class="nav-item nav-search d-none d-lg-flex">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="search">
                <i class="mdi mdi-magnify"></i>
              </span>
            </div>
            <input type="text" class="form-control" placeholder="search" aria-label="search" aria-describedby="search">
          </div>
        </li>
=======
>>>>>>> 2ce7d968c0d71d605fc807dcc8275f0bafeec62b
      </ul>
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.html"><img src="http://www.urbanui.com/calmui/template/images/logo.svg" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="http://www.urbanui.com/calmui/template/images/logo-mini.svg" alt="logo"/></a>
      </div>
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item dropdown">
          <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
            <i class="mdi mdi-bell-outline mx-0"></i>
            <span class="count"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
            <a class="dropdown-item">
              <p class="mb-0 font-weight-normal float-left">You have 4 new notifications
              </p>
              <span class="badge badge-pill badge-warning float-right">View all</span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-success">
                  <i class="mdi mdi-information mx-0"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <h6 class="preview-subject font-weight-medium">Application Error</h6>
                <p class="font-weight-light small-text mb-0">
                  Just now
                </p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-warning">
                  <i class="mdi mdi-settings mx-0"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <h6 class="preview-subject font-weight-medium">Settings</h6>
                <p class="font-weight-light small-text mb-0">
                  Private message
                </p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <div class="preview-icon bg-info">
                  <i class="mdi mdi-account-box mx-0"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <h6 class="preview-subject font-weight-medium">New user registration</h6>
                <p class="font-weight-light small-text mb-0">
                  2 days ago
                </p>
              </div>
            </a>
          </div>
        </li>
        <li class="nav-item nav-profile dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
            <img src="/__backend/assets/images/faces/face5.jpg" alt="profile"/>
            <span class="nav-profile-name">Evan Morales</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
<<<<<<< HEAD
            <a class="dropdown-item">
              <i class="mdi mdi-settings text-primary"></i>
              Settings
=======
            <a class="dropdown-item" href="{{url('/admin/users/create')}}">
              <i class="icon-user-follow text-primary"></i>
              New User
>>>>>>> 2ce7d968c0d71d605fc807dcc8275f0bafeec62b
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item">
              <i class="mdi mdi-logout text-primary"></i>
              Logout
            </a>
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