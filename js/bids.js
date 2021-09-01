/*PLACE BID**************************************************************************************** */
//PLACE BID BUTTON : add input field-----------------------------------------
$(".wrapper").on("click", ".placeBidBtn", function(){ 
    var currentProductId = $(this).parent().parent().attr('id');    //id for the current product
    $(this).hide();                                                 //hiding the place bid button
    $("#" + currentProductId + " .cancelBidBtn").show();            //showing the cancel bid button
    $("#" + currentProductId + " .collapse").collapse('show');      //expanding the bid columns

    var diff_var = "initBid";              //for using as an identifier in ajax resource
    $.ajax({
        url: 'assets/resources/placeBidResource.php',
        method: 'POST',
        data: {diff_var : diff_var},
        cache: false,

        success: function(data){
            $("#" + currentProductId + " ul").append(data);     //displaying the input field

            //restricting undesirable keys in bid's price input field
            $("input[type='number']").keypress(function(key){
                if(key.charCode < 48 || key.charCode > 57){
                    return false;
                }
            });

            //toggling the place bid done button
            $("#" + currentProductId + " .newBid input").keyup(function(){
                var user_input = $(this).val();    

                if(user_input > 0 && user_input <= 50000){
                    $("#" + currentProductId + " .newBid button").removeAttr("disabled");
                }else{
                    $("#" + currentProductId + " .newBid button").attr("disabled", "disabled");
                }
            }).change(function(){
                var user_input = $(this).val();    

                if(user_input > 0 && user_input <= 50000){
                    $("#" + currentProductId + " .newBid button").removeAttr("disabled");
                }else{
                    $("#" + currentProductId + " .newBid button").attr("disabled", "disabled");
                }
            });

            //placing bid on click the done button
            $("#" + currentProductId + " .newBid button").click(function(){
                var product_Id = currentProductId;     //current product id no.
                var user_input = parseInt($("#" + currentProductId + " .newBid input").val());  //user's input bid value
                var owner = $("#" + currentProductId + " .card-header a").text();     //owner's username
                var product_name = $("#" + currentProductId + " .productName").text();  //product name

                var diff_var = "submitBid";         //for using as an identifier in ajax resource
                $.ajax({
                    url: 'assets/resources/placeBidResource.php',
                    method: 'POST',
                    data: { diff_var : diff_var,
                            product_Id : product_Id,
                            bid_val : user_input, 
                            owner : owner,
                            product_name : product_name
                        },
                    cache: false,

                    success: function(data){
                        $("#" + currentProductId + " ul li").last().remove();  //removing the place bid input field
                        $("#" + currentProductId + " .cancelBidBtn").hide();     //hiding the cancel bid button(on first the bid placement)
                        $("#" + currentProductId + " ul").append(data);     //displaying the newley placed bid
                    }
                });
            });
        }
    });
});

//CANCEL BID BUTTON : remove the input field
$(".wrapper").on("click", ".cancelBidBtn", function(){
    var currentProductId = $(this).parent().parent().attr('id');    //id for the current product
    $("#" + currentProductId + " ul li").last().remove();           //removing the place bid input field
    $(this).hide();                                                 //hiding the cancel button
    $("#" + currentProductId + " .placeBidBtn").show();             //showing the place bid button again
});


//BIDS MODIFICATION****************************************************************************************
//EDIT BID BUTTON : convert the bid column into input field 
$(".wrapper").on("click", ".editBidBtn", function(){
    var currentProductId = $(this).parent().parent().parent().parent().attr('id'); //id for the current product
    var bidValueString = $(this).siblings(".bidValue").text();  //bid value with "Rs"
    var bidValue = bidValueString.replace("Rs ", "");           //bid value (integer only)

    var elementUnderUsage = $(this);        //selector for the clicked button(current editBidBtn)
    
    var diff_var = "editBid";           //for using as an identifier in ajax resource
    $.ajax({   
        url: 'assets/resources/placeBidResource.php',
        method: 'POST',
        data: {diff_var : diff_var, bid_val : bidValue},
        cache: false,

        success: function(data){
            elementUnderUsage.siblings().hide();    //hiding all the siblings of the editBidBtn
            elementUnderUsage.hide();               //hiding editBidBtn itself
            //removing classes from current li to style the new elements accordingly
            elementUnderUsage.parent().removeClass("d-flex flex-wrap align-items-center");
            
            elementUnderUsage.parent().append(data);  //adding the edit bid input field

            //restricting undesirable keys in bid's price input field
            $("input[type='number']").keypress(function(key){
                if(key.charCode < 48 || key.charCode > 57){
                    return false;
                }
            });

            //adding a class to the active li to address its children
            elementUnderUsage.parent().addClass("activeLi");

            //toggling the edit bid done button
            $("#" + currentProductId + " .activeLi input").keyup(function(){
                var user_input = $(this).val();      

                if(user_input > 0 && user_input <= 50000){
                    $("#" + currentProductId + " .activeLi .bidEditDoneBtn").removeAttr("disabled");
                }else{
                    $("#" + currentProductId + " .activeLi .bidEditDoneBtn").attr("disabled", "disabled");
                }
            }).change(function(){ 
                var user_input = $(this).val();      

                if(user_input > 0 && user_input <= 50000){
                    $("#" + currentProductId + " .activeLi .bidEditDoneBtn").removeAttr("disabled");
                }else{
                    $("#" + currentProductId + " .activeLi .bidEditDoneBtn").attr("disabled", "disabled");
                }
            });


            //CANCEL BUTTON : replaces the input field with the already placed bid column--------------------
            $("#" + currentProductId + " .activeLi .cancelBidEditBtn").click(function(){
                //removing the edit bid input field
                $(this).parent().parent().parent().remove();

                //restoring the already placed bid
                elementUnderUsage.siblings().show();    //unhiding all the siblings of the editBidBtn
                elementUnderUsage.show();               //unhiding editBidBtn itself
                elementUnderUsage.parent().addClass("d-flex flex-wrap align-items-center"); //adding the removed classes from current li
            });


            //SUBMIT BUTTON : modifies the database and replaces the input field with editted bid column
            $("#" + currentProductId + " .activeLi .bidEditDoneBtn").click(function(){
                var user_input = $("#" + currentProductId + " .activeLi input").val();  //new bid value
                var product_Id = currentProductId;
                product_Id = product_Id.replace("product", "");     //current product id no.
                var product_name = $("#" + currentProductId + " .productName").text();  //product name
                var owner = $("#" + currentProductId + " .card-header a").text();     //owner's username
                
                var diff_var = "submitEdittedBid";          //for using as an identifier in ajax resource
                $.ajax({
                    url: 'assets/resources/placeBidResource.php',
                    method: 'POST',
                    data: { diff_var : diff_var,
                            new_bid_val : user_input,
                            product_Id : product_Id,
                            product_name : product_name,
                            owner : owner
                        },
                    cache: false,

                    success: function(data){
                        elementUnderUsage.parent().addClass("d-flex flex-wrap align-items-center"); //adding the removed classes from current li
                        $("#" + currentProductId + " .activeLi").html(data);    //showing the editted bid column
                    }
                });
            });

        }
    });
    //removing the extra added class "activeLi" when everything is done
    $("#" + currentProductId + " .activeLi").removeClass("activeLi");
});


//BIDS ACTION BUTTONS : for owner************************************************************************
//ACCEPT BID BUTTON : update the database and turn the particular bid column green
$(".wrapper").on("click", ".acceptBidBtn", function(){
    var currentProductId = $(this).parent().parent().parent().parent().attr('id'); //id for the current product
    var product_Id = currentProductId;
    product_Id = product_Id.replace("product", "");     //current product id no.
    var bid_by = $(this).siblings("a").text();          //current bid by
    bid_by = bid_by.replace("@", "");                   //removing the "@" sign from username
    var bid_val = $(this).siblings(".bidValue").text();          //current bid value with "Rs"
    var owner = $("#" + currentProductId + " .productOwner").text();    //product owner
    var product_name = $("#" + currentProductId + " .productName").text();  //product name

    var elementUnderUsage = $(this);        //element clicked(accept bid button)

    var diff_var = "acceptBid";             //for using as an identifier in ajax resource
    $.ajax({
        url: 'assets/resources/placeBidResource.php',
        method: 'POST',
        data: { diff_var : diff_var,
                product_Id : product_Id,
                bid_by : bid_by,
                bid_val : bid_val,
                owner : owner,
                product_name : product_name
            },
        cache: false,

        success: function(){
            //changing css of the current bid column
            elementUnderUsage.parent().addClass("border border-success rounded");
            elementUnderUsage.parent().css({"background-color" : "#d4edda"});

            elementUnderUsage.remove();          //removing the current accept bid button
        }
    });
});

//REJECT BID BUTTON : delete the current bid and replaces the column with an undo button
$(".wrapper").on("click", ".rejectBidBtn", function(){
    var currentProductId = $(this).parent().parent().parent().parent().attr('id'); //id for the current product
    var product_Id = currentProductId;
    product_Id = product_Id.replace("product", "");     //current product id no.
    var bid_by = $(this).siblings("a").text();          //current bid by
    bid_by = bid_by.replace("@", "");                   //removing the "@" sign from username
    var bid_val = $(this).siblings(".bidValue").text();          //current bid value with "Rs"
    bid_val = bid_val.replace("Rs ", "");                        //current bid integer value
    var owner = $("#" + currentProductId + " .productOwner").text();    //product owner
    var product_name = $("#" + currentProductId + " .productName").text();  //product name

    var notiId = "";        //notification id var for undo function 

    var elementUnderUsage = $(this);        //element clicked(reject bid button)

    var diff_var = "rejectBid";         //for using as an identifier in ajax resource
    $.ajax({
        url: 'assets/resources/placeBidResource.php',
        method: 'POST',
        data: { diff_var : diff_var,
                product_Id : product_Id,
                bid_by : bid_by,
                owner : owner,
                product_name : product_name,
            },
        cache: false,

        success: function(data){
            elementUnderUsage.parent().replaceWith("<div class='alert alert-secondary alert-dismissible fade show m-0'><button class='btn btn-secondary btn-sm btn-block undoBidRejectBtn'>UNDO</button><button type='button' class='close' data-dismiss='alert'><span>&times;</span></button></div>");
            notiId = data;      //notification id for undo function
        }
    });

    //UNDO REJECTED BID BUTTON : display the current bid again and re-add the bid to database
    $(".wrapper").on("click", ".undoBidRejectBtn", function(){
        var elementUnderUsage = $(this);        //element clicked(undo bid reject button)

        var diff_var = "undoBidReject";
        $.ajax({
            url: 'assets/resources/placeBidResource.php',
            method: 'POST',
            data: { diff_var : diff_var,
                    product_Id : product_Id,
                    bid_by : bid_by,
                    bid_val : bid_val,
                    notiId : notiId,
                },
            cache: false,

            success: function(data){
                elementUnderUsage.parent().replaceWith(data);   //replacing the undo column with the re-added bid column        
            }
        });
    });
})


//DELETE BID BUTTON : delete the current bid and removes the column as well
$(".wrapper").on("click", ".deleteBidBtn", function(){
    var currentProductId = $(this).parent().parent().parent().parent().attr("id");      //current product id
    var product_Id = currentProductId;
    product_Id = product_Id.replace("product", "");     //current product id no.
    var bid_by = $(this).siblings(".bidBy").text();          //current bid by
    bid_by = bid_by.replace("@", "");                   //removing the "@" sign from username
    console.log(product_Id, bid_by);
    var elementUnderUsage = $(this);        //element clicked(edit bid button)

    var diff_var = "deleteBid";             //for using as an identifier in ajax resource
    $.ajax({
        url: 'assets/resources/placeBidResource.php',
        method: 'POST',
        data: { diff_var : diff_var,
                product_Id : product_Id,
                bid_by : bid_by},
        cache: false,

        success: function(){
            elementUnderUsage.parent().remove();    //deleting the current bid column
        }
    });
});


//********************************************************************************************************* */
//DELETE PRODUCT BUTTON : completly remove the current product's card and delete the product and all the associated bids
$(".wrapper").on("click", ".deleteProductBtn", function(){
    var currentProductId = $(this).parent().parent().attr("id");      //current product id
    var product_Id = currentProductId;
    product_Id = product_Id.replace("product", "");     //current product id no.
    var timeMsg = $(this).siblings("small").text();     //time message
    var product_name = $("#" + currentProductId + " .productName").text();  //product name

    //displaying the confirmation prompt in the card footer
    $(this).parent().html("<button class='btn btn-danger btn-sm btn-block mr-1 confirmProductDeleteBtn'>Confirm Delete</button><button class='btn btn-secondary btn-sm cancelProductDeleteBtn'>Cancel</button>");

    //if confirm button is pressed
    $(".wrapper").on("click", ".confirmProductDeleteBtn", function(){
        var diff_var = "deleteProduct";             //for using as an identifier in ajax resource
        $.ajax({
            url: 'assets/resources/placeBidResource.php',
            method: 'POST',
            data: { diff_var : diff_var,
                    product_Id : product_Id,
                    product_name : product_name
                },
            cache: false,
    
            success: function(){
                $("#" + currentProductId).remove();    //deleting the complete product card
                //FIX : for notification tab
                var path = window.location.pathname;
                if(path.search("noti.php") != -1){ 
                    $("#notiPreview").html("<div class='alert alert-secondary mx-4 mt-3'>Product deleted !!!</div>");
                }
            }
        });
    });
    
    //if cancel button is pressed
    $(".wrapper").on("click", ".cancelProductDeleteBtn", function(){ 
        $(this).parent().html("<small class='text-muted mr-auto'>" + timeMsg + "</small><button class='btn btn-danger btn-sm deleteProductBtn' title='delete product'>Delete</button>");
    });
});