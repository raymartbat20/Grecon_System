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
        <a class="nav-link" data-toggle="collapse" href="#inventory" aria-expanded="false" aria-controls="inventory">
          <i class="fa fa-database menu-icon"></i>
          <span class="menu-title">Inventory Management</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="inventory">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="{{url('/admin/category')}}"><i class="mdi mdi-layers mr-2"></i>Categories</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/admin/products/create')}}"><i class="mdi mdi-briefcase-plus mr-2"></i>New Raw Product</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/admin/product/new-product')}}"><i class="mdi mdi-briefcase mr-2"></i>Create Product</i></a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/admin/products/stocks')}}"><i class="fa fa-bar-chart-o mr-2"></i>Stocks</a></li>
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
            <li class="nav-item"><a class="nav-link" href="{{url('/admin/transaction/new-transaction')}}"><i class="fa fa-cart-plus mr-2"></i>New Transaction</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/admin/transaction/records')}}"><i class="fa fa-money mr-2"></i>Transaction Records  </a></li>
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
            <li class="nav-item"><a class="nav-link" href="{{url('/admin/reports/top_selling')}}"><i class="fa fa-money mr-2"></i>Top Selling Products</a></li>
            <li class="nav-item"><a class="nav-link" href="{{url('/admin/reports/critical_products')}}"><i class="fa fa-warning mr-2"></i>Critical Products</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>
  <!-- partial -->