$(document).ready(function(){
    
    //User Modal
    $('#edit-user').on('show.bs.modal',function(event){
                
        var button = $(event.relatedTarget);
        var userid      = button.data('userid');
        var firstname   = button.data('firstname');
        var lastname    = button.data('lastname');
        var number      = button.data('number');
        var email       = button.data('email')
        var role        = button.data('role');
        var image       = button.data('image');

        var modal = $(this);

        modal.find('.modal-body #userid').val(userid);
        modal.find('.modal-body #firstname').val(firstname);
        modal.find('.modal-body #lastname').val(lastname);
        modal.find('.modal-body #number').val(number);
        modal.find('.modal-body #email').val(email);
        modal.find('.modal-body select').val(role);
        modal.find('.modal-header #img-avatar').attr('src','/__backend/assets/images/avatars/' + image);
    });


    $('#delete-user').on('show.bs.modal',function(event){

        var button = $(event.relatedTarget);
        var userid = button.data('userid');
        var image  = button.data('image');
        var name   = button.data('name');

        var modal = $(this);

        modal.find('.modal-body #userid').val(userid);
        modal.find('.modal-body #img-avatar').attr('src','/__backend/assets/images/avatars/' + image)
        modal.find('.modal-body .modal-title').text('Are you sure you want to delete '+name+'?');
        modal.find('.modal-footer .btn-danger').attr('data-userid',userid);

    });

    $("#confirm-delete").on('show.bs.modal', function(event){

        $('#delete-user').modal('toggle');
        var button = $(event.relatedTarget);
        var userid = button.data('userid');

        var modal = $(this);

        modal.find('.modal-body #myid').val(userid);
    });

    //End User Modal


    //Suppliers modal

    $("#edit-supplier").on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);
        var supplier_id = button.data('supplierid')
        var firstname = button.data('firstname');
        var lastname = button.data('lastname');
        var email = button.data('email');
        var number = button.data('number');
        var company = button.data('company');
        var image = button.data('image');

        var modal = $(this);

        modal.find('.modal-body #supplier_id').val(supplier_id);
        modal.find('.modal-body #firstname').val(firstname);
        modal.find('.modal-body #lastname').val(lastname);
        modal.find('.modal-body #email').val(email);
        modal.find('.modal-body #number').val(number);
        modal.find('.modal-body #company').val(company);
        modal.find('.modal-header #image-avatar').attr('src','/__backend/assets/images/suppliers/'+image);

        $("#image").on("change",function(){
            $("#image-name").val(this.files[0].name);
        });

        $("#upload-btn").on("click",function(){
            $("#image").click();
        });
    });

    $('#delete-supplier').on('show.bs.modal',function(event){

        var button = $(event.relatedTarget);
        var supplier_id = button.data('supplierid');
        var image  = button.data('image');
        var name   = button.data('name');

        var modal = $(this);

        modal.find('.modal-body #userid').val(supplier_id);
        modal.find('.modal-body #img-avatar').attr('src','/__backend/assets/images/suppliers/' + image)
        modal.find('.modal-body .modal-title').text('Are you sure you want to delete '+name+'?');
        modal.find('.modal-footer .btn-danger').attr('data-supplierid',supplier_id);

    });

    $("#confirm-delete-supplier").on('show.bs.modal', function(event){

        $('#delete-supplier').modal('toggle');
        var button = $(event.relatedTarget);
        var supplierid = button.data('supplierid');

        var modal = $(this);

        modal.find('.modal-body #supplierid').val(supplierid);
    })

    //End Suppliers modal

    //Category modal

    $("#update-category").on('show.bs.modal',function(event){
            var button = $(event.relatedTarget);
            var catid = button.data('categoryid');
            var category = button.data('name');

            var modal = $(this);

            modal.find('.modal-body #update-category-id').val(catid);
            modal.find('.modal-body #update-category').val(category);
    });

    $("#delete-category").on('show.bs.modal',function(event){
            
            var button = $(event.relatedTarget);
            var catid = button.data('categoryid');
            var category = button.data('name');

            var modal = $(this);

            modal.find('.modal-body #delete-category-id').val(catid);
            modal.find('.modal-body #message').html("<h3>Delete this <span>"+category+"</span> category?</h3>");
            modal.find('.modal-body #message h3 span').attr('style','color:blue');
            modal.find('.modal-footer #btn-delete').attr('data-categoryid',catid);
    });

    $("#password-confirm").on('show.bs.modal',function(event){

        $("#delete-category").modal('toggle');
        var button = $(event.relatedTarget);
        var catid = button.data('categoryid');

        var modal = $(this);
        modal.find('.modal-body #categoryid').val(catid);
    });

    //End Category modal

    //product modal

    $('#add-stocks').on('show.bs.modal',function(event){

        var button = $(event.relatedTarget);
        var product_id = button.data('product_id');
        var product_name = button.data('product_name');

        var modal = $(this);

        modal.find('.modal-header .modal-title').text('Add stocks to '+product_name);
        modal.find('.modal-body #product_id').val(product_id);
    });

    $("#remove-defectives").on('show.bs.modal',function(event){

        var button = $(event.relatedTarget);
        var product_id = button.data('product_id');

        var modal = $(this);

        modal.find('.modal-body #remove_product_id').val(product_id);
    });


    //End product modal


    //Transactions modal

    $("#add-qty").on("show.bs.modal",function(event){
        var button = $(event.relatedTarget);

        var product_id  = button.data('product_id');
        var product_qty = button.data('product_qty');

        var modal = $(this);

        modal.find(".modal-body #qty").val('');
        modal.find(".modal-body #product_id").val(product_id);

        $("#submit").click(function(event){
            var qty = $("#qty").val();
            if(qty > product_qty){
                $("#modal-warning").modal("show");
                event.preventDefault();
            }
        });
    });

    $("#reduce-qty").on("show.bs.modal",function(event){
        var button = $(event.relatedTarget);

        var product_id = button.data("product_id");

        var modal = $(this);
        modal.find('.modal-body #product_id').val(product_id);
    });

    $("#remove-item").on("show.bs.modal",function(event){
        
        var button = $(event.relatedTarget);

        var product_id = button.data("product_id");

        var modal = $(this);

        modal.find(".modal-body #product_id_remove").val(product_id);
    });

    //End transactions modal
});