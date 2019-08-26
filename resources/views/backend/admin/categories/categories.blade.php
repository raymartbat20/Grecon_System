@extends('backend.admin.master.adminMaster')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <span class="tooltipped pull-right" data-toggle="tooltip" data-title="Create Category" data-placement="top">
                    <button class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#create-category">
                        <i class="fa fa-plus"></i>
                        <i class="mdi mdi-layers"></i>
                    </button>
                </span>
                <h1 class="card-title">Category</h1>
                <div class="table-responsive">
                    @if (Session::has('message'))
                        @if (Session::get('message') == "Password Doesn't match!")
                            <div class="alert alert-danger">
                                <li>{{Session::get('message')}}</li>
                            </div>
                        @endif
                    @elseif ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)                                    
                                <li>{{$error}}</li>
                            @endforeach
                        </div>
                    @endif
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
                                        <span class="tooltipped" data-toggle="tooltip" data-title="Update Category" data-placement="top">
                                            <button type="button" class="btn btn-outline-info" data-toggle="modal"
                                                data-target="#update-category" data-categoryid="{{$category->id}}"
                                                data-name="{{$category->category}}">
                                                <i class="fa fa-pencil"></i>
                                            </button>
                                        </span>
                                        <span class="tooltipped" data-toggle="tooltip" data-title="Delete Category" data-placement="top">
                                            <button type="button" class="btn btn-outline-primary" data-toggle="modal" 
                                                data-target="#delete-category" data-categoryid="{{$category->id}}"
                                                data-name="{{$category->category}}">
                                                <i class="fa fa-archive"></i>
                                            </button>
                                        </span>
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

        <div class="modal fade" tabindex="-1" aria-hidden="true" id="create-category">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create new category</h5>
                        <button class="close" type="button" data-dismiss="modal">
                            <span>×</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('backend.admin.category.store')}}">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="update-category-id" id="update-category-id">
                            <div class="col-lg-12 form-group">
                                <label for="category">New Category</label>
                                <input type="text" name="category" id="category" class="form-control" placeholder="New category">
                            </div>                                
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-inverse-success">Create</button>
                            <button type="button" class="btn btn-inverse-warning" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" aria-hidden="true" id="update-category">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update category</h5>
                        <button class="close" type="button" data-dismiss="modal">
                            <span>×</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('backend.admin.category.update','update')}}">
                        @csrf
                        @method('PATCH')
                        <div class="modal-body">
                            <input type="hidden" name="catid" id="update-category-id">
                            <div class="col-lg-12 form-group">
                                <label for="category">Update Category</label>
                                <input type="text" name="category" id="update-category" class="form-control">
                            </div>                                
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-inverse-success">Update</button>
                            <button type="button" class="btn btn-inverse-warning" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" aria-hidden="true" id="delete-category">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete category</h5>
                        <button class="close" type="button" data-dismiss="modal">
                            <span>×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="catid" id="delete-category-id">
                        <span id="message"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-inverse-danger" id="btn-delete" data-toggle="modal"
                            data-target="#password-confirm">Delete</button>
                        <button type="button" class="btn btn-inverse-warning" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" aria-hidden="true" id="password-confirm">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete category</h5>
                        <button class="close" type="button" data-dismiss="modal">
                            <span>×</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('backend.admin.category.destroy','destroy')}}">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <input type="hidden" name="categoryid" id="categoryid">
                            <div class="form-group">
                                <label for="password">Enter your password to delete</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-inverse-danger">Delete</button>
                            <button type="button" class="btn btn-inverse-warning" data-dismiss="modal">Close</button>
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