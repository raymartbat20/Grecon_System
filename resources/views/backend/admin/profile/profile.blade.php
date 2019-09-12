@extends('backend.admin.master.adminMaster')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">    
            <div class="card-body">
                <div class="row"> 
                    <div class="col-2"> 
                        <div class="text-center">
                            <h3 class="card-title">Profile</h3>
                            <img id="avatar" src="/__backend/assets/images/avatars/{{Auth::user()->image}}" class="img-lg rounded-circle mb-3">
                            <p>{{Auth::user()->getFullName()}}</p>
                            <p>{{Auth::user()->role['role']}}</p>
                            <p>{{Auth::user()->email}}</p>
                        </div>
                    </div>
                    <div class="col-10">
                        <h1 class="card-title">Edit Profile</h1>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <ul class="list-arrow">
                                        <li>{{$error}}</li>
                                    </ul>
                                @endforeach
                            </div>
                        @endif
                        <form method="POST" action="{{route('backend.admin.profile.update')}}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control form-control-sm" name="firstname" id="firstname" value="{{Auth::user()->firstname}}">
                                </div>
                                <div class="form-group col-6">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control form-control-sm" name="lastname" id="lastname" value="{{Auth::user()->lastname}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="number">Contact Number</label>
                                    <input type="number" class="form-control form-control-sm" name="number" id="number" value="{{Auth::user()->number}}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="image">File upload</label>
                                    <input type="file" name="image" class="file-upload-default" id="image">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control form-control-sm file-upload-info" id="image-name" disabled="" placeholder="Upload Image">
                                        <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-sm btn-primary" type="button" id="upload-btn">Upload</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="pull-right">
                                <button class="btn btn-inverse-success" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
  <script>

    $("#image").change(function(){

        var name = $("#image-name").val(this.files[0].name);
        var file    = document.querySelector('input[type=file]').files[0];
        var preview = document.getElementById('avatar');
        var reader  = new FileReader();

        reader.addEventListener("load", function () {
            preview.src = reader.result;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
            }
        
    });

    $("#upload-btn").on("click", function(){
      $("#image").click();
    });
  </script>
@endsection