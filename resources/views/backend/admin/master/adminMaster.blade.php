
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/calmui/template/demo/vertical-default-light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Aug 2019 15:48:24 GMT -->
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Grecon</title>
  <!-- plugins:css -->
  @include('backend.layouts.styles.calmStyles')
</head>
<body class="sidebar-fixed">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('backend.admin.partials.toolbars.adminHeader')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
        @include('backend.admin.partials.toolbars.adminSidebar')
      <!-- partial -->
      <div class="main-panel">
            <div class="breadcrumbs">
                <h1 style="position:fixed; right:10px ;margin-top:20px; margin-left:75%;">Hello</h1>
                @yield('bredcrumbs')
            </div>
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a href="../../../../index.html" target="_blank">Urbanui</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
</body>
  @include('backend.layouts.scripts.calmScripts')
  @yield('scripts')


<!-- Mirrored from www.urbanui.com/calmui/template/demo/vertical-default-light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Aug 2019 15:48:57 GMT -->
</html>

