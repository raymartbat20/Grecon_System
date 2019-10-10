@extends('backend.admin.master.adminMaster')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @if (Session::has('message'))
                    <div class="alert alert-danger">
                        <li>{{Session::get('message')}}</li>
                    </div>
                @endif
                <form method="POST" action="{{route('backend.admin.products.update', $product->product_id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="card">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </div>
                        @endif
                        <div class="col-lg-12">
                            <div class="pull-right">
                                <button type="button" class="btn btn-info btn-sm mt-3"
                                data-toggle="modal" data-target="#add-stocks" data-product_id={{$product->product_id}}
                                data-product_name={{$product->product_name}}>Add Stocks</button>
                                <button type="button" class="btn btn-info mt-3 btn-sm"
                                data-toggle="modal" data-target="#remove-defectives" data-product_id={{$product->product_id}}
                                data-product_name={{$product->product_name}}>Remove Defectives</button>
                                <button type="button" class="btn btn-info mt-3 btn-sm"
                                data-toggle="modal" data-target="#delete-product" data-product_id={{$product->product_id}}
                                data-product_name={{$product->product_name}}>Archive This Product</button>
                            </div>
                            <h4 class="card-title mt-2 ml-2">Edit Product</h4>
                        </div>
                        <div class="card-header container-fluid bg-warning py-2">
                            <p class="mb-0 text-white">Basic Product Information</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2">
                                <input type="file" name="image" class="dropify" data-default-file="/__backend/assets/images/products/{{$product->image}}"
                                data-height="150">
                                </div>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="product_id">Product ID</label>
                                            <input type="text" class="form-control"
                                            value="{{$product->product_id}}" name="product_id">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="product_name">Product Name</label>
                                            <input type="text" class="form-control" name="product_name" id="product_name"
                                            value="{{$product->product_name}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="category">Category</label>
                                            <select class="form-control" name="category" id="category">
                                                @foreach ($categories as $category)
                                                    <option value="{{$category->category_id}}"
                                                        {{$product->category_id == $category->category_id ? 'selected' : ''}}>{{$category->category}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="supplier">Supplier</label>
                                            <select class="form-control" name="supplier" id="supplier">
                                                <option>Please select a supplier</option>
                                                @foreach ($suppliers as $supplier)
                                                    <option value="{{$supplier->supplier_id}}"
                                                        {{$product->supplier_id == $supplier->supplier_id ? 'selected' : ''}}>{{$supplier->company}}</option>
                                                @endforeach
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
                                            <input type="text" class="form-control tooltiped-focus text-right" name="price" id="price"
                                            data-toggle="tooltip" data-title="This only allows 2 decimal digits" data-placement="top" value="{{$product->price}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label for="height_label">Per</label>
                                        <select class="form-control-sm" name="unit">
                                            <option value="pc" {{$product->unit == 'pc' ? 'selected' : ''}}>pc</option>
                                            <option value="kg" {{$product->unit == 'kg' ? 'selected' : ''}}>kg</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="qty">Stocks</label>
                                        <input class="form-control text-right" type="text" name="qty" id="qty"value="{{$product->qty}} {{$product->unit}}" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="critical_amount">Minimun amount to notify</label>
                                        <input class="form-control tooltipped-focus text-right" type="number" name="critical_amount" id="critical_amount"
                                        data-toggle="tooltip" data-title="Input the amount that will notify you that this is
                                        already on its critical level" data-placement="top" value="{{$product->critical_amount}}">    
                                    </div>                  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="height">Height</label>
                                        <input type="number" class="form-control text-right" name="height" id="height" placeholder="Height" value="{{$product->height}}">
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label for="height_label">Label</label>
                                        <select class="form-control-sm" name="height_label">
                                            <option value="ft" {{$product->height_label == "ft" ? 'Selected' : ''}}>ft</option>
                                            <option value="in" {{$product->height_label == "in" ? 'Selected' : ''}}>in</option>
                                            <option value="m" {{$product->height_label == "m" ? 'Selected' : ''}}>m</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="width">width</label>
                                        <input type="number" class="form-control text-right" name="width" id="width" placeholder="Width" value="{{$product->width}}">
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label for="width_label">Label</label>
                                        <select class="form-control-sm" name="width_label">
                                            <option value="ft" {{$product->width_label == "ft" ? 'Selected' : ''}}>ft</option>
                                            <option value="in" {{$product->width_label == "in" ? 'Selected' : ''}}>in</option>
                                            <option value="m" {{$product->width_label == "m" ? 'Selected' : ''}}>m</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="weight">Weight</label>
                                        <input type="number" class="form-control text-right" name="weight" id="weight" placeholder="Weight" value="{{$product->weight}}">
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-group">
                                        <label for="weight_label">Label</label>
                                        <select class="form-control-sm" name="weight_label">
                                            <option value="kg" {{$product->weight_label == "kg" ? 'Selected' : ''}}>kg</option>
                                            <option value="lbs"{{$product->weight_label == "lbs" ? 'Selected' : ''}}>lbs</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="status" id="status">
                                            @foreach ($status as $stat)
                                                <option value="{{$stat}}" {{$product->status == $stat ? 'selected' : ''}}>{{$stat}}</option>
                                            @endforeach
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
                                    <textarea class="form-control" name="description" id="description" rows="5">{{$product->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="Submit" class="btn btn-success pull-right">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modals -->
        <!-- Add-stock -->
            <div class="modal fade" id="add-stocks" aria-hidden="true" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-default modal-center">
                    <form method="POST" action="{{route('backend.admin.products.addStocks')}}">
                        @csrf
                        @method('PATCH')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="product_id" name="product_id">
                                <div class="form-group">
                                    <label for="added_stocks">Stocks to be added</label>
                                    <input type="number" class="form-control" name="added_stocks" id="added_stocks" placeholder="Add Stocks">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success" type="submit">ADD</button>
                                <button class="btn btn-danger" type="button" data-dismiss="modal">CLOSE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <!-- End Add-stock -->

        <!-- Remove-Defectives -->
            <div class="modal fade" id="remove-defectives" role="dialog" aria-hidden="true" tabindex="-1">
                <div class="modal-dialog modal-default modal-center">
                    <div class="modal-content">
                        <form method="POST" action="{{route('backend.admin.products.removeDefectives')}}">
                            @csrf
                            @method('PATCH')
                            <div class="modal-header">
                                <h5 class="modal-title">Remove Defective Products</h5>
                                <button type="button" data-dismiss="modal" class="close">
                                <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="remove_product_id" name="product_id">
                                <div class="form-group">
                                    <label for="defectiveProducts">Item count to be remove</label>
                                    <input type="text" name="defectiveProducts" id="defectiveProducts" class="form-control"
                                    placeholder="Defective Products to be remove">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" name="description" id="defective_description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success" type="submit">REMOVE</button>
                                <button class="btn btn-danger" type="button" data-dismiss="modal">CLOSE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <!-- End Remove-Defectives -->


        <!-- Delete-Product -->
            <div class="modal fade" id="delete-product" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-default modal-center">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button class="close" type="button" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5 class="text-center">Add to archive products {{$product->product_name}}?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#password-confirm"
                            data-dismiss="modal">ARCHIVE</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">CLOSE</button>
                        </div>
                    </div>
                </div>
            </div>
        <!-- End Delete-Product -->

        <!-- Password Confirmation modal -->
            <div class="modal fade" id="password-confirm" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-default modal-center">
                    <form method="POST" action="{{route('backend.admin.products.destroy',$product->product_id)}}">
                    @csrf
                    @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" type="button" data-dismiss="modal">
                                <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="password_confirm">Input your password to delete</label>
                                    <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Password">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success" type="submit">SUBMIT</button>
                                <button class="btn btn-danger" type="button" data-dismiss="modal">CANCEL</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <!-- Password Confirmation modal -->

    <!-- End modals -->
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