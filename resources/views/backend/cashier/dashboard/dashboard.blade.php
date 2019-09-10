@extends('backend.cashier.master.cashierMaster')
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
              <a href="{{route('backend.cashier.products.index')}}">
                <p class="mb-0 text-primary"><i class="fa fa-arrow-circle-o-right"></i> View Stocks</p>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body text-center">
              <div class="text-info mb-4">
                <i class="fa fa-money fa-2x"></i>
                <p class="font-weight-medium mt-2">Total Sales Today</p>
              </div>
            <h1 class="font-weight-light">₱{{$sales_records}}</h1>
              <a href="{{route('backend.cashier.transaction.records')}}">
                <p class="text-primary mb-0">Transactions Today: {{$salesRecordsCount}}</p>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection