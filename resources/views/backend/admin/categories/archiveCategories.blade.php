@extends('backend.admin.master.adminMaster')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <span class="tooltipped pull-right" data-toggle="tooltip" data-title="Create Category" data-placement="top">
                    <a class="btn btn-primary btn-sm pull-right" href="admin/cetegories">
                        Active Categories
                    </a>
                </span>
                <h1 class="card-title">Category</h1>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width:80%;">Category</th>
                                <th style="width:20%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{$category->category}}</td>                                
                                    <td>
                                        <button type="button" class="btn btn-outline-success p-2" data-toggle="modal"
                                            data-target="#restore-category" data-categoryid="{{$category->category_id}}"
                                            data-name="{{$category->category}}">
                                            Restore
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Modals -->

        <div class="modal fade" tabindex="-1" aria-hidden="true" id="restore-category">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Restore category</h5>
                        <button class="close" type="button" data-dismiss="modal">
                            <span>×</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('backend.admin.category.restore')}}">
                        @csrf
                        <div class="modal-body">
                            <div class="col-lg-12 form-group">
                                <input type="hidden" name="category_id" id="category_id" class="form-control" placeholder="New category">
                                <h4 id="message"></h4>
                            </div>                                
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Restore</button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <!-- End Modas -->
@endsection
@section('scripts')
    <script>
        $(".table").dataTable();
    </script>
@endsection