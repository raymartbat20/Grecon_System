@extends('backend.admin.master.adminMaster')
@section('breadcrumbs')
    <nav aria-labelledby="breadcrumb">
        <ol class="breadcrumb bg-primary">
            <li class="breadcrumb-item" style="font-size:20px;"><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" style="font-size:20px;">Suppliers</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <a class="btn btn-primary btn-sm pull-right mb-2" href="{{url('/admin/suppliers/create')}}"><i class="icon icon-user-follow"></i></a>
                <h3 class="card-title" style="font-weight:bold; font-size:12;">Suppliers</h3>
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
                            @foreach ($suppliers as $supplier)
                                <tr>
                                    <td class="py-1"><img src="/__backend/assets/images/suppliers/{{$supplier->image}}"></td>
                                    <td>{{$supplier->getFullName()}}</td>
                                    <td>{{$supplier->email}}</td>
                                    <td>{{$supplier->number}}</td>
                                    <td>{{$supplier->company}}</td>
                                    <td>
                                        <span class="tooltipped" data-toggle="tooltip" data-title="Edit User" data-placement="top">
                                            <button class="btn btn-outline-primary" data-toggle="modal" data-target="#edit-supplier"
                                                data-supplierid="{{$supplier->supplier_id}}" data-firstname="{{$supplier->firstname}}" data-lastname="{{$supplier->lastname}}"
                                                data-email="{{$supplier->email}}" data-number="{{$supplier->number}}" data-company="{{$supplier->company}}"
                                                data-image="{{$supplier->image}}">                                                
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </span>
                                        @if($supplier->company != 'Grecon')
                                            <span class="tooltipped" data-toggle="tooltip" data-title="Delete User" data-placement="top">
                                                <button class="btn btn-outline-warning" data-toggle="modal" data-target="#delete-supplier"
                                                    data-supplierid="{{$supplier->supplier_id}}" data-name="{{$supplier->getFullName()}}"
                                                    data-image="{{$supplier->image}}">
                                                    <i class="fa fa-archive"></i>
                                                </button>
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="edit-supplier" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <img id="image-avatar" alt="profile" class="img-lg rounded-circle">
                    <h4 class="modal-title">Edit Supplier</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" action="{{route('backend.admin.suppliers.update','test')}}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <input type="hidden" id="supplier_id" name="supplier_id">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control" placeholder="First Name"
                                     name="firstname" id="firstname">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" placeholder="Last Name"
                                     name="lastname" id="lastname">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" placeholder="--No Email--"
                                     name="email" id="email">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="number">Contact Number</label>
                                <input type="number" class="form-control" placeholder="--No Number--"
                                     name="number" id="number">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="company">Company</label>
                                <input type="text" class="form-control" placeholder="Company"
                                     name="company" id="company">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="image">Change Picture</label>
                                <input type="file" name="image" class="file-upload-default" id="image">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" id="image-name" disabled="" placeholder="Upload Image">
                                    <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button" id="upload-btn">Change Picture</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-inverse-success">Update</button>
                        <button type="button" data-dismiss="modal" class="btn btn-inverse-warning">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-supplier" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <img id="img-avatar" alt="profile" class="img-lg rounded-circle mb-3">
                            <h5 class="modal-title"></h5>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete-supplier">Delete</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
                
            </div>
        </div>

    <div class="modal fade" id="confirm-delete-supplier" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{route('backend.admin.suppliers.destroy','delete')}}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title">Insert your password to confirm</h5>
                            <button type="button" data-dismiss="modal" class="close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="supplier_id" id="supplierid">
                            <label for="password">Enter your Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
@section('scripts')
    <script>
        $(".table").dataTable();
    </script>
@endsection