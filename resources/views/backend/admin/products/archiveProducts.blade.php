@extends('backend.admin.master.adminMaster')

@section('content')
    <div class="col-lg-12 grid-margin stretched-card">
        <div class="card">
            <div class="card-body">
                <a href="{{route('backend.admin.products.index')}}" class="btn btn-info pull-right">Go Back</a>
                <h4 class="card-title">Archive Products</h4>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead align="center">
                            <th>Product</th>
                            <th>Product ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
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
                                        <button class="btn btn-outline-warning btn-sm" data-target="#restore-product"
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
@endsection
@section('scripts')
    <script>
        $(".table").DataTable();
    </script>
@endsection