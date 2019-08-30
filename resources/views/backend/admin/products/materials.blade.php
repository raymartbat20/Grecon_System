@extends('backend.admin.master.adminMaster')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <a href="{{url('/admin/createProduct')}}">
                    <button class="btn btn-success pull-right">Add Materials</button>
                </a>
                <h4 class="card-title">Materials to be used</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </div>
                @endif
                <div class="responsive-table">
                    <table class="table table-hover">
                        <thead align="center">
                            <th>Product Image</th>
                            <th>Name</th>
                            <th>ID</th>
                            <th>qty</th>
                            <th>action</th>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td align="center"><img class="py-1" src="/__backend/assets/images/products/{{$item['item']['image']}}"></td>
                                    <td align="center">{{$item['item']['product_name']}}</td>
                                    <td align="center">{{$item['item']['product_id']}}</td>
                                    <td align="center">{{$item['qty']}}</td>
                                    <td align="center">
                                        <button data-product_id={{$item['item']['product_id']}}
                                            data-product_unit={{$item['item']['unit']}} type="button" data-toggle="modal"
                                            data-target="#reduce-material" class="btn btn-rounded btn-icon btn-primary">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <button data-product_id={{$item['item']['product_id']}} type="button"
                                            data-product_name={{$item['item']['product_name']}}
                                            data-toggle="modal" data-target="#remove-material"
                                            class="btn btn-rounded btn-icon btn-danger">
                                            <i class="fa fa-trash"></i>
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
    <div class="modal fade" id="reduce-material" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-default">
            <form method="GET" action="{{route('backend.admin.createproduct.reduceMaterial')}}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Reduce Item</h4>
                        <button type="button" data-dismiss="modal" class="close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="product_id" id="product_id">
                        <div class="form-group">
                            <label for="qty">Reduce Quantity</label>
                            <input class="form-control" type="text" name="qty" id="qty" placeholder="Reduce Quantity">
                        </div>
                        <p id="kilo-msg" class="text-success"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-success">REDUCE</button>
                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal">CANCEL</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="remove-material" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-default">
                <form method="GET" action="{{route('backend.admin.createproduct.removeMaterial')}}">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Remove Item</h4>
                            <button type="button" data-dismiss="modal" class="close">
                            <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="product_id" id="product_id_remove">
                            <h3 id="remove-msg"></h3>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-success">REMOVE</button>
                            <button type="button" class="btn btn-outline-warning" data-dismiss="modal">CANCEL</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection