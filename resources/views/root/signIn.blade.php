<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/calmui/template/demo/vertical-default-light/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Aug 2019 15:55:48 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CalmUI Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="/__backend/assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="/__backend/assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="/__backend/assets/vendors/jquery-toast-plugin/jquery.toast.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="./__backend/assets/css/vertical-layout-light/style.css">
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
                <img src="/__backend/assets/images/grecon_logo_lg.png" alt="logo">
              </div>
              @if (Session::has('error'))
                  <div class="alert alert-danger" role="alert">
                    <li>{{session('error')}}</li>
                  </div>
              @endif
              <h6 class="font-weight-light">Happy to see you again!</h6>
              <form class="pt-3" method="POST" action="{{route('auth.signIn')}}">
                @csrf
                <div class="form-group">
                  <label for="email">Email</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="email" name="email" class="form-control form-control-lg border-left-0" id="eEmail" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-lock-outline text-primary"></i>
                      </span>
                    </div>
                    <input type="password" name="password" class="form-control form-control-lg border-left-0" id="password" placeholder="Password">                        
                  </div>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="my-3">
                  <button class="btn btn-primary btn-block" type="submit">LOGIN</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="/__backend/assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="/__backend/assets/js/off-canvas.js"></script>
  <script src="/__backend/assets/js/hoverable-collapse.js"></script>
  <script src="/__backend/assets/js/template.js"></script>
  <script src="/__backend/assets/js/settings.js"></script>
  <script src="/__backend/assets/js/todolist.js"></script>
  <script src="/__backend/assets/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
  <script src="/__backend/assets/js/toastDemo.js"></script>

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

