// UPLOAD PRODUCT FORM functions******************************************************************************
function progressBarWorking(){
    var currentWidth = parseInt($("#uploadProgressBar .progress-bar").css("width"));
    var totalWidth = parseInt($("#uploadProgressBar").css("width"));

    var progressPercentage = currentWidth / totalWidth * 100; 

    var increaseBy = 2;

    var progressPercentage = progressPercentage + increaseBy;

    if(progressPercentage <= 95){
        //changing the bar css
        $("#uploadProgressBar .progress-bar").css("width", progressPercentage + "%");
    }
    
}


//EDIT PROFILE FORM functions**********************************************************************
var confirmNewPwPerfectOnce = 0;          //fix variable when the password is confirmed once

//error fetching fucntions for first name, last name, email and phone1
function fetch_errno(element_Id, input_val){
    $.ajax({
        url: 'assets/resources/profileEditFormFetchErrno.php',
        method: 'POST',
        data: {Id: element_Id, user_input: input_val},
        cache: false,

        success: function(data){
            //separating error no. and error string
            var errno_PLUS_errorString = data.split(":");
            var errno = errno_PLUS_errorString[0];
            var errorString = errno_PLUS_errorString[1];

            //sending error inside html to print when required
            if(errno == 1){
                $("#" + element_Id + " .invalid-feedback").empty();
            }else{
                $("#" + element_Id + " .invalid-feedback").html(errorString);
            }
           
            //adding class to display error
            if(errno == 1){
                $("#" + element_Id + " .form-control").addClass("is-valid");
                if($("#" + element_Id + " .form-control").hasClass("is-invalid") == true){
                    $("#" + element_Id + " .form-control").removeClass("is-invalid");
                }
            }else{
                $("#" + element_Id + " .form-control").addClass("is-invalid");
                if($("#" + element_Id + " .form-control").hasClass("is-valid") == true){
                    $("#" + element_Id + " .form-control").removeClass("is-valid");
                }
            }

            //toggling the submit button
            if(errno == 1){
                $("#" + element_Id + " .doneBtn").removeAttr("disabled");
            }else{
                $("#" + element_Id + " .doneBtn").attr("disabled", "disabled");
            }
        }
    });
}
//error fetching functions for phone2
function fetch_errno_phone2(element_Id, input_val, req_val){
    $.ajax({
        url: 'assets/resources/profileEditFormFetchErrno.php',
        method: 'POST',
        data: {Id: element_Id, user_input: input_val, req_user_input: req_val},
        cache: false,

        success: function(data){
            //separating error no. and error string
            var errno_PLUS_errorString = data.split(":");
            var errno = errno_PLUS_errorString[0];
            var errorString = errno_PLUS_errorString[1];

            //sending error inside html to print when required
            if(errno == 1){
                $("#" + element_Id + " .invalid-feedback").empty();
            }else{
                $("#" + element_Id + " .invalid-feedback").html(errorString);
            }
           
            //adding class to display error
            if(errno == 1){
                $("#" + element_Id + " .form-control").addClass("is-valid");
                if($("#" + element_Id + " .form-control").hasClass("is-invalid") == true){
                    $("#" + element_Id + " .form-control").removeClass("is-invalid");
                }
            }else{
                $("#" + element_Id + " .form-control").addClass("is-invalid");
                if($("#" + element_Id + " .form-control").hasClass("is-valid") == true){
                    $("#" + element_Id + " .form-control").removeClass("is-valid");
                }
            }

            //toggling the submit button
            if(errno == 1){
                $("#" + element_Id + " .doneBtn").removeAttr("disabled");
            }else{
                $("#" + element_Id + " .doneBtn").attr("disabled", "disabled");
            }
        }
    });
}
//error fetching functions for new password 2
function fetch_errno_new_pw2(element_Id, input_val, req_val){
    $.ajax({
        url: 'assets/resources/profileEditFormFetchErrno.php',
        method: 'POST',
        data: {Id: element_Id, user_input: input_val, req_user_input: req_val},
        cache: false,

        success: function(data){
            //separating error no. and error string
            var errno_PLUS_errorString = data.split(":");
            var errno = errno_PLUS_errorString[0];
            var errorString = errno_PLUS_errorString[1];

            //sending error inside html to print when required
            if(errno == 1){
                $("#" + element_Id + " .invalid-feedback").empty();
                //updating fix variable
                confirmNewPwPerfectOnce = 1;       //when the both the password fields turn green
            }else{
                $("#" + element_Id + " .invalid-feedback").html(errorString);
            }
           
            //adding class to display error
            if(errno == 1){
                $("#" + element_Id + " .form-control").addClass("is-valid");
                if($("#" + element_Id + " .form-control").hasClass("is-invalid") == true){
                    $("#" + element_Id + " .form-control").removeClass("is-invalid");
                }
            }else{
                $("#" + element_Id + " .form-control").addClass("is-invalid");
                if($("#" + element_Id + " .form-control").hasClass("is-valid") == true){
                    $("#" + element_Id + " .form-control").removeClass("is-valid");
                }
            }

            //toggling the submit button
            if(errno == 1){
                $("#changePwBtn").removeAttr("disabled");
            }else{
                $("#changePwBtn").attr("disabled", "disabled");
            }
        }
    });
}



//values updating function
function update_profile(element_Id, input_val){
    $.ajax({
        url: 'assets/handlers/profileEditFormHandler.php',
        method: 'POST',
        data: {Id: element_Id, user_input: input_val},
        cache: false,

        success: function(data){
            //displaying the success message
            $("#" + element_Id + " .valid-feedback").html(data);
            $("#" + element_Id + " .form-control").addClass("is-valid");

            //hiding the action buttons
            $("#" + element_Id + " .editBtnDiv").removeClass("d-none");
            $("#" + element_Id + " .actionBtns").addClass("d-none");
            $("#" + element_Id + " .form-control").attr("readonly", "readonly");
        }
    });
}