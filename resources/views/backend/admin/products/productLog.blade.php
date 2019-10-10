@extends('backend.admin.master.adminMaster')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card mb-5">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-3 text-success">Stock logs for {{$product_name}}</h4>
                @if ($addStocks->count() != 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <th>number of added</th>
                                <th>User</th>
                                <th>Date</th>
                            </thead>
                            <tbody>
                                @foreach ($addStocks as $stock)
                                <tr>
                                    <td>{{$stock->qty}}</td>
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
                <h4 class="card-title text-danger">Defective logs for {{$product_name}}</h4>
                @if ($defectives->count() != 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <th>number of defective</th>
                                <th>Description</th>
                                <th>User</th>
                                <th>Date</th>
                            </thead>
                            <tbody>
                                @foreach ($defectives as $defective)
                                    <tr>
                                        <td>{{$defective->qty}}</td>
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
    <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-primary">Used as material logs</h4>
                    @if ($materials->count() != 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <th>number of defective</th>
                                    <th>Description</th>
                                    <th>User</th>
                                    <th>Date</th>
                                </thead>
                                <tbody>
                                    @foreach ($materials as $material)
                                        <tr>
                                            <td>{{$material->qty}}</td>
                                            <td>{{$material->description}}</td>
                                            <td>{{$material->user->getFullName()}}</td>
                                            <td>{{$material->created_at->format('Y-m-d')}}</td>
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