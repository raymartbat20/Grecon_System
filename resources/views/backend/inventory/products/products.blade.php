@extends('backend.inventory.master.inventoryMaster')

@section('content')
    <div class="col-lg-12 grid-margin stretched-card">
        <div class="card">
            <div class="card-body">
                <a href="{{route('backend.inventory.products.archiveProducts')}}" class="btn btn-info pull-right">
                    Archive products
                    @if ($archive > 0)
                        <span class="badge badge-pill badge-warning">
                            {{$archive}}
                        </span>
                    @endif      
                </a>
                <h4 class="card-title">Product List</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead align="center">
                            <th>Product</th>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Supplier</th>
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
                                    <td>
                                        <span class="badge badge-pill badge-warning">
                                            {{$product->supplier->company}}
                                        </span>
                                    </td>
                                    <td>{{$product->price}}</td>
                                    <td>
                                        <span class="badge badge-outline-info badge-pill">
                                            {{$product->qty}}{{$product->unit}}
                                        </span>
                                    </td>
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
                                    <a class="btn btn-outline-info btn-sm" href="{{url('/inventory/products/'.$product->product_id.'/edit')}}"><i class="mdi mdi-eye text-primary"></i>View</a>
                                    <a class="btn btn-outline-danger btn-sm" href="{{url('/inventory/products/'.$product->product_id.'/log')}}"><i class="icon icon-docs text-primary"></i>Logs</a>
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
@section('scripts')
    <script>
        $(".table").DataTable();
    </script>
@endsection