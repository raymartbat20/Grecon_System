@extends('backend.admin.master.adminMaster')
@section('content')
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card fixed">
        <div class="card-body">
            <p class="card-description">
              Create New User
            </p>
          <form class="forms-sample"action="">
            <div class="row">
                <div class="form-group col-lg-6">
                    <label for="firstname">Firstname</label>
                    <input type="text" class="form-control" id="firstname" placeholder="Firstname">
                </div>
                <div class="form-group col-lg-6">
                  <label for="lastname">Lastname</label>
                  <input type="text" class="form-control" id="lastname" placeholder="Lastname">
                </div>
            </div>

            <div class="form-group">
              <label for="Email">Email address</label>
              <input type="email" class="form-control" id="Email" placeholder="Email">
            </div>  
            
            <div class="row">
              <div class="form-group col-lg-6">
                <label for="Password">Password</label>
                <input type="password" class="form-control" id="Password" placeholder="Password">
              </div>
  
              <div class="form-group col-lg-6">
                <label for="ConfirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="ConfirmPassword" placeholder="Password">
              </div>
            </div>
            
            <div class="row">
              <div class="form-group col-lg-6">
                <label for="number">Contact Number</label>
                <input type="integer" class="form-control" id="number" placeholder="Contact Number">
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
                <button type="submit" class="btn btn-outline-success">Submit</button>    
                <button type="submit" class="btn btn-outline-danger">Cancel</button>    
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
    })
  </script>
@endsection