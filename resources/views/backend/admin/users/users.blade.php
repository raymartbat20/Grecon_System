@extends('backend.admin.master.adminMaster')
@section('breadcrumbs')
    <nav aria-labelledby="breadcrumb">
        <ol class="breadcrumb bg-light">
            <li class="breadcrumb-item" style="font-size:20px;"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" style="font-size:20px;">Users</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Users Table</h4>

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Name</th>
                                <th>Contact Number</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="py-1"><img src="/__backend/assets/images/avatars/{{$user->image}}" alt="image"></td>
                                    <td>{{$user->getFullName()}}</td>
                                    <td>{{$user->number}}</td>
                                    <td>
                                        @switch($user->role->role)
                                            @case("ADMIN")
                                                <div class="badge badge-primary">
                                                    ADMIN
                                                </div>
                                                @break
                                            @case("CASHIER")
                                                <div class="badge badge-warning">
                                                    CASHIER
                                                </div>
                                                @break
                                            @case("MANAGER")
                                                <div class="badge badge-danger">
                                                    MANAGER
                                                </div>
                                                @break
                                            @default
                                            <div class="badge badge-info">
                                                INVENTORY
                                            </div>
                                        @endswitch
                                    </td>
                                    <td>
                                        <span class="tooltipped" data-toggle="tooltip" data-title="Edit User" data-placement="top">
                                            <button class="btn btn-rounded btn-icon btn-primary" data-toggle="modal"
                                                data-target="#edit-user" data-userid = "{{$user->user_id}}"
                                                data-firstname = "{{$user->firstname}}" data-lastname = "{{$user->lastname}}"
                                                data-number = "{{$user->number}}"
                                                data-role = "{{$user->role_id}}" data-image="{{$user->image}}">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </span>
                                        <span class="tooltipped" data-toggle="tooltip" data-title="Delete User" data-placement="top">
                                            <button class="btn btn-rounded btn-icon btn-danger" data-userid="{{$user->user_id}}"
                                                data-toggle="modal" data-target="#delete-user" data-name="{{$user->getFullName()}}"
                                                data-image={{$user->image}}>
                                                <i class="fa fa-archive"></i>
                                            </button>
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <ul class="pagination d-flex justify-content-center pagination-success">
                       {{$users->links()}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- modals -->
        <div class="modal fade" id="edit-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <img id="img-avatar" alt="profile" class="img-lg rounded-circle mb-3">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('backend.admin.users.update','user')}}">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" id="userid" name="userid">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="firstname">Firstname</label>
                                <input name="firstname" type="text" class="form-control" id="firstname" placeholder="Firstname" readonly>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="lastname">Lastname</label>
                                <input name="lastname" type="text" class="form-control" id="lastname" placeholder="Lastname" readonly>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="form-group col-lg-6">
                            <label for="number">Contact Number</label>
                            <input name="number" type="integer" class="form-control" id="number" placeholder="Contact Number">
                            </div>

                            <div class="form-group col-lg-6">
                                <label for="role">Role</label>
                                <select class="form-control form-control-sm" name="role_id">
                                    @foreach ($roles as $role)
                                        <option id="role" value="{{$role->role_id}}">{{$role->role}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="delete-user" tabindex="-1" aria-hidden="true">
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
                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete">Delete</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="modal fade" id="confirm-delete" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{route('backend.admin.users.destroy','delete')}}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title">Insert your password to confirm</h5>
                            <button type="button" data-dismiss="modal" class="close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="myid" id="myid">
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
    <!-- End modals -->
@endsection
@section('scripts')
    <script type="text/javascript" src="/__backend/assets/js/myjs/myModals.js"></script>
    <script>
        $('.tooltipped').tooltip({
            trigger: "hover",
        });
    </script>
@endsection 