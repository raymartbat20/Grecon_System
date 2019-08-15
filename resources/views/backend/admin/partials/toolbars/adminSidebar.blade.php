<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas sidebar-fixed" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{url('/admin/dashboard')}}">
          <i class="mdi mdi-view-quilt menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('/admin/suppliers')}}">
          <i class="fa fa-address-book menu-icon"></i>
          <span class="menu-title">Suppliers</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="fa fa-database menu-icon"></i>
          <span class="menu-title">Inventory</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{url('/admin/category')}}"><i class="mdi mdi-layers"></i>Categories</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('/admin/products/create')}}"><i class="mdi mdi-briefcase-plus"></i> New Product</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/badges.html">Badges</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/breadcrumbs.html">Breadcrumbs</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/modals.html">Modals</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/progress.html">Progress bar</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/pagination.html">Pagination</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/tabs.html">Tabs</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
            <li class="nav-item"> <a class="nav-link" href="pages/ui-features/tooltips.html">Tooltips</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>
  <!-- partial -->