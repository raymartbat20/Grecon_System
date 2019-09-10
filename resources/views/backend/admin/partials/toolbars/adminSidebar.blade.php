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
          <span class="menu-title">Inventory Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{url('/admin/category')}}"><i class="mdi mdi-layers"></i> Categories</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('/admin/products/create')}}"><i class="mdi mdi-briefcase-plus"></i> New Raw Product</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('/admin/createProduct')}}"><i class="mdi mdi-briefcase-plus"></i> Create Product</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('/admin/products')}}"><i class="fa fa-bar-chart-o"></i> Stocks</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#purchase" aria-expanded="false" aria-controls="purchase">
          <i class="icon icon-basket menu-icon"></i>
          <span class="menu-title">Transaction</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="purchase">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="{{url('/admin/transaction')}}"><i class="fa fa-cart-plus"></i>New Transaction</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/admin/transaction/records')}}"><i class="fa fa-money"></i>Transaction Records  </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="reports">
          <i class="icon icon-docs menu-icon"></i>
          <span class="menu-title">Reports</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="reports">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="{{url('/admin/reports/top_selling')}}"><i class="fa fa-money"></i>Top Selling Products</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/admin/reports/critical_products')}}"><i class="fa fa-warning"></i>Critical Products</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>
  <!-- partial -->