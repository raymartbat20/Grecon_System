@extends('backend.admin.master.adminMaster')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <a target="_blank" href="{{route('backend.admin.reports.printTopSelling')}}" class="pull-right btn btn-primary"><i class="fa fa-print"></i>PRINT</a>
                <h4 class="card-title">Top Selling Products</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Total Quantity Sold</th>
                            <th>Price</th>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->product->product_name}}</td>
                                    <td>
                                    <span class="badge badge-pill
                                    {{$product->product->qty > $product->product->critical_amount ? 'badge-info' : 'badge-danger'}}">{{$product->qty}}
                                    </td>
                                    <td><span class="badge badge-pill badge-success">{{$product->sum}}</span></td>
                                    <td>₱{{$product->product->price}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(".table").DataTable();
    </script>
@endsection
