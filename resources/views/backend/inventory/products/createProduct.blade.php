@extends('backend.inventory.master.inventoryMaster')
    <style>
        .image-container{
            max-width: 150px;
            max-height: 120px;
        }
    </style>
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <a href="{{url('/inventory_clerk/createProduct/materials')}}">
                    <button type="button" class="btn btn-primary pull-right mb-2">Materials: 
                    <span class="badge badge-pill badge-danger" >{{ Session::has('materials') ? 
                    Session::get('materials')->totalQty : '' }}</span>
                    </button>       
                </a>
                <h4 class="card-title text-warning">Select materials to be used</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </div>
                @endif
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
                                    <td>{{$product->qty}}{{$product->unit}}(s)</td>
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
                                        <button data-toggle="modal" data-target="{{$product->unit == "pc" ? "#createProduct-material-pc" : "#createProduct-material-kilo"}}" class="btn btn-outline-success btn-sm"
                                        data-product_id="{{$product->product_id}}" 
                                        data-product_qty="{{$product->qty}}" {{$product->status != "AVAILABLE" ? 'disabled' : ''}}>Add</button>


                                        <button data-toggle="modal" data-target="#product-info" class="btn btn-outline-info btn-sm"
                                        data-product_id="{{$product->product_id}}" data-product_image="{{$product->image}}"
                                        data-product_name="{{$product->product_name}}" data-product_height="{{$product->height}}"
                                        data-product_hlabel="{{$product->height_label}}" data-product_qty="{{$product->qty}}"
                                        data-product_welabel="{{$product->weight_label}}"
                                        data-product_width="{{$product->width}}" data-product_wlabel="{{$product->width_label}}"
                                        data-product_supplier="{{$product->supplier->company}}" data-product_description="{{$product->description}}"
                                        data-product_unit="{{$product->unit}}">Info</button>
                                    </td>                                    
                                </tr>
                            @endforeach       
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- per pc Modal -->
    <div class="modal fade" tabindex="-1" id="createProduct-material-pc" aria-hidden="true">
        <div class="modal-dialog modal-default modal-center">
            <form method="GET" action="{{route('backend.inventory.createproduct.addMaterial')}}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Material</h4>
                        <button type="button" data-dismiss="modal" class="close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="product_id" id="product_id">
                        <div class="form-group">
                            <label for="qty">Add Quantity by pc</label>
                            <input type="text" class="form-control" name="qty" id="qty" placeholder="Quantity" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="submit" type="submit" class="btn btn-outline-success">ADD</button>
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">CANCEL</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End per pc Modal -->

    <!-- per kg Modal -->
        <div class="modal fade" tabindex="-1" id="createProduct-material-kilo" aria-hidden="true">
            <div class="modal-dialog modal-default modal-center">
                <form method="GET" action="{{route('backend.inventory.createproduct.addMaterial')}}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Material</h4>
                            <button type="button" data-dismiss="modal" class="close">
                            <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="product_id" id="product_id">
                            <div class="form-group">
                                <label for="qty">Add Quantity by kilo</label>
                                <input type="text" class="form-control" name="qty" id="qty" placeholder="Quantity" autocomplete="off">
                            </div>
                            <p class="text-success">This is supported only by decimal value</p>
                        </div>
                        <div class="modal-footer">
                            <button id="submit" type="submit" class="btn btn-outline-success">ADD</button>
                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">CANCEL</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <!-- End per kg Modal -->

    <div class="modal fade" tabindex="-1" id="product-info" aria-hidden="true">
        <div class="modal-dialog modal-default">  
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="text-primary" id="#product-info-title"></h2>
                    <button type="button" data-dismiss="modal" class="close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-warning" tabindex="-1">
        <div class="modal-dialog modal-small modal-center">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Not Enought Stocks</h3>
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