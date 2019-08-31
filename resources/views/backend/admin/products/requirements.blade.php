@extends('backend.admin.master.adminMaster')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <form method="POST" action="{{route('backend.admin.products.requirementsStore')}}">
                @csrf
                <input type="hidden" name="product_id" value="{{$product_id}}">
                <input type="hidden" name="adding_qty" value="{{$adding_stocks}}">
                <div class="card-body">
                    <h4 class="card-title">Materials need to add the stock(s) request</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>stocks</th>
                                <th>Qty need per piece</th>
                                <th>Overall need</th>
                                <th>status</th>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{$item['item']['product_id']}}</td>
                                        <td>{{$item['item']['product_name']}}</td>
                                        <td>{{$item['item']['qty']}}</td>
                                        <td>{{$item['qty']}}</td>
                                        <td>{{$item['qty'] * $adding_stocks}}</td>
                                        <td>{{$item['item']['status']}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button class="btn btn-outline-success pull-right mt-2" type="submit">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection