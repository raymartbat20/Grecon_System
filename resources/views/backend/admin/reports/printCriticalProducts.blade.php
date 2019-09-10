<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/calmui/template/demo/vertical-default-light/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Aug 2019 15:55:48 GMT -->
<head>
  <!-- Required meta tags -->
  {{-- <meta charset="utf-8"> --}}
  {{-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> --}}
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Print for Critical Products</title>
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
    <table class="table table-bordered">
        <thead>
            <th>Product Name</th>
            <th>Qty</th>
            <th>Critical Amuont</th>
            <th>Price</th>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{$product->product_name}}</td>
                    <td>{{$product->qty}}</td>
                    <td>{{$product->critical_amount}}</td>
                    <td>{{$product->price}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>         
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
        window.print();

        window.close();
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