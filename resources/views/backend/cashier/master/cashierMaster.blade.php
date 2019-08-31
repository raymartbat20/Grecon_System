
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
  @yield('styles')
</head>
<body class="sidebar-fixed">
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('backend.cashier.partials.toolbars.cashierHeader')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
        @include('backend.cashier.partials.toolbars.cashierSidebar')
      <!-- partial -->
      <div class="main-panel">
            <div class="breadcrumbs">
                @yield('breadcrumbs')
            </div>
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        {{-- <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer> --}}
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
  <script>
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
  </script>


<!-- Mirrored from www.urbanui.com/calmui/template/demo/vertical-default-light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Aug 2019 15:48:57 GMT -->
</html>

