<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas sidebar-fixed" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{url('/cashier/dashboard')}}">
              <i class="mdi mdi-view-quilt menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/cashier/products')}}">
              <i class="fa fa-bar-chart-o"></i>
              <span class="menu-title">Stocks</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#purchase" aria-expanded="false" aria-controls="purchase">
              <i class="icon icon-basket menu-icon"></i>
              <span class="menu-title">Transaction</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="purchase">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{url('/cashier/transaction')}}"><i class="fa fa-cart-plus"></i>New Transaction</a></li>
                <li class="nav-item"><a class="nav-link" href="{{url('/cashier/transaction/records')}}"><i class="fa fa-money"></i>Transaction Records  </a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->