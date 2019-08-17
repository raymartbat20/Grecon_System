@extends('backend.admin.master.adminMaster')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="card">
                    <h4 class="card-title mt-2">New Product</h4>
                    <div class="card-header container-fluid bg-success py-2">
                        <p class="mb-0 text-white">Basic Information</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2">
                               <input type="file" class="dropify" data-default-file="/__backend/assets/images/avatars/default.png"
                               data-height="150">
                            </div>
                            <div class="col-lg-8">
                                <div class="row">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header container-fluid bg-success py-2">
                        <p class="mb-0 text-white">Basic Information</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.dropify').dropify({
    tpl: {
        wrap:            '<div class="dropify-wrapper"></div>',
        loader:          '<div class="dropify-loader"></div>',
        message:         '<div class="dropify-message"><span class="file-icon" />Click or Drag an Image<p></p></div>',
        preview:         '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">Drag or click to replace</p></div></div></div>',
        filename:        '<p class="dropify-filename"><span class="file-icon"></span> <span class="dropify-filename-inner"></span></p>',
        clearButton:     '<button type="button" class="dropify-clear">remove</button>',
        errorLine:       '<p class="dropify-error"></p>',
        errorsContainer: '<div class="dropify-errors-container"><ul></ul></div>'
    }
});
    </script>
@endsection