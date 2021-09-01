$(document).ready(function(){
    //auto load products on scroll
    var limit = 4;
    var start = 0;
    var action = "inactive";

    //load products function
    function load_products(limit, start){
        $.ajax({
            url: 'assets/resources/loadProductsResource.php',
            method: 'POST',
            data: {limit : limit, start : start},
            cache: false,

            success: function(data){
                //appending products inside the card column
                $("#loadProducts").append(data);

                //handling message section and loading tag
                if(data == ""){
                    $("#loadProductsMsg").html("<div class='alert alert-secondary mx-4'>No more products.</div>");
                    action = "active";
                }else{
                    $("#loadProductsMsg").html("<div class='d-flex justify-content-center'><div class='spinner-border text-secondary'></div></div>");
                    action = "inactive";
                }
            }
        });
    }

    //calling load function to intialize the tab
    if(action == "inactive"){
        action = "active";
        load_products(limit, start);    //function called
    }

    //calling laod products function on page scroll
    $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() > $("#loadProducts").height() && action == "inactive"){
            action = "active";
            start = start + limit;      //updating the starting point

            load_products(limit, start);       //function called
        }
    });
});



//EDIT PRODUCT BUTTON : functioning*******************************************
$(".wrapper").on("click", ".productEditBtn", function(){
    var currentProductId = $(this).parent().parent().attr("id");    
    var product_Id = currentProductId;
    product_Id = product_Id.replace("product", "");     //current product id no.

    //preparing the modal
    $("#uploadProductModal .modal-title").html("Edit Product");

    //preparing the form
    $("#productName").val($("#" + currentProductId + " .productName").text());
    $("#productDesc").val($("#" + currentProductId + " .productDesc").text());
    //extracting product price
    var price = $("#" + currentProductId + " .productPrice").text();
    price = price.replace("Rs ", "");
    $("#productPrice").val(price);

    //removing the required attribute from photo input
    $("#productPhoto").removeAttr("required");

    //setting up the submit button
    $("#productUploadBtn").attr("name", "productEditBtn");
    $("#productUploadBtn").html("Update");
    $("#productUploadBtn").removeClass("btn-success");
    $("#productUploadBtn").addClass("btn-info");

    //adding a hidden input field to the form to keep product id
    $("#productUploadForm").append("<input type='text' name='productId' value='" + product_Id + "' hidden>");

    //displaying the edit product modal
    $("#uploadProductModal").modal('show');

    //reloading the page to reset the modal
    $("#uploadProductModal").on("hide.bs.modal", function(){
        location.reload();
    });
});