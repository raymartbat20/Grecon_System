@extends('backend.admin.master.adminMaster')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <a href="">
                    <button type="button" class="btn btn-primary pull-right">MATERIALS</button>
                </a>
                <h4 class="card-title">Crate New Product</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead align="center">
                            <th>Product</th>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Critical Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr align="center">
                                    <td class="py-1"><img src="/__backend/assets/images/products/{{$product->image}}"></td>
                                    <td>{{$product->product_id}}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->qty}}</td>
                                    <td>{{$product->category->category}}</td>
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
                                        @if ($product->critical_status == 1)
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
                                        <button data-toggle="modal" data-target="#createProduct-material-qty" class="btn btn-outline-success btn-sm"
                                        data-product_id="{{$product->product_id}}" {{$product->status != "AVAILABLE" ? 'disabled' : ''}}>Add</button>
                                        <button data-toggle="modal" data-target="#product-info" class="btn btn-outline-info btn-sm"
                                        data-product_id="{{$product->product_id}}">Info</button>
                                    </td>                                    
                                </tr>
                            @endforeach       
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="createProduct-material-qty" aria-hidden="true">
        <div class="modal-dialog modal-default modal-center">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" data-dismiss="modal" class="close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2>This is working!</h2>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success">ADD</button>
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">CANCEL</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="product-info" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="text-primary">Product Information for this product!</h2>
                    <button type="button" data-dismiss="modal" class="close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h2>This is product info! and it is working!</h2>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success" data-dismiss="modal">OK</button>
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