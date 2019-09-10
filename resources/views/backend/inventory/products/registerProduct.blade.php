@extends('backend.inventory.master.inventoryMaster')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('backend.inventory.createproduct.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </div>
                        @endif
                        <h4 class="card-title mt-2 ml-2">New Raw Product</h4>
                        <div class="card-header container-fluid bg-warning py-2">
                            <p class="mb-0 text-white">Basic Product Information</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2">
                                <input type="file" name="image" class="dropify" data-default-file="/__backend/assets/images/avatars/default.png"
                                data-height="150">
                                </div>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="product_id">Product ID</label>
                                            <input type="text" class="form-control" name="product_id" id="product_id" placeholder="Product ID"
                                            value="{{old('product_id')}}">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="product_name">Product Name</label>
                                            <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Product Name"
                                            value="{{old('product_name')}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="category">Category</label>
                                            <select class="form-control" name="category" id="category">
                                                <option>Please Select a Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->category_id}}"
                                                        {{old('category') == $category->category_id ? 'selected' : ''}}>{{$category->category}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="supplier">Supplier</label>
                                            <select class="form-control" name="supplier" id="supplier">
                                                <option value="{{$supplier->supplier_id}}" selected>{{$supplier->company}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header container-fluid bg-success py-2">
                            <p class="mb-0 text-white">Other details</p>
                        </div>
                        <div class="card-body">
                            <div class="row mb-5">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white">₱</span>
                                            </div>
                                            <input type="text" class="form-control tooltiped-focus text-right" name="price" id="price" placeholder="Price"
                                            data-toggle="tooltip" data-title="This only allows 2 decimal digits" data-placement="top"
                                            value="{{old('price')}}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label for="height_label">Per</label>
                                        <select class="form-control-sm" name="unit">
                                            <option value="pc" {{old('width_label') == 'pc' ? 'selected' : ''}}>pc</option>
                                            <option value="kg" {{old('width_label') == 'kg' ? 'selected' : ''}}>kg</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="qty">Quantity</label>
                                        <input data-toggle="toolip" data-title="The materials will be multiplied by the
                                        quantity you want to produce"
                                        class="tooltipped-focus form-control text-right" data-placement="top"
                                        type="text" name="qty" id="qty" placeholder="Quantity"
                                        value="{{old('qty')}}" autocomplete="off" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="critical_amount">Critical Amount</label>
                                        <input class="form-control tooltipped-focus text-right" type="number" name="critical_amount" id="critical_amount"
                                        placeholder="Critical Amount" data-toggle="tooltip" data-title="Input the amount that will notify you that this is
                                        already on its critical level" data-placement="top" value="{{old('critical_amount')}}" autocomplete="off">    
                                    </div>    
                                </div>             
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="height">Height</label>
                                        <input type="text" class="form-control text-right" name="height" id="height" placeholder="Height"
                                        value="{{old('height')}}" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label for="height_label">Label</label>
                                        <select class="form-control-sm" name="height_label">
                                            <option value="ft" {{old('width_label') == 'ft' ? 'selected' : ''}}>ft</option>
                                            <option value="in" {{old('width_label') == 'in' ? 'selected' : ''}}>in</option>
                                            <option value="m" {{old('width_label') == 'm' ? 'selected' : ''}}>m</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="width">width</label>
                                        <input type="text" class="form-control text-right" name="width" id="width" placeholder="Width"
                                        value="{{old('width')}}" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label for="width_label">Label</label>
                                        <select class="form-control-sm" name="width_label">
                                            <option value="ft" {{old('width_label') == 'ft' ? 'selected' : ''}}>ft</option>
                                            <option value="in" {{old('width_label') == 'in' ? 'selected' : ''}}>in</option>
                                            <option value="m" {{old('width_label') == 'm' ? 'selected' : ''}}>m</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="weight">Weight</label>
                                        <input type="text" class="form-control text-right" name="weight" id="weight" placeholder="Weight"
                                        value="{{old('weight')}}" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label for="weight_label">Label</label>
                                        <select class="form-control-sm" name="weight_label">
                                            <option value="kg">kg</option>
                                            <option value="lbs">lbs</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header container-fluid bg-success py-2">
                            <p class="mb-0 text-white">Item Description</p>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="Submit" class="btn btn-inverse-success pull-right">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.dropify').dropify({
            tpl: {
                wrap:            '<div class="dropify-wrapper"></div>',
                loader:          '<div class="dropify-loader"></div>',
                message:         '<div class="dropify-message"><span class="file-icon" />Click or Drag an Image<p></p></div>',
                preview:         '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">Drag or click to replace</p></div></div></div>',
                filename:        '<p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>',
                clearButton:     '<button type="button" class="dropify-clear">remove</button>',
                errorLine:       '<p class="dropify-error"></p>',
                errorsContainer: '<div class="dropify-errors-container"><ul></ul></div>'
            }
        });
    </script>
@endsection