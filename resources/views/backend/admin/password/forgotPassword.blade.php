@extends('backend.admin.master.adminMaster')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Reset Password</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{route('backend.admin.password.forgot')}}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <label class="col-lg-3" for="username">Username:</label>
                        <input type="text" class="form-control col-lg-9" name="username" id="username" placeholder="Username" autocomplete="off">
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3" for="new_password">New Password:</label>
                        <input type="password" class="form-control col-lg-9" name="new_password" id="new_password" placeholder="New Password">
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3" for="confirm_password">Confirm Password:</label>
                        <input type="password" class="form-control col-lg-9" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                    </div>
                    <button type="submit" class="btn btn-outline-success pull-right">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
@endsection