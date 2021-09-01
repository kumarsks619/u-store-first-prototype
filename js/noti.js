//to show notification preview when a notification is clicked
$("#notiWrapper").on("click", ".notiProductName", function(){ 
    var productId = $(this).attr("id");
    productId = productId.replace("product", "");       //product id of the clicked notification

    //adding a loading icon until the preview is loaded
    $("#notiPreview").html("<div class='d-flex justify-content-center mt-2'><div class='spinner-border text-secondary'></div></div>");

    var diff_var = "notiPreview";       //identifier variable for ajax resource
    $.ajax({
        url: 'assets/resources/notiResource.php',
        method: 'POST',
        data: {diff_var : diff_var, productId : productId},
        cache: false,

        success: function(data){
            $("#notiPreview").html(data);
        }
    });
});

//to delete the notification when cross button is clicked
$("#notiWrapper").on("click", ".notiDeleteBtn", function(){ 
    var notiId = $(this).parent().parent().attr("id");
    notiId = notiId.replace("noti", "");       //product id of the clicked notification

    var diff_var = "notiDelete";       //identifier variable for ajax resource
    $.ajax({
        url: 'assets/resources/notiResource.php',
        method: 'POST',
        data: {diff_var : diff_var, notiId : notiId},
        cache: false,

        success: function(data){
            if(data != ""){
                $("#notiWrapper").html(data);       //displaying the "all caught up message"
                $("#notiPreview").html("");          //deleting the noti preview(if any)
            }
        }
    });
});


//FIX : if there is no notification then hiding the preview message
if($("#notiWrapper .alert").text() == "No notifications. You're all caught up !"){
    $("#notiPreview .alert").hide();
}else{
    $("#notiPreview .alert").show();
}


//Show feedback when a notification is clicked 
$(".wrapper").on("click", ".toast", function(){
    //checking if any noti is already active or not
    if($(".toast").hasClass("activeNoti") == true){  
        $(".activeNoti").css({      
            "border" : "1px solid #d0d0d0"      //reseting the previously active noti
        });
        $(".activeNoti").removeClass("activeNoti");     //removing active class
    }

    $(this).addClass("activeNoti");         //adding active class to  currently clicked noti        
    $(".activeNoti").css({
        "border" : "1px solid #5e6265"      //adding feedback css
    });
});