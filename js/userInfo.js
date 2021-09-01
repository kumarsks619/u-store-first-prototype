//product owner's info******************************************************************************
$(".wrapper").on("click", ".productOwner", function(){
    var username = $(this).text();      //product owner
    var productId = $(this).parent().parent().parent().attr("id");      //current product's id
    productId = productId.replace("product", "");

    var diff_var = "productOwnerInfo";         //identifier var for ajax resource 
    $.ajax({
        url: 'assets/resources/userInfoResource.php',
        method: 'POST',
        data: {diff_var : diff_var, user : username, product_id : productId},
        cache: false,

        success: function(data){
            var userInfoString = data;
            var userInfoArray = userInfoString.split(",");      //separating values
            if(userInfoArray[0] == "fullInfo"){
                var fullName = userInfoArray[1];
                var email = userInfoArray[2];
                var phone1 = userInfoArray[3];
                var phone2 = userInfoArray[4];

                //displaying all the values in the info modal
                $("#userShortInfoModal .modal-title").html("@" + username);
                $("#userShortInfoModal .userFullName input").attr("value", fullName);
                $("#userShortInfoModal .userEmail input").attr("value", email);
                $("#userShortInfoModal .userPhone1 input").attr("value", phone1);
                $("#userShortInfoModal .userPhone2 input").attr("value", phone2);

                //hiding the message of short info
                $("#userShortInfoModal .message").hide();
            }else{
                var fullName = userInfoArray[1];
                var email = userInfoArray[2];

                //displaying all the values in the info modal
                $("#userShortInfoModal .modal-title").html("@" + username);
                $("#userShortInfoModal .userFullName input").attr("value", fullName);
                $("#userShortInfoModal .userEmail input").attr("value", email);
                $("#userShortInfoModal .userPhone1 input").attr("value", "**********");
                $("#userShortInfoModal .userPhone2 input").attr("value", "**********");

                //showing the message of short info
                $("#userShortInfoModal .message").show();
                $("#userShortInfoModal .message").html("more info will be available after your bid is accepted.");
            }
        } 
    });
});

//bid owner's info****************************************************************************************
$(".wrapper").on("click", ".bidOwner", function(){
    var username = $(this).text();      
    username = username.replace("@", "");       //bid owner
    var productId = $(this).parent().parent().parent().parent().attr("id");      //current product's id
    productId = productId.replace("product", "");    

    var diff_var = "bidOwnerInfo";         //identifier var for ajax resource
    $.ajax({
        url: 'assets/resources/userInfoResource.php',
        method: 'POST',
        data: {diff_var : diff_var, user : username, product_id : productId},
        cache: false,

        success: function(data){
            var userInfoString = data;
            var userInfoArray = userInfoString.split(",");      //separating values
            if(userInfoArray[0] == "fullInfo"){
                var fullName = userInfoArray[1];
                var email = userInfoArray[2];
                var phone1 = userInfoArray[3];
                var phone2 = userInfoArray[4];

                //displaying all the values in the info modal
                $("#userShortInfoModal .modal-title").html("@" + username);
                $("#userShortInfoModal .userFullName input").attr("value", fullName);
                $("#userShortInfoModal .userEmail input").attr("value", email);
                $("#userShortInfoModal .userPhone1 input").attr("value", phone1);
                $("#userShortInfoModal .userPhone2 input").attr("value", phone2);

                //hiding the message of short info
                $("#userShortInfoModal .message").hide();
            }else{
                var fullName = userInfoArray[1];
                var email = userInfoArray[2];

                //displaying all the values in the info modal
                $("#userShortInfoModal .modal-title").html("@" + username);
                $("#userShortInfoModal .userFullName input").attr("value", fullName);
                $("#userShortInfoModal .userEmail input").attr("value", email);
                $("#userShortInfoModal .userPhone1 input").attr("value", "**********");
                $("#userShortInfoModal .userPhone2 input").attr("value", "**********");

                //showing the message of short info
                $("#userShortInfoModal .message").show();
                $("#userShortInfoModal .message").html("more info will be available only if you accept his/her bid.");
            }
        } 
    });
});


//copy to clipboard function*****************************************************************************
function copyToClipboard(element){  
    /* Get the text field */
    var copyText = $("." + element + " input");     

    /* Select the text field */
    copyText.select();

    /* Copy the text inside the text variable */
    document.execCommand("copy");
}
