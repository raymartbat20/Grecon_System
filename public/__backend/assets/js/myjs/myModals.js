$(document).ready(function(){
    
    //User Modal
    $('#edit-user').on('show.bs.modal',function(event){
                
        var button = $(event.relatedTarget);
        var userid      = button.data('userid');
        var firstname   = button.data('firstname');
        var lastname    = button.data('lastname');
        var number      = button.data('number');
        var role        = button.data('role');
        var image       = button.data('image');

        var modal = $(this);

        modal.find('.modal-body #userid').val(userid);
        modal.find('.modal-body #firstname').val(firstname);
        modal.find('.modal-body #lastname').val(lastname);
        modal.find('.modal-body #number').val(number);
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

        $("#upload-btn").on("click",function(){
            $("#image").click();
        });
        $("#image").on("change",function(){
            $("#image-name").val(this.files[0].name);
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
        modal.find('.modal-body .modal-title').text('Are you sure you want to archive '+name+'?');
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
            var catid = button.data('catid');
            var category = button.data('name');

            var modal = $(this);

            modal.find('.modal-body #delete-category-id').val(catid);
            modal.find('.modal-body #message').html("<h3>Add to archive this <span>"+category+"</span> category?</h3>");
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

    $("#restore-product").on('show.bs.modal',function(event){
        
        var button = $(event.relatedTarget);
        var product_id = button.data('product_id');

        var modal = $(this);

        modal.find('.modal-body #modal-message').text('Restore this '+ product_id +'?');
        modal.find('.modal-body #product_id').val(product_id);
        
    });
    //End product modal


    //Transactions modal

    $("#add-qty-pc").on("show.bs.modal",function(event){
        var button = $(event.relatedTarget);

        var product_id  = button.data('product_id');
        var product_qty = button.data('product_qty');

        var modal = $(this);

        modal.find(".modal-body #qty").val('');
        modal.find(".modal-body #product_id").val(product_id);

        $("#submit").click(function(event){
            var qty = $("#qty_pc").val();
            if(qty > product_qty){
                $("#modal-warning").modal("show");
                event.preventDefault();
            }
        });
    });

    $("#add-qty-kilo").on("show.bs.modal",function(event){
        var button = $(event.relatedTarget);

        var product_id  = button.data('product_id');
        var product_qty = button.data('product_qty');

        var modal = $(this);

        modal.find(".modal-body #qty").val('');
        modal.find(".modal-body #product_id_kilo").val(product_id);

        $("#submit").click(function(event){
            var qty = $("#qty_kilo").val();
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


    //Make product

        $("#product-info").on('show.bs.modal',function(event){

            var button = $(event.relatedTarget);
            var product_id              = button.data('product_id');
            var product_name            = button.data('product_name');
            var product_qty             = button.data('product_qty');
            var product_height          = button.data('product_height');
            var product_hlabel          = button.data('product_hlabel');
            var product_wLabel          = button.data('product_wlabel');
            var product_weLabel         = button.data('product_welabel');
            var product_description     = button.data('product_description');
            var product_supplier        = button.data('product_supplier');
            var product_width           = button.data('product_width');
            var product_image           = button.data('product_image');
            var product_unit            = button.data('product_unit');

            var modal = $(this);

            modal.find('.modal-body').html('<div class="col-lg-12 grid-margin stretch-card">' +
            '<div class="card">'+
                '<div class="card-body">'+
                    '<div class="card-header container-fluid bg-warning py-2">'+
                        '<p class="mb-0 text-white">Product Information</p>'+
                    '</div>'+
                    '<div class="card-body col-lg-12 text-center">'+
                        '<div class="col-lg-12 mb-2">'+
                            '<img class="image-container" src="/__backend/assets/images/products/'+product_image+'">'+
                        '</div>'+
                        '<div class="col-lg-12 text-center">'+
                            '<h5>Product ID: <mark><u>'+product_id+'</u></mark></h5>'+
                        '</div>'+
                        '<div class="col-lg-12 text-center">'+
                            '<h5>Product name: <mark><u>'+product_name+'</u></mark></h5>'+
                        '</div>'+
                        '<div class="col-lg-12 text-center">'+
                            '<h5>Supplier: <mark><u>'+product_supplier+'</u></mark></h5>'+
                        '</div>'+
                        '<div class="col-lg-12 text-center">'+
                            '<h5>Stocks: <mark><u>'+product_qty+' '+product_unit+'(s)</u></mark></h5>'+
                        '</div>'+
                        '<div class="col-lg-12 text-center">'+
                            '<h5>Height: <mark><u>'+product_height+''+product_hlabel+'</u></mark></h5>'+
                        '</div>'+
                        '<div class="col-lg-12 text-center">'+
                            '<h5>Width: <mark><u>'+product_width+''+product_wLabel+'</u></mark></h5>'+
                        '</div>'+
                        '<div class="col-lg-12 text-center">'+
                            '<label for="description">Description:</label>'+
                            '<blockquote class="blockquote"><p>'+product_description+'</p></blockquote>'+
                        '</div>'+                                               
                    '</div>'+
                '</div>'+
            '</div>'+                        
        '</div>');
        });

    $("#createProduct-material-pc").on('show.bs.modal',function(event){
        var button = $(event.relatedTarget);

        var product_id = button.data('product_id');
        var product_qty = button.data('product_qty');

        var modal = $(this);

        modal.find('.modal-body #product_id').val(product_id);

        $("#submit").click(function(event){
            var qty = $("#qty").val();
            if(qty > product_qty){
                $("#modal-warning").modal("show");
                event.preventDefault();
            }
        });
    });

    $("#createProduct-material-kilo").on('show.bs.modal',function(event){
        var button = $(event.relatedTarget);

        var product_id = button.data('product_id');

        var modal = $(this);

        modal.find('.modal-body #product_id').val(product_id);
    });

    $("#reduce-material").on('show.bs.modal',function(event)
    {
        var button = $(event.relatedTarget);

        var product_id = button.data('product_id');
        var product_unit = button.data('product_unit');
      
        var modal = $(this);

        if(product_unit != "pc")
        {
            modal.find('.modal-body #kilo-msg').text('This is supported only by decimal value');
        }
        modal.find('.modal-body #product_id').val(product_id);

        modal.on('hide.bs.modal',function(){
            modal.find('.modal-body #kilo-msg').text('');
        });
    });

    $("#remove-material").on('show.bs.modal',function(event){

        var button = $(event.relatedTarget);

        var product_id = button.data('product_id');
        var product_name = button.data('product_name');
        
        var modal = $(this);
        modal.find('.modal-body #remove-msg').text("Remove this "+product_name+"?");
        modal.find('.modal-body #product_id_remove').val(product_id);
    });
    
    //End make Product

    //Restore Supplier Modal
    $("#restore-supplier-modal").on('show.bs.modal',function(event){
        var button = $(event.relatedTarget);

        var supplier_id = button.data('supplier_id');
        var supplier_company = button.data('supplier_company');

        var modal = $(this);

        modal.find('.modal-body #supplier-id').val(supplier_id);
        modal.find('.modal-body #message').text("Restore supplier "+supplier_company+"?");
    });

    //Restore Category Modal

    $("#restore-category").on('show.bs.modal',function(event){
        var button = $(event.relatedTarget);

        var category_id = button.data('categoryid');
        var category_name = button.data('name');

        var modal = $(this);

        modal.find('.modal-body #category_id').val(category_id);
        modal.find('.modal-body #message').text("Restore category "+category_name+"?");
    });
});