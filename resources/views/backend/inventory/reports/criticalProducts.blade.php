@extends('backend.inventory.master.inventoryMaster')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <a target="_blank" href="{{route('backend.inventory.reports.printCriticalProducts')}}" class="pull-right btn btn-primary"><i class="fa fa-print"></i>PRINT</a>
                <h4 class="card-title">Critical Products</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>Product Name</th>
                            <th>Qty</th>
                            <th>Critical Amount</th>
                            <th>Price</th>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->product_name}}</td>
                                    <td><span class="badge badge-pill badge-danger">{{$product->qty}}</span></td>
                                    <td><span class="badge badge-pill badge-info">{{$product->critical_amount}}</span></td>
                                    <td>{{$product->price}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection