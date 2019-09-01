@extends('backend.admin.master.adminMaster')
@section('content')

  <div class="row">
    <div class="col-lg-12 grid-margin d-flex flex-column">
      <div class="row">
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body text-center">
              <div class="text-primary mb-4">
                <i class="fa fa-gavel fa-2x"></i>
                <p class="font-weight-medium mt-2">Top Product</p>
              </div>
              <h1 class="font-weight-light text-success">{{$top_product->product->product_name}}</h1>
              <p class="text-muted mb-0">Number of sold: {{$top_product->sum}}</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body text-center">
              <div class="text-danger mb-4">
                <i class="mdi mdi-chart-pie mdi-36px"></i>
                <p class="font-weight-medium mt-2">Total Products</p>
              </div>
              <h1 class="font-weight-light">{{$products_count}}</h1>
              <a href="{{route('backend.admin.products.index')}}">
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
              <a href="{{route('backend.admin.transaction.records')}}">
                <p class="text-primary mb-0">Transactions Today: {{$salesRecordsCount}}</p>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body text-center">
              <div class="text-info mb-4">
                <i class="fa fa-warning fa-2x"></i>
                <p class="font-weight-medium mt-2">Critical Products</p>
              </div>
            <h1 class="font-weight-light">{{$critical_products}}</h1>
              <a href="{{route('backend.admin.products.index')}}">
                <p class="text-primary mb-0"><i class="fa fa-arrow-circle-o-right"></i> View Stocks</p>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <canvas id="productChart">

        </canvas>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
    <script src="/__backend/assets/vendors/chart.js/Chart.min.js"></script>
    <script>
      let myChart = document.getElementById('productChart').getContext('2d');

      let productChart = new Chart(myChart, {
        type:'bar',
        data:{
          labels:[
            @foreach($top10_products as $product)
              "{{$product->product->product_name}}",
            @endforeach
          ],
          datasets:[{
            label:'Sold Product',
            data:[
            @foreach($top10_products as $product)
              "{{$product->sum}}",
            @endforeach              
            ],
            backgroundColor:[
              'rgba(7, 182, 21, 0.6)',
              'rgba(54,162,235, 0.6)',
              'rgba(219, 0, 73, 0.6)',
              'rgba(219, 0, 168, 0.6)',
              'rgba(183, 0, 219, 0.6)',
              'rgba(143, 148, 0, 0.6)',
              'rgba(26, 75, 255, 0.6)',
              'rgba(61, 174, 255, 0.6)',
              'rgba(229, 255, 61, 0.6)',
              'rgba(189, 132, 0, 0.6)',
              'rgba(189, 3, 0,, 0.6)',
            ]
          }],
        },
        options:{},
      });
    </script>
@endsection