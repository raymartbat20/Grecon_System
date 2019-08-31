@extends('backend.cashier.master.cashierMaster')
@section('styles')
    <style>
       p{
            font-weight: bold;
            color: blueviolet;
        }
    </style>
@endsection
@section('content')
    {{-- <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <a href="{{url('backend.cashier.transactions.index')}}" class="btn btn-info pull-right">Add Items</a>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <a href="{{route('backend.cashier.transaction.index')}}" class="btn btn-info pull-right">Add Items</a>                 
                <h1 class="card-title">Your Orders: </h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Basic Price</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{$item['item']['product_id']}}</td>
                                    <td>{{$item['item']['product_name']}}</td>
                                    <td>{{$item['item']['price']}} per {{$item['item']['unit'] == "pc" ? "pc(s)" : "kg(s)"}}</td>
                                    <td>{{$item['qty']}} {{$item['item']['unit'] == "pc" ? "pc(s)" : "kg(s)"}}</td>
                                    <td align="right">{{$item['price']}}</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-success btn-rounded btn-icon"
                                        data-toggle="modal" data-target="#reduce-qty" data-product_id="{{$item['item']['product_id']}}"><i class="fa fa-minus"></i></button>
                                        <button type="button" class="btn btn-outline-danger btn-rounded btn-icon"
                                        data-toggle="modal" data-target="#remove-item" data-product_id="{{$item['item']['product_id']}}"><i class="fa fa-archive"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td>--End of Items--</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="table-success">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="font-weight:bold;">Total Price:</td>
                                <td align="right" style="font-weight:bold;">
                                    {{$totalPrice}}
                                </td>
                                <td></td>
                            </tr>
                            <tr class="table-success">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="font-weight:bold;">Total Quantity:
                                <td align="right" style="font-weight:bold;" id="totalQty">
                                    {{$totalQty}}
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group mt-3">
                        @if ($totalQty != 0)
                            <a href="{{route('backend.cashier.ordercart.checkout')}}" class="btn btn-outline-success pull-right">CHECK OUT</a>
                        @else
                            <button class="btn btn-outline-success pull-right" type="button" disabled>CHECK OUT</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" tabindex="-1" id="reduce-qty" aria-hidden="true">
        <div class="modal-dialog modal-center modal-default">
            <form method="GET" action="{{route('backend.cashier.ordercart.reduceqty')}}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reduce Qty</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="product_id"  id="product_id">
                        <div class="form-group">
                            <label for="reduce_qty">Quantity to be remove</label>
                            <input type="text" id="reduce_qty" name="reduce_qty" placeholder="reduce quantiy" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-success btn-sm" type="submit">REMOVE</button>
                        <button class="btn btn-outline-danger btn-sm" type="button" data-dismiss="modal">CANCEL</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="remove-item" aria-hidden="true">
        <div class="modal-dialog modal-default modal-center">
            <form method="GET" action="{{route('backend.cashier.ordercart.removeitem')}}">
                <div class="modal-content">
                    <div class="modal header">
                        <h5 class="modal-title">Remove item?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="product_id" id="product_id_remove">
                        <h5>Are you sure you want to remove this item?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-success btn-sm">REMOVE</button>
                        <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">CANCEL</button>                    
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End modal -->
@endsection
@section('scripts')
    <script>
        $("#discount").on("change",function(){
            var trueTotal = {{$totalPrice}} - $(this).val();
            $("#total").text(trueTotal);
        });
    </script>
@endsection