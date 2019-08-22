@extends('backend.admin.master.adminMaster')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-lg-6">
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-9">
                                <div class="form-group">
                                    <label for="search">Search</label>
                                    <input type="text" name="search" class="form-control" placeholder="Search Product" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-3">
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
                                        <li>height: {{$product->height}}{{$product->height_label}}</li>
                                        <li>width: {{$product->width}}{{$product->width_label}}</li>
                                        <li>weight: {{$product->weight}}{{$product->weight_label}}</li>
                                        <li>stocks: {{$product->qty}}</li>
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
                                        <a href="#" class="btn btn-outline-primary btn-block">Add</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>  
                @endforeach                     
            </div>
        </div>
    </div>
@endsection