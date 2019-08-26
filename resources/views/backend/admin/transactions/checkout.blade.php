@extends('backend.admin.master.adminMaster')
@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{route('backend.admin.ordercart.cartstore')}}">
                    @csrf
                    @if (Session::has('message'))
                        <div class="alert alert-danger">
                            <li>{{Session::get('message')}}</li>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>                                
                            @endforeach
                        </div>
                    @endif
                    <input type="hidden" id="hidden_discounted_price" name="discounted_price">                    
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Customer's Name" autocomplete="off">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="contact_number">Number</label>
                            <input type="text" class="form-control" name="contact_number" id="contact_number" placeholder="Contact Number" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea class="form-control" name="address" id="address" rows="3"></textarea>
                    </div>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td width="50%"></td>
                                <td width="20%" align="center" style="font-weight:bold;">Total Price:</td>
                                <td width="30%" align="center" style="font-weight:bold;">{{$totalPrice}}</td>
                            </tr>
                            <tr>
                                <td width="50%"></td>
                                <td width="20%" align="center" style="font-weight:bold;">Discount:</td>
                                <td width="30%" align="center" style="font-weight:bold;">
                                    <input type="number" class="form-control text-center" name="discount" id="discount" placeholder="discount"  autocomplete="off">
                                </td>
                            </tr>
                            <tr id="row_total" style="display:none;">
                                <td width="50%"></td>
                                <td width="20%" align="center" style="font-weight:bold;">Discounted Price:</td>
                                <td id="totalPrice" width="30%" align="center" style="font-weight:bold;">{{$totalPrice}}</td>
                            </tr>
                            <tr>
                                <td width="50%"></td>
                                <td width="20%" align="center" style="font-weight:bold;">Payment amount:</td>
                                <td style="font-weight:bold;"><input type="number" class="form-control text-center" name="amount_paid" id="amount_paid" placeholder="payment amount"></td>
                            </tr>
                            <tr>
                                <td width="50%"></td>
                                <td width="20%" align="center" style="font-weight:bold;">Change:</td>
                                <td id="change" width="30%" align="center" style="font-weight:bold;"></td>                                
                            </tr>
                        </tbody>
                    </table>
                    <button id="submit" type="submit" class="btn btn-outline-success pull-right mt-4">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
    <!-- modal -->
        <div class="modal fade" tabindex="-1" id="insufficient-modal" aria-hidden="true">
            <div class="modal-default modal-center modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span ari{a-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Payment is not enough</h5>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-success" type="button" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" tabindex="-1" id="nopayment-modal" aria-hidden="true">
            <div class="modal-default modal-center modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span ari{a-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>There is no payment done</h5>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-success" type="button" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    <!-- End modal -->
@endsection
@section('scripts')
    <script>
        let totalPrice = 0;
        $("#discount").on("change",function(){
            if($(this).val != '' || $(this).val() != 0)
            {
                $("#row_total").removeAttr("style");
                totalPrice = {{$totalPrice}} - $(this).val();
                $("#totalPrice").text(totalPrice);
                $("#hidden_discounted_price").val(totalPrice);
            }

            if($(this).val() == 0 || $(this).val() == '')
            {
                $("#row_total").attr("style","display:none;");
                $("hidden_discounted_price").val(totalPrice);
            }

        });
        $("#amount_paid").on("change",function(){

            var current_total = $("#totalPrice").text();
            var change = $(this).val() - current_total;
            $("#change").text(change);
            $("#hidden_discounted_price").val(totalPrice);
        });

        $("#submit").click(function(event){    
            if(($("#amount_paid").val() < totalPrice) && ($("#amount_paid").val() != '') && ($("#amount_paid").val() != 0))
            {
                $("#insufficient-modal").modal("show");
                event.preventDefault();
            }
            else if(($("#amount_paid").val() == '') || ($("#amount_paid").val() == 0))
            {
                $("#nopayment-modal").modal("show");
                event.preventDefault();
            }
        });
    </script>
@endsection