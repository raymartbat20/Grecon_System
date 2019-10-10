@extends('backend.admin.master.adminMaster')
@section('breadcrumbs')
    <nav aria-labelledby="breadcrumb">
        <ol class="breadcrumb breadcrumb-custom">
            <li class="breadcrumb-item" style="font-size:18px;"><a href="{{url('/admin/dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item" style="font-size:18px;"><a href="{{url('/admin/suppliers')}}">Suppliers</a></li>
            <li class="breadcrumb-item active" style="font-size:18px;">New Suppliers</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h1 class="card-title">New Supplier</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </div>
                @endif
                @if (Session::has('message'))
                    <div class="alert alert-danger">
                            <li>{{Session::get('message')}}</li>
                    </div>
                @endif
                <form method="POST" action="{{route('backend.admin.suppliers.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="firstname">First Name</label>
                            <input type="text" class="form-control" placeholder="First Name"
                                value="{{old('firstname')}}" name="firstname" id="firstname">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" placeholder="Last Name"
                                value="{{old('lastname')}}" name="lastname" id="lastname">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" placeholder="Email"
                                value="{{old('email')}}" name="email" id="email">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="number">Contact Number</label>
                            <input type="number" class="form-control" placeholder="Number"
                                value="{{old('number')}}" name="number" id="number">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="company">Company</label>
                            <input type="text" class="form-control" placeholder="Company"
                                value="{{old('company')}}" name="company" id="company">
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
                    <button class="btn btn-success pull-right" type="submit">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
    $("#image").on("change",function(){
        $("#image-name").val(this.files[0].name);
    });

    $("#upload-btn").on("click",function(){
        $("#image").click();
    });
    </script>
@endsection