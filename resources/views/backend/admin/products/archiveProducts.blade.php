@extends('backend.admin.master.adminMaster')

@section('content')
    <div class="col-lg-12 grid-margin stretched-card">
        <div class="card">
            <div class="card-body">
                <a href="{{route('backend.admin.products.index')}}" class="btn btn-info pull-right">View Stocks</a>
                @if(Session::has('supplier_id'))
                <button class="btn btn-success mb-2 pull-right mr-2" type="button" data-supplier_id={{session::get('supplier_id')}}
                data-toggle="modal" data-target="#restore-supplier-modal" data-supplier_company={{session::get('supplier_company')}}
                >Restore Supplier</button>
                @endif
                @if(Session::has('category_id'))
                <button class="btn btn-success mb-2 pull-right mr-2" type="button" data-categoryid={{session::get('category_id')}}
                data-toggle="modal" data-target="#restore-supplier-modal" data-name={{session::get('category_name')}}
                >Restore Category</button>
                @endif
                <h4 class="card-title">Archive Products</h4>
                @if(Session::has('message'))
                    <div class="alert alert-{{
                    (session::get('message') == 'This Product Cannot be returned! Because the category is already deleted!')
                    || (session::get('message') == 'This Product Cannot be returned! Because the supplier is already deleted!') ? 
                    'danger' : 'success'}}">
                        <ul>
                            <li>{{session::get('message')}}</li>
                        </ul>
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead align="center">
                            <th>Image</th>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Supplier</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr align="center">
                                    <td class="py-1"><img src="/__backend/assets/images/products/{{$product->image}}"></td>
                                    <td>{{$product->product_id}}</td>
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->category->category}}</td>
                                    <td>{{$product->supplier->supplier}}</td>
                                    <td>
                                        <button class="btn btn-outline-warning btn-sm p-3" data-target="#restore-product"
                                        data-toggle="modal" data-product_id="{{$product->product_id}}">Restore</button>
                                    </td>                                    
                                </tr>
                            @endforeach       
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="restore-product" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-center modal-default">
            <form method="POST" action="{{route('backend.admin.products.restoreProduct')}}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" data-dismiss="modal" class="close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="product_id" id="product_id">
                        <h3 id="modal-message"></h3>
                    </div>
                    <div class="modal-footer">
                        <button id="submit" type="submit" class="btn btn-outline-success">RESTORE</button>
                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal">CANCEL</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
        <!-- Restore-Supplier -->
        <div class="modal fade" id="restore-supplier-modal" aria-hidden="true" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-default modal-center">
                    <form method="POST" action="{{route('backend.admin.suppliers.restore')}}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="supplier-id" name="supplier_id">
                                <h4 id="message"></h4>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success" type="submit">RESTORE</button>
                                <button class="btn btn-danger" type="button" data-dismiss="modal">CLOSE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <!-- End Restore-Supplier -->

        <!-- Restore Category -->

        <div class="modal fade" tabindex="-1" aria-hidden="true" id="restore-category">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Restore category</h5>
                            <button class="close" type="button" data-dismiss="modal">
                                <span>×</span>
                            </button>
                        </div>
                        <form method="POST" action="{{route('backend.admin.category.restore')}}">
                            @csrf
                            <div class="modal-body">
                                <div class="col-lg-12 form-group">
                                    <input type="hidden" name="category_id" id="category_id" class="form-control" placeholder="New category">
                                    <h4 id="message"></h4>
                                </div>                                
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Restore</button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    
        <!-- End Restore Category -->
@endsection
@section('scripts')
    <script>
        $(".table").DataTable();
    </script>
@endsection