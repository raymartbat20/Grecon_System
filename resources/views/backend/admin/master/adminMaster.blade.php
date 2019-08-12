
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
<<<<<<< HEAD
<body>
=======
<body class="sidebar-fixed">
>>>>>>> 2ce7d968c0d71d605fc807dcc8275f0bafeec62b
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('backend.admin.partials.toolbars.adminHeader')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
<<<<<<< HEAD
      <!-- partial:partials/_settings-panel.html -->
        <!-- Theme Selector -->
            {{-- <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                <i class="settings-close mdi mdi-close"></i>
                <p class="settings-heading">SIDEBAR SKINS</p>
                <div class="sidebar-bg-options" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
                <div class="sidebar-bg-options selected" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-primary border mr-3"></div>Dark</div>
                <p class="settings-heading mt-2">HEADER SKINS</p>
                <div class="color-tiles mx-0 px-4">
                    <div class="tiles success"></div>
                    <div class="tiles danger"></div>
                    <div class="tiles light default"></div>
                    <div class="tiles dark"></div>
                    <div class="tiles primary"></div>
                </div>
                </div>
            </div>
        <!-- End Theme Selector -->

        <!-- Right Hidden sidebard -->
            <div id="right-sidebar" class="settings-panel">
                <i class="settings-close mdi mdi-close"></i>
                <ul class="nav nav-tabs" id="setting-panel" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
                </li>
                </ul>
                <div class="tab-content" id="setting-content">
                <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
                    <div class="add-items d-flex px-3 mb-0">
                    <form class="form w-100">
                        <div class="form-group d-flex">
                        <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                        <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                        </div>
                    </form>
                    </div>
                    <div class="list-wrapper px-3">
                    <ul class="d-flex flex-column-reverse todo-list">
                        <li>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input class="checkbox" type="checkbox">
                            Team review meeting at 3.00 PM
                            </label>
                        </div>
                        <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input class="checkbox" type="checkbox">
                            Prepare for presentation
                            </label>
                        </div>
                        <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input class="checkbox" type="checkbox">
                            Resolve all the low priority tickets due today
                            </label>
                        </div>
                        <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li class="completed">
                        <div class="form-check">
                            <label class="form-check-label">
                            <input class="checkbox" type="checkbox" checked>
                            Schedule meeting for next week
                            </label>
                        </div>
                        <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                        <li class="completed">
                        <div class="form-check">
                            <label class="form-check-label">
                            <input class="checkbox" type="checkbox" checked>
                            Project review
                            </label>
                        </div>
                        <i class="remove mdi mdi-close-circle-outline"></i>
                        </li>
                    </ul>
                    </div>
                    <div class="events py-4 border-bottom px-3">
                    <div class="wrapper d-flex mb-2">
                        <i class="mdi mdi-circle-outline text-primary mr-2"></i>
                        <span>Feb 11 2018</span>
                    </div>
                    <p class="mb-0 font-weight-thin text-gray">Creating component page</p>
                    <p class="text-gray mb-0">build a js based app</p>
                    </div>
                    <div class="events pt-4 px-3">
                    <div class="wrapper d-flex mb-2">
                        <i class="mdi mdi-circle-outline text-primary mr-2"></i>
                        <span>Feb 7 2018</span>
                    </div>
                    <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                    <p class="text-gray mb-0 ">Call Sarah Graves</p>
                    </div>
                </div>
                <!-- To do section tab ends -->
                <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
                    <div class="d-flex align-items-center justify-content-between border-bottom">
                    <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                    <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
                    </div>
                    <ul class="chat-list">
                    <li class="list active">
                        <div class="profile"><img src="/__backend/assets/images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                        <div class="info">
                        <p>Thomas Douglas</p>
                        <p>Available</p>
                        </div>
                        <small class="text-muted my-auto">19 min</small>
                    </li>
                    <li class="list">
                        <div class="profile"><img src="/__backend/assets/images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                        <div class="info">
                        <div class="wrapper d-flex">
                            <p>Catherine</p>
                        </div>
                        <p>Away</p>
                        </div>
                        <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                        <small class="text-muted my-auto">23 min</small>
                    </li>
                    <li class="list">
                        <div class="profile"><img src="/__backend/assets/images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                        <div class="info">
                        <p>Daniel Russell</p>
                        <p>Available</p>
                        </div>
                        <small class="text-muted my-auto">14 min</small>
                    </li>
                    <li class="list">
                        <div class="profile"><img src="/__backend/assets/images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                        <div class="info">
                        <p>James Richardson</p>
                        <p>Away</p>
                        </div>
                        <small class="text-muted my-auto">2 min</small>
                    </li>
                    <li class="list">
                        <div class="profile"><img src="/__backend/assets/images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                        <div class="info">
                        <p>Madeline Kennedy</p>
                        <p>Available</p>
                        </div>
                        <small class="text-muted my-auto">5 min</small>
                    </li>
                    <li class="list">
                        <div class="profile"><img src="/__backend/assets/images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                        <div class="info">
                        <p>Sarah Graves</p>
                        <p>Available</p>
                        </div>
                        <small class="text-muted my-auto">47 min</small>
                    </li>
                    </ul>
                </div>
                <!-- chat tab ends -->
                </div>
            </div> --}}
        <!-- End Right Hidden sidebard -->

      <!-- partial -->
=======
>>>>>>> 2ce7d968c0d71d605fc807dcc8275f0bafeec62b
      <!-- partial:partials/_sidebar.html -->
        @include('backend.admin.partials.toolbars.adminSidebar')
      <!-- partial -->
      <div class="main-panel">
            <div class="breadcrumbs">
<<<<<<< HEAD
=======
                <h1 style="position:fixed; right:10px ;margin-top:20px; margin-left:75%;">Hello</h1>
>>>>>>> 2ce7d968c0d71d605fc807dcc8275f0bafeec62b
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

