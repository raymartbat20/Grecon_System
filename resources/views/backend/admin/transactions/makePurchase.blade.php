@extends('backend.admin.master.adminMaster')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Number of items</label>
                                    <a href="{{url('/admin/cart/cart_items')}}" class="btn btn-outline-info btn-sm form-control">Orders: 
                                        <span class="badge badge-pill badge-danger" >{{ Session::has('cart') ? 
                                        Session::get('cart')->totalQty : '' }}</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="search">Search</label>
                                    <input type="text" name="search" class="form-control" placeholder="Search Product" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label></label>

                                    <button type="submit" class="btn btn-inverse-info form-control">SEARCH</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @if (Session::has('message'))
                    @if (Session::get('message') == "Please add some item first")
                        <div class="alert alert-danger">
                            <li>{{Session::get('message')}}</li>
                        </div> 
                    @endif            
                @endif
                @foreach ($products->chunk(3) as $productChunk)
                    <div class="row pricing-table">
                        @foreach ($productChunk as $product)
                            <div class="col-md-4 grid-margin stretch-card pricing-card">
                                <div class="card border-primary border pricing-card-body">
                                    <div class="text-center pricing-card-head">
                                        <h3>{{$product->product_name}}</h3>
                                        <div class="product-item mb-2">
                                            <img class="card-img" src="/__backend/assets/images/products/{{$product->image}}">
                                        </div>
                                        <h1 class="font-weight-normal mb-4">Price: ₱{{$product->price}}</h1>
                                    </div>
                                    <ul class="list-unstyled plan-features">
                                        {{-- <li>height: {{$product->height}}{{$product->height_label}}</li> --}}
                                        {{-- <li>width: {{$product->width}}{{$product->width_label}}</li> --}}
                                        {{-- <li>weight: {{$product->weight}}{{$product->weight_label}}</li> --}}
                                        <li>stocks: {{$product->qty}}</li>
                                        <li>Category: {{$product->category->category}}</li>
                                        <li>status: 
                                            @switch($product->status)
                                                @case("AVAILABLE")
                                                <div class="badge badge-primary badge-pill">{{$product->status}}</div>                                                    
                                                    @break
                                                @case("UNAVAILABLE")
                                                <div class="badge badge-danger badge-pill">{{$product->status}}</div>                                                                                                        
                                                    @break
                                                @case("OUT OF STOCK")
                                                <div class="bad badge-info badge-pill">{{$product->status}}</div>
                                                @case("RESERVE")
                                                <div class="badge badge-primary badge-pill">{{$product->status}}</div>
                                                @default
                                                <div class="bad badge-warning badge-pill">NO STATUS</div>                                                    
                                            @endswitch
                                        </li>
                                        <li>Supplier: {{$product->supplier->company}}</li>
                                    </ul>
                                    <div class="wrapper">
<<<<<<< HEAD
                                        <button class="btn btn-outline-primary btn-block" 
                                        {{$product->status != "AVAILABLE" ? 'disabled' : ''}}>Add</button>
=======
                                        <button class="btn btn-outline-primary btn-block" {{$product->status != "AVAILABLE" ? 'disabled' : ''}}
                                            data-toggle="modal" data-target="#add-qty" data-product_id={{$product->primary_product_id}}
                                            data-product_qty="{{$product->qty}}">Add</button>
>>>>>>> b788a2b6f2ced7e43b32bc9194834da9ea9b52a2
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>  
                @endforeach                     
            </div>
        </div>
    </div>
    <!-- modal -->
        <div class="modal fade" id="add-qty" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-center modal-default">
                <form method="GET" action="{{route('backend.admin.ordercart.addToCart')}}" id="#add-form">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Quanity</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="product_id" id="product_id">
                            <div class="form-group">
                                <label for="qty">Quantity</label>
                                <input type="number" name="qty" id="qty" placeholder="Quantity" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-success" type="submit" id="submit">ADD</button>
                            <button class="btn btn-outline-danger" data-dismiss="modal" type="button">CANCEL</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="modal-warning" tabindex="-1">
            <div class="modal-dialog modal-small modal-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span ari{a-hidden="true">×</span>
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
    <!-- end modal -->
@endsection