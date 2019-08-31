<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/calmui/template/demo/vertical-default-light/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Aug 2019 15:55:48 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Grecon</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/__backend/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="/__backend/assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="/__backend/assets/vendors/jquery-toast-plugin/jquery.toast.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="/__backend/assets/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="/__backend/assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="content-wrapper-login d-flex align-items-stretch auth auth-img-bg">
            <div class="row flex-grow">
              <div class="col-lg-6 d-flex align-items-center justify-content-center">
                <div class="auth-form-transparent text-left p-3">
                  <div class="brand-logo">
                    <img src="/__backend/assets/images/grecon_background.png" alt="logo">
                  </div>
                  <h4>Welcome back!</h4>
                  @if ($errors->any())
                      <div class="alert alert-danger">
                        @foreach ($errors->all() as $errors)
                          <li>{{$error}}</li>
                        @endforeach
                      </div>
                  @endif
                  @if (Session::has('error'))
                      <div class="alert alert-danger">
                        <li>{{Session::get('error')}}</li>
                      </div>
                  @endif
                  <form class="pt-3" method="POST" action="{{route('auth.signIn')}}">
                    @csrf
                    <div class="form-group">
                      <label for="exampleInputEmail">Username</label>
                      <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="mdi mdi-account-outline text-primary"></i>
                          </span>
                        </div>
                        <input name="username" type="text" class="form-control form-control-lg border-left-0"
                        autocomplete="off" id="exampleInputEmail" placeholder="Username">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword">Password</label>
                      <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="mdi mdi-lock-outline text-primary"></i>
                          </span>
                        </div>
                        <input type="password" name="password" class="form-control form-control-lg border-left-0"
                        autocomplete="off" id="exampleInputPassword" placeholder="Password">                        
                      </div>
                    </div>
                    <div class="my-3">
                      <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">LOGIN</button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="col-lg-6 login-half-bg d-flex flex-row">
                <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2018  All rights reserved.</p>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>
      <!-- container-scroller -->
      <!-- plugins:js -->
      <script src="/__backend/assets/js/vendors/js/vendor.bundle.base.js"></script>
      <!-- endinject -->
      <!-- Plugin js for this page -->
      <!-- End plugin js for this page -->
      <!-- inject:js -->

      <!-- endinject -->
</body>

<script>
    $(document).ready(function(){
      @if(Session::has('message'))  
        $.toast({
            heading: "{{Session::get('heading')}}",
            text: "{{Session::get('message')}}",
            showHideTransition: 'plain',
            icon: "{{Session::get('icon')}}",
            loaderBg: '#60cf00',
            hideAfter: 5000,
            position: 'top-right'
        });
        @endif
    });
</script>

<!-- Mirrored from www.urbanui.com/calmui/template/demo/vertical-default-light/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Aug 2019 15:55:48 GMT -->
</html>

