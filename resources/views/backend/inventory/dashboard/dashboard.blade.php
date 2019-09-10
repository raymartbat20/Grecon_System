@extends('backend.inventory.master.inventoryMaster')
@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin d-flex flex-column">
      <div class="row">
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body text-center">
              <div class="text-warning mb-4">
                <i class="mdi mdi-chart-pie mdi-36px"></i>
                <p class="font-weight-medium mt-2">Total Products</p>
              </div>
              <h1 class="font-weight-light">{{$products_count}}</h1>
              <a href="{{route('backend.inventory.products.index')}}">
                <p class="mb-0 text-primary"><i class="fa fa-arrow-circle-o-right"></i> View Stocks</p>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body text-center">
              <div class="text-danger mb-4">
                <i class="fa fa-warning fa-2x"></i>
                <p class="font-weight-medium mt-2">Critical Products</p>
              </div>
            <h1 class="font-weight-light">{{$critical_products}}</h1>
              <a href="{{route('backend.inventory.reports.critical')}}">
                <p class="text-primary mb-0"><i class="fa fa-arrow-circle-o-right"></i> View Critical Products</p>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection