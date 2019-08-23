@extends('backend.admin.master.adminMaster')
@section('styles')
    <style>
       p{
            font-weight: bold;
            color: blueviolet;
        }
    </style>
@endsection
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">This is the shopping cart</h1>
            </div>
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">Your Orders: </h1>
                <div class="table-responsive">
                    <table class="table table-hover">
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
                                    <td>{{$item['item']['price']}}</td>
                                    <td>{{$item['qty']}}</td>
                                    <td align="right">{{$item['price']}}</td>
                                    <td>
                                        <button class="btn btn-rounded-success btn-icon"><i class="fa fa-pencil"></i></button>
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
                                <td style="font-weight:bold;">Total Quantity:
                                <td align="right" style="font-weight:bold;" id="totalQty">
                                    {{$totalQty}}
                                </td>
                                <td></td>
                            </tr>
                            <tr class="table-success">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="font-weight:bold;">Sub Total:</td>
                                <td align="right" style="font-weight:bold;">
                                    {{$totalPrice}}
                                </td>
                                <td></td>
                            </tr>
                            <tr class="table-success">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="font-weight:bold;">Discount:</td>
                                <td align="right" style="font-weight:bold;">
                                    <input type="text" class="form-control form-control-sm text-right" name="discount" id="discount">
                                </td>
                                <td></td>
                            </tr>
                            <tr class="table-success">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td style="font-weight:bold;">Total:</td>
                                <td id="total" align="right" style="font-weight:bold;">
                                    
                                </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $("#total").text({{$totalPrice}});
        $("#discount").on("change",function(){
            var trueTotal = {{$totalPrice}} - $(this).val();
            $("#total").text(trueTotal);
        });
    </script>
@endsection