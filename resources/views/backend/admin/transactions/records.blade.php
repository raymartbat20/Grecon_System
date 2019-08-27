@extends('backend.admin.master.adminMaster')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <th>Name</th>
                            <th>Original Total</th>
                            <th>Discount</th>
                            <th>Total Purchase</th>
                            <th>Date</th>
                            <th>Receipt</th>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{$customer->name}}</td>
                                    <td>{{$customer->original_price}}</td>
                                    <td>{{$customer->discount}}</td>
                                    <td>{{$customer->total}}</td>
                                    <td>{{$customer->created_at->format('M/d/Y')}}</td>   
                                    <td>
                                        <form method="GET" action="{{route('backend.admin.transaction.show',[$customer->customer_id])}}">
                                            <button type="submit" class="btn btn-icon btn-rounded btn-warning"><i class="fa fa-print"></i></button>
                                        </form>    
                                    </td>                                 
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection 