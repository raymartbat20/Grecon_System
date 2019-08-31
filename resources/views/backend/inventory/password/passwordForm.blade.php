@extends('backend.inventory.master.inventoryMaster')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @if (Session::has('message'))
                    <div class="alert alert-danger">
                        <li>{{Session::get('message')}}</li>
                    </div>

                @elseif($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>                                                        
                        @endforeach
                    </div>
                @endif
                <h4 class="card-title">Change Password</h4>
                <form method="POST" action="{{route('backend.inventory.password.update')}}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Old Password:</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="password" id="old_password" name="old_password" placeholder="Old Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">New Password:</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="password" id="password" name="password" placeholder="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Confirtm Password:</label>
                        <div class="col-sm-9">
                            <input class="form-control" type="password" id="confirm_password" name="confirm_password" placeholder="confirm_password">
                        </div>
                    </div>
                    <div class="pull-right">
                        <button class="btn btn-inverse-success" type="submit">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection