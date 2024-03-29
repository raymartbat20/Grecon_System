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
                <p class="font-weight-medium mt-2">Top Product of last month</p>
              </div>
              @if ($top_product != null)
                <h1 class="font-weight-light text-success">{{$top_product->product->product_name}}</h1>
                <p class="text-muted mb-0">Number of sold: {{$top_product->sum}}{{$top_product->product->unit}}(s)</p>
              @else
              <h1 class="font-weight-light text-muted">No Record Yet!</h1>
              @endif
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body text-center">
              <div class="text-warning mb-4">
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
              <div class="text-danger mb-4">
                <i class="fa fa-warning fa-2x"></i>
                <p class="font-weight-medium mt-2">Critical Products</p>
              </div>
            <h1 class="font-weight-light">{{$critical_products}}</h1>
              <a href="{{route('backend.admin.reports.critical')}}">
                <p class="text-primary mb-0"><i class="fa fa-arrow-circle-o-right"></i> View Critical Products</p>
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
        <h6 class="card-title text-primary">Pick Daterange</h6>
        <form method="GET" action="{{url('/admin/dashboard')}}">
          <div class="row">
            <div class="input-group input-daterange d-flex align-items-center col-sm-10">
              <input type="text" class="form-control" id="dateStart" name="date_start" autocomplete="off">
              <div class="input-group-addon mx-4">to</div>
              <input type="text" class="form-control" id="dateEnd" name="date_end" autocomplete="off">
            </div>
            <div class="col-sm-2">
              <button type="submit" class="btn btn-success">Generate</button>
            </div>
          </div>
        </form>
        <h4 class="card-title text-success mt-2">Top 10 Selling Products</h4>
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
              '{{$product->product->product_name}}',
            @endforeach
          ],
          datasets:[{
            label:'Sold ',
            data:[
            @foreach($top10_products as $product)
              "{{$product->sum}}",
            @endforeach
            0,            
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
            ],
            borderWidth:1,
            borderColor:'#777',
            hoverBorderWidth:4,
            hoverBorderColor:'#000',
          }],
        },
        options:{},
      });

      $('.input-daterange input').each(function() {
          $(this).datepicker('clearDates');
      });

      $('#dateEnd').datepicker().on('changeDate',function(ev){
        var startDateVal = $("#dateStart").datepicker('getDate');
        var endDateVal = $(this).datepicker('getDate');

        if(startDateVal > endDateVal)
        {
          $("#dateStart").datepicker('update',endDateVal);
        }
      });
    </script>
@endsection