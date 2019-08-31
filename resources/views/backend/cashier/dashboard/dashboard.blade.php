@extends('backend.cashier.master.cashierMaster')
@section('content')

<div class="row">
        <div class="col-lg-8 grid-margin d-flex flex-column">
          <div class="row">
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body text-center">
                  <div class="text-primary mb-4">
                    <i class="mdi mdi-account-multiple mdi-36px"></i>
                    <p class="font-weight-medium mt-2">Customers</p>
                  </div>
                  <h1 class="font-weight-light">45679</h1>
                  <p class="text-muted mb-0">Increase by 20%</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body text-center">
                  <div class="text-danger mb-4">
                    <i class="mdi mdi-chart-pie mdi-36px"></i>
                    <p class="font-weight-medium mt-2">Orders</p>
                  </div>
                  <h1 class="font-weight-light">80927</h1>
                  <p class="text-muted mb-0">Increase by 60%</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body text-center">
                  <div class="text-info mb-4">
                    <i class="mdi mdi-car mdi-36px"></i>
                    <p class="font-weight-medium mt-2">Delivery</p>
                  </div>
                  <h1 class="font-weight-light">22339</h1>
                  <p class="text-muted mb-0">Decrease by 2%</p>
                </div>
              </div>
            </div>
            <div class="col-md-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body text-center">
                  <div class="text-success mb-4">
                    <i class="mdi mdi-verified mdi-36px"></i>
                    <p class="font-weight-medium mt-2">Users</p>
                  </div>
                  <h1 class="font-weight-light">+1900</h1>
                  <p class="text-muted mb-0">Steady growth</p>
                </div>
              </div>
            </div>
          </div>
@endsection