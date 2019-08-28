@extends('backend.admin.master.adminMaster')
@section('content')
<div class="col-lg-12">
        <div class="card px-2">
            <div class="card-body">
                <div class="container-fluid">
                  <h3 class="text-right my-5">Invoice&nbsp;&nbsp;#INV-17</h3>
                  <hr>
                </div>
                <div class="container-fluid d-flex justify-content-between">
                  <div class="col-lg-3 pl-0">
                    <p class="mt-5 mb-2"><b>Grecon</b></p>
                    <p>104,<br>Minare SK,<br>Canada, K1A 0G9.</p>
                  </div>
                  <div class="col-lg-3 pr-0">
                    <p class="mt-5 mb-2 text-right"><b>Invoice to</b></p>
                    <p class="text-right">{{$customer->name}},<br>{{$customer->address}}.</p>
                  </div>
                </div>
                <div class="container-fluid d-flex justify-content-between">
                  <div class="col-lg-3 pl-0">
                    <p class="mb-0 mt-5">Invoice Date : {{$customer->created_at->format('d M Y')}}</p>
                  </div>
                </div>
                <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                  <div class="table-responsive w-100">
                      <table class="table">
                        <thead>
                          <tr class="bg-dark text-black">
                              <th>#</th>
                              <th>Item Name</th>
                              <th class="text-right">Quantity</th>
                              <th class="text-right">Unit cost</th>
                              <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $key => $item)
                                <tr class="text-right">
                                    <td class="text-left">{{$loop->iteration}}</td>
                                    <td class="text-left">{{$item['item']['product_name']}}</td>
                                    <td>{{$item['qty']}}</td>
                                    <td>{{$item['item']['price']}}</td>
                                    <td>{{$item['price']}}</td>
                                </tr>
                            @endforeach                    
                        </tbody>
                      </table>
                    </div>
                </div>
                <div class="container-fluid mt-5 w-100">
                    <p class="text-right mb-2">Sub-total {{$customer->original_price}}</p>
                    <p class="text-right">Discount: {{$customer->discount}}</p>
                    <h4 class="text-right mb-5">Total : {{$customer->total}}</h4>
                  <hr>
                </div>
                <div class="container-fluid w-100">
                  <button type="button" id="print" class="btn btn-outline-danger">Print</button>
                  <a href="{{route('backend.admin.transaction.printInvoice',[$customer->customer_id])}}" target="_blank" class="btn btn-primary float-right mt-4 ml-2"><i class="mdi mdi-printer mr-1"></i>Print</a>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
      $("#print").on("click",function(){
        $.print(".card");
      });
    </script>
@endsection