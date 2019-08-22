@extends('backend.admin.master.adminMaster')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card mb-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-3">Stock logs for {{$product_name}}</h4>
                @if ($addStocks->count() != 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <th>Product ID</th>
                                <th>Product name</th>
                                <th>number of added</th>
                                <th>User</th>
                                <th>Date</th>
                            </thead>
                            <tbody>
                                @foreach ($addStocks as $stock)
                                <tr>
                                    <td>{{$stock->product->product_id}}</td>
                                    <td>{{$stock->product->product_name}}</td>
                                    <td>{{$stock->add_qty}}</td>
                                    <td>{{$stock->user->getFullName()}}</td>
                                    <td>{{$stock->created_at->format('Y-m-d')}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h5 class="text-center">No Record Yet</h5>
                @endif
                
            </div>
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Defective logs for {{$product_name}}</h4>
                @if ($defectives->count() != 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <th>Product ID</th>
                                <th>Product name</th>
                                <th>number of defective</th>
                                <th>Description</th>
                                <th>User</th>
                                <th>Date</th>
                            </thead>
                            <tbody>
                                @foreach ($defectives as $defective)
                                    <tr>
                                        <td>{{$defective->product->product_id}}</td>
                                        <td>{{$defective->product->product_name}}</td>
                                        <td>{{$defective->defectives_qty}}</td>
                                        <td>{{$defective->description}}</td>
                                        <td>{{$defective->user->getFullName()}}</td>
                                        <td>{{$defective->created_at->format('Y-m-d')}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <h5 class="text-center">No Record Yet</h5>
                @endif
                
            </div>
        </div>
    </div>
@endsection