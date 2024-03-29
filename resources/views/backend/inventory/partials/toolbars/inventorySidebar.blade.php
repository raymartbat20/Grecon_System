<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas sidebar-fixed" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{url('/inventory_clerk/dashboard')}}">
          <i class="mdi mdi-view-quilt menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('/inventory_clerk/suppliers')}}">
          <i class="fa fa-address-book menu-icon"></i>
          <span class="menu-title">Suppliers</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="fa fa-database menu-icon"></i>
          <span class="menu-title">Inventory Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{url('/inventory_clerk/category')}}"><i class="mdi mdi-layers mr-2"></i> Categories</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('/inventory_clerk/products/create')}}"><i class="mdi mdi-briefcase-plus mr-2"></i> New Raw Product</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('/inventory_clerk/createProduct')}}"><i class="mdi mdi-briefcase-plus mr-2"></i> Create Product</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('/inventory_clerk/products')}}"><i class="fa fa-bar-chart-o mr-2"></i> Stocks</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>
  <!-- partial -->