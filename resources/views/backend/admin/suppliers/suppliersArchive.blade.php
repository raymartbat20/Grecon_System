@extends('backend.admin.master.adminMaster')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <a class="btn btn-primary btn-sm pull-right mb-2" href="{{url('/admin/suppliers')}}">Active Suppliers</a>
                <h3 class="card-title" style="font-weight:bold; font-size:12;">Archive Suppliers</h3>
                <div class="table-responsive">
                    <table class="table table-hover">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </div>
                        @endif
                        @if (Session::has('message'))
                            @if(Session::get('message') == "one of the email or number should have a value!")
                                <div class="alert alert-danger">
                                    <li>{{Session::get('message')}}</li>
                                </div>
                            @endif
                        @endif
                        <thead>
                            <th>Supplier</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Number</th>
                            <th>Company</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @if($suppliers->count() == 0)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>--No Record Yet--</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endif
                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td class="py-1"><img src="/__backend/assets/images/suppliers/{{$supplier->image}}"></td>
                                    <td>{{$supplier->getFullName()}}</td>
                                    <td>{{$supplier->email}}</td>
                                    <td>{{$supplier->number}}</td>
                                    <td>{{$supplier->company}}</td>
                                    <td>
                                        <button class="btn btn-outline-success p-2" data-toggle="modal" data-target="#restore-supplier-modal"
                                            data-supplier_id="{{$supplier->supplier_id}}" data-supplier_company="{{$supplier->company}}">                                                
                                            Restore
                                        </button>
                                    </td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
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
@endsection
@section('scripts')
    <script>
        $(".table").dataTable();
    </script>
@endsection