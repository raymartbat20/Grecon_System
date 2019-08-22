@extends('backend.admin.master.adminMaster')

@section('content')
    <div class="col-lg-12 grid-margin stretched-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title float-right">Total Products: {{$products->count()}}</h4>
                <h4 class="card-title">Hello</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead align="center">
                            <th>Product</th>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th>Critical level</th>
                            <th>Critical Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr align="center">
                                    <td class="py-1"><img src="/__backend/assets/images/products/{{$product->image}}"></td>
                                    <td>{{$product->product_id}}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->qty}}</td>
                                    <td>
                                        @switch($product->status)
                                            @case("AVAILABLE")
                                                <p class="badge badge-success">
                                                    {{$product->status}}
                                                </p>
                                                @break
                                            @case("UNAVAILABLE")
                                                <p class="badge badge-info">
                                                    {{$product->status}}
                                                </p>
                                                @break
                                            @case("RESERVE")
                                                <p class="badge badge-primary">
                                                    {{$product->status}}
                                                </p>
                                                @break
                                            @case("OUT OF STOCK")
                                                <p class="badge badge-danger">
                                                    OUT OF STACK    
                                                </p>
                                                @break
                                            @default
                                                
                                        @endswitch
                                    </td>
                                    <td>
                                        <p class="badge badge-pill badge-info">
                                            {{$product->critical_amount}}
                                        </p>
                                    </td>
                                    <td>@if ($product->critical_status == 1)
                                            <p class="badge badge-danger">
                                                CRITICAL
                                            </p>
                                        @else
                                            <p class="badge badge-success">
                                                NORMAL
                                            </p>
                                        @endif
                                    </td>
                                    <td>
                                    <a class="btn btn-danger btn-sm" href="{{url('/admin/products/'.$product->product_id.'/edit')}}"><i class="mdi mdi-eye text-primary"></i>View</a>
                                    <a class="btn btn-warning btn-sm text-white" href="{{url('/admin/products/'.$product->product_id.'/log')}}"><i class="icon icon-docs text-primary"></i>Logs</a>
                                    </td>                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection