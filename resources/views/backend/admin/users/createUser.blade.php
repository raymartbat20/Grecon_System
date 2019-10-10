@extends('backend.admin.master.adminMaster')
@section('breadcrumbs')
    <nav aria-labelledby="breadcrumb">
        <ol class="breadcrumb bg-light">
            <li class="breadcrumb-item" style="font-size:20px;"><a href="{{url('admin/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item" style="font-size:20px;"><a href="{{url('admin/users')}}">Users</a></li>
            <li class="breadcrumb-item active" style="font-size:20px;">Create User</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card fixed">
        <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger" role="alert">
                  @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                  @endforeach
              </div>
            @endif
            <p class="card-description">
              Create New User
            </p>
          <form method="post" action="{{route('backend.admin.users.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-lg-6">
                    <label for="firstname">First name</label>
                  <input name="firstname" type="text" class="form-control" id="firstname" placeholder="Firstname" value="{{old('firstname')}}"
                  autocomplete="off">
                </div>
                <div class="form-group col-lg-6">
                  <label for="lastname">Last name</label>
                  <input name="lastname" type="text" class="form-control" id="lastname" placeholder="Lastname" 
                  autocomplete="off" value="{{old('lastname')}}">
                </div>
            </div>

            <div class="row">
              <div class="form-group col-lg-6">
                <label for="username">Username</label>
                <input name="username" type="text" class="form-control" id="username" placeholder="Username" 
                autocomplete="off" value="{{old('username')}}">
              </div>  
              <div class="form-group col-lg-6">
                <label for="number">Contact Number</label>
                <input name="number" type="integer" class="form-control" id="number" 
                autocomplete="off" placeholder="Contact Number" value="{{old('number')}}">
              </div>
            </div>
            
            <div class="row">
              <div class="form-group col-lg-6">
                <label for="Password">Password</label>
                <input name="password" type="password" class="form-control tooltipped-focus" id="Password" 
                autocomplete="off" placeholder="Password"
                data-toggle="tooltip" data-title="Minimum length is 5">
              </div>
  
              <div class="form-group col-lg-6">
                <label for="ConfirmPassword">Confirm Password</label>
                <input name="confirm_password" type="password" class="form-control" id="ConfirmPassword" 
                autocomplete="off" placeholder="Confirm Password">
              </div>
            </div>
            
            <div class="row">
              <div class="form-group col-lg-6">
                <label for="role">Role</label>
                <select class="form-control form-control-sm" id="role" name="role">
                  <option selected>Please Select A role</option>
                  @foreach ($roles as $role)
                    <option value="{{$role->role_id}}">{{$role->role}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-lg-6">
                <label for="image">File upload</label>
                <input type="file" name="image" class="file-upload-default" id="image">
                <div class="input-group col-xs-12">
                  <input type="text" class="form-control file-upload-info" id="image-name" disabled="" placeholder="Upload Image">
                  <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button" id="upload-btn">Upload</button>
                  </span>
                </div>
              </div>
            </div>
            <div class="pull-right">
                <button type="submit" class="btn btn-success">Submit</button>    
                <button type="button" class="btn btn-danger">Cancel</button>    
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection
@section('scripts')
  <script>
    $("#image").change(function(){
      var name = $("#image-name").val(this.files[0].name);
    });

    $("#upload-btn").on("click", function(){
      $("#image").click();
    });
  </script>
@endsection