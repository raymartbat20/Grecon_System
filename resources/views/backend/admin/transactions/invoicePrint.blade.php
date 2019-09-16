<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.urbanui.com/calmui/template/demo/vertical-default-light/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Aug 2019 15:55:48 GMT -->
<head>
  <!-- Required meta tags -->
  {{-- <meta charset="utf-8"> --}}
  {{-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> --}}
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Invoice for {{$customer->name}}</title>
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
        <div class="row flex-grow">
          <div class="col-lg-12 d-flex align-items-center justify-content-center">
            <div class="col-lg-12">
                <div class="card px-2">
                    <div class="card-body">
                        <div class="container-fluid">
                          <h3 class="text-right my-5">Invoice&nbsp;&nbsp;#INV-17</h3>
                          <hr>
                        </div>
                        <div class="container-fluid d-flex justify-content-between">
                          <div class="col-lg-3 pl-0">
                            <p class="mt-5 mb-2"><b>Grecon</b></p>
                            <p>Grecon Bldg.,<br>Km. 38 National Rd Brgy,<br>Santa Maria, Bulacan</p>
                          </div>
                          <div class="col-lg-3 pr-0">
                            <p class="mt-5 mb-2 text-right"><b>Invoice to</b></p>
                            <p class="text-right">{{$customer->name}},<br>{{$customer->address}}.</p>
                          </div>
                        </div>
                        <div class="container-fluid d-flex justify-content-between">
                          <div class="col-lg-3 pl-0">
                            <p class="mb-0 mt-5">Invoice Date : {{$customer->created_at->format('d M Y')}}</p>
                          </div>
                        </div>
                        <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                          <div class="w-100">
                              <table class="table">
                                <thead>
                                  <tr class="bg-dark text-black">
                                      <th>#</th>
                                      <th>Item Name</th>
                                      <th class="text-right">Quantity</th>
                                      <th class="text-right">Unit cost</th>
                                      <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $key => $item)
                                        <tr class="text-right">
                                            <td class="text-left">{{$loop->iteration}}</td>
                                            <td class="text-left">{{$item['item']['product_name']}}</td>
                                            <td>{{$item['qty']}}</td>
                                            <td>{{$item['item']['price']}}</td>
                                            <td>{{$item['price']}}</td>
                                        </tr>
                                    @endforeach                    
                                </tbody>
                              </table>
                            </div>
                        </div>
                        <div class="container-fluid mt-5 w-100">
                            <p class="text-right mb-2">Sub-total {{$customer->original_price}}</p>
                            <p class="text-right">Discount: {{$customer->discount}}</p>
                            <h4 class="text-right mb-5">Total : {{$customer->total}}</h4>
                          <hr>
                        </div>
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
      $(".table").load(function(){
        window.print();

        window.close();
      });
    });
</script>

<!-- Mirrored from www.urbanui.com/calmui/template/demo/vertical-default-light/pages/samples/login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Aug 2019 15:55:48 GMT -->
</html>

