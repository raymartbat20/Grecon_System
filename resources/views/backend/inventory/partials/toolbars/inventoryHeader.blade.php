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
          <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="mdi mdi-bell-outline mx-0"></i>
                @if (Auth()->user()->unreadNotifications()->take(5)->get()->count() > 0)
                  <span class="count"></span>                
                @endif
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list scrollable-dropdown" aria-labelledby="notificationDropdown">
                    @if (Auth()->user()->unreadNotifications->count() > 0)
                    <a class="dropdown-item" href="{{route('backend.inventory.notification.markAllRead')}}">
                      <p class="mb-0 font-weight-normal float-left">
                          You have {{Auth()->user()->unreadNotifications->count()}} Unread Notifications
                      </p>
                      <span class="badge badge-pill badge-warning float-right">Mark all as Read</span>
                    </a>
                    @else
                    <a class="dropdown-item">
                      <p class="mb-0 font-weight-normal float-left">
                          No Unread Notification
                      </p>
                    </a>
                  @endif
                  @foreach (Auth::user()->notifications as $notification)
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item"
                    href="{{url('/inventory_clerk/notification/'.$notification->id.'')}}"
                    style={{$notification->unread() ? "background:#e3e3e3;": ''}}>
                      <div class="preview-thumbnail">
                        <div class="preview-icon bg-{{$notification->data['badge']['bg']}}">
                          <i class="{{$notification->data['badge']['icon']}}"></i>
                        </div>
                      </div>
                      <div class="preview-item-content">
                        <h6 class="preview-subject font-weight-medium">{{$notification->data['title']}}</h6>
                        <p class="font-weight-light small-text mb-0">
                          {{$notification->data['message']}}
                        </p>
                        <p class="font-weight-heavy small-text mb-0">
                          <br>
                           {{$notification->created_at->diffForHumans()}}
                        </p>
                      </div>
                    </a>
                  @endforeach
              </div>
            </li>
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