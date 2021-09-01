var selectCityPerfectOnce = 0;         //fix variable when only state and city is selected
var selectCollegePerfectOnce = 0;      //fix variable when only state, city and college is selected
var confirmPwPerfectOnce = 0;          //fix variable when the password is confirmed once
var phone2PerfectOnce = 0;             //fix variable when the phone2 is field turns green


//ajax function for first name, last name, username, email, select collage name and password1
function fetch_errno(element_Id, input_value){
    $.ajax({
        url: 'assets/handlers/signUpFormHandler.php',
        method: 'POST',
        data: {Id : element_Id, user_input : input_value},
        cache: false,

        success: function(data){
            //separating error no. and error string
            var errno_PLUS_errorString = data.split(":");
            var errno = errno_PLUS_errorString[0];
            var errorString = errno_PLUS_errorString[1];

            //sending error inside html to print when required
            if(errno == 1){
                $("#" + element_Id).next().html(errorString);
                $("#" + element_Id).next().next().empty();

                //updating fix variable
                if(element_Id == "selectCollege"){
                    selectCollegePerfectOnce = 1;      //when college name input turns green
                }
            }else{
                $("#" + element_Id).next().next().html(errorString);
                $("#" + element_Id).next().empty();

                //updating fix variable
                if(element_Id == "selectCollege"){
                    selectCollegePerfectOnce = 0;      //if there is an error
                }
            }
           
            //adding class to display error
            if(errno == 1){
                $("#" + element_Id).addClass("is-valid");
                if($("#" + element_Id).hasClass("is-invalid") == true){
                    $("#" + element_Id).removeClass("is-invalid");
                }
            }else{
                $("#" + element_Id).addClass("is-invalid");
                if($("#" + element_Id).hasClass("is-valid") == true){
                    $("#" + element_Id).removeClass("is-valid");
                }
            }
        }
    });
}


//ajax function for avatar
function fetch_errno_avatar(element_Id, input_value){
    $.ajax({
        url: 'assets/handlers/signUpFormHandler.php',
        method: 'POST',
        data: {Id : element_Id, avatar_value : input_value},
        cache: false,

        success: function(data){
            //separating error no. and error string
            var errno_PLUS_errorString = data.split(":");
            var errno = errno_PLUS_errorString[0];
            var errorString = errno_PLUS_errorString[1];

            //sending error inside html to print when required
            if(errno == 1){
                $("#avatarFeedback").html(errorString);
                $("#avatarFeedback").css({"color": "#28a745", "font-size": "0.8rem"});
                //styling button for no errors
                if($("#avatarBtn").hasClass("btn-outline-secondary") == true){
                    $("#avatarBtn").removeClass("btn-outline-secondary");
                    $("#avatarBtn").addClass("btn-outline-success");
                }else if($("#avatarBtn").hasClass("btn-outline-danger") == true){
                    $("#avatarBtn").removeClass("btn-outline-danger");
                    $("#avatarBtn").addClass("btn-outline-success");
                }
            }else{
                $("#avatarFeedback").html(errorString);
                $("#avatarFeedback").css({"color": "#dc3545", "font-size": "0.8rem"});
                //styling button for errors
                if($("#avatarBtn").hasClass("btn-outline-secondary") == true){
                    $("#avatarBtn").removeClass("btn-outline-secondary");
                    $("#avatarBtn").addClass("btn-outline-danger");
                }else if($("#avatarBtn").hasClass("btn-outline-success") == true){
                    $("#avatarBtn").removeClass("btn-outline-success");
                    $("#avatarBtn").addClass("btn-outline-danger");
                }
            }
        }
    });
}


//ajax function for primary phone and toggling secondary phone input
function fetch_errno_phone1_toggle_phone2(element_Id, input_value){
    $.ajax({
        url: 'assets/handlers/signUpFormHandler.php',
        method: 'POST',
        data: {Id : element_Id, user_input : input_value},
        cache: false,

        success: function(data){
            //separating error no. and error string
            var errno_PLUS_errorString = data.split(":");
            var errno = errno_PLUS_errorString[0];          //contains error no.
            var errorString = errno_PLUS_errorString[1];    //contains error string

            //sending error inside html to print when required
            if(errno == 1){
                $("#" + element_Id).next().html(errorString);
                $("#" + element_Id).next().next().empty();
                //enabling secondary phone input
                if(document.getElementById("phone2").hasAttribute("disabled") == true){
                    $("#phone2").removeAttr("disabled");
                } 
            }else{
                $("#" + element_Id).next().next().html(errorString);
                $("#" + element_Id).next().empty();
                //disabling secondary phone input
                if(document.getElementById("phone2").hasAttribute("disabled") == false){
                    $("#phone2").attr("disabled", "disabled");
                }
            }
           
            //adding class to display error
            if(errno == 1){
                $("#" + element_Id).addClass("is-valid");
                if($("#" + element_Id).hasClass("is-invalid") == true){
                    $("#" + element_Id).removeClass("is-invalid");
                }
            }else{
                $("#" + element_Id).addClass("is-invalid");
                if($("#" + element_Id).hasClass("is-valid") == true){
                    $("#" + element_Id).removeClass("is-valid");
                }
            }
        }
    });
}


//ajax function for secondary phone number
function fetch_errno_phone2(element_Id, input_value, req_input_value){
    $.ajax({
        url: 'assets/handlers/signUpFormHandler.php',
        method: 'POST',
        data: {Id : element_Id, user_input : input_value, req_user_input : req_input_value},
        cache: false,

        success: function(data){
            //separating error no. and error string
            var errno_PLUS_errorString = data.split(":");
            var errno = errno_PLUS_errorString[0];
            var errorString = errno_PLUS_errorString[1];

            //sending error inside html to print when required
            if(errno == 1){
                $("#" + element_Id).next().html(errorString);
                $("#" + element_Id).next().next().empty();
                //updating fix variable
                phone2PerfectOnce = 1;
            }else{
                $("#" + element_Id).next().next().html(errorString);
                $("#" + element_Id).next().empty();
            }
           
            //adding class to display error
            if(errno == 1){
                $("#" + element_Id).addClass("is-valid");
                if($("#" + element_Id).hasClass("is-invalid") == true){
                    $("#" + element_Id).removeClass("is-invalid");
                }
            }else{
                $("#" + element_Id).addClass("is-invalid");
                if($("#" + element_Id).hasClass("is-valid") == true){
                    $("#" + element_Id).removeClass("is-valid");
                }
            }
        }
    });
}
 



//ajax function for college state and collage city
function fetch_errno_college_state_and_city(element_Id, input_value, req_element_Id){
    var req_Id = req_element_Id;
    $.ajax({
        url: 'assets/handlers/signUpFormHandler.php',
        method: 'POST',
        data: {Id: element_Id, user_input: input_value},
        cache: false,

        success: function(data){
            //separating error no. and error string
            var errno_PLUS_errorString = data.split(":");
            var errno = errno_PLUS_errorString[0];
            var errorString = errno_PLUS_errorString[1];

            if(errno == 1){
                //enabling next select field
                if(document.getElementById(req_Id).hasAttribute("disabled") == true){
                    $("#" + req_Id).removeAttr("disabled");
                    //sending error inside html to print when required
                    $("#" + element_Id).next().html(errorString);
                    $("#" + element_Id).next().next().empty();
                    //adding class to display error
                    $("#" + element_Id).addClass("is-valid");
                    if($("#" + element_Id).hasClass("is-invalid") == true){
                        $("#" + element_Id).removeClass("is-invalid");
                    }
                    //updating fix variable
                    if(element_Id == "selectCity"){
                        selectCityPerfectOnce = 1;      //when city input turns green
                    }
                }
            }else{
                //disabling next select field
                if(document.getElementById(req_Id).hasAttribute("disabled") == false){
                    $("#" + req_Id).attr("disabled", "disabled");
                    //sending error inside html to print when required
                    $("#" + element_Id).next().next().html(errorString);
                    $("#" + element_Id).next().empty();
                    //adding class to display error
                    $("#" + element_Id).addClass("is-invalid");
                    if($("#" + element_Id).hasClass("is-valid") == true){
                        $("#" + element_Id).removeClass("is-valid");
                    }
                }else{
                     //sending error inside html to print when required
                     $("#" + element_Id).next().next().html(errorString);
                     $("#" + element_Id).next().empty();
                     //adding class to display error
                     $("#" + element_Id).addClass("is-invalid");
                     if($("#" + element_Id).hasClass("is-valid") == true){
                         $("#" + element_Id).removeClass("is-valid");
                     }
                }
                //reseting fix variable
                if(element_Id == "selectCity"){
                    selectCityPerfectOnce = 0;      //if there is an error
                }
            }
        }
    });
}



//ajax function for confirm password
function fetch_errno_password2(element_Id, input_value, req_input_value){
    $.ajax({
        url: 'assets/handlers/signUpFormHandler.php',
        method: 'POST',
        data: {Id : element_Id, user_input : input_value, req_user_input : req_input_value},
        cache: false,

        success: function(data){
            //separating error no. and error string
            var errno_PLUS_errorString = data.split(":");
            var errno = errno_PLUS_errorString[0];
            var errorString = errno_PLUS_errorString[1];

            //sending error inside html to print when required
            if(errno == 1){
                $("#" + element_Id).next().next().html(errorString);
                $("#" + element_Id).next().next().next().empty();
                //updating fix variable
                confirmPwPerfectOnce = 1;       //when the both the password fields turn green
            }else{
                $("#" + element_Id).next().next().next().html(errorString);
                $("#" + element_Id).next().next().empty();
            }
           
            //adding class to display error
            if(errno == 1){
                $("#" + element_Id).addClass("is-valid");
                if($("#" + element_Id).hasClass("is-invalid") == true){
                    $("#" + element_Id).removeClass("is-invalid");
                }
            }else{
                $("#" + element_Id).addClass("is-invalid");
                if($("#" + element_Id).hasClass("is-valid") == true){
                    $("#" + element_Id).removeClass("is-valid");
                }
            }
        }
    });
}



//ajax function to toggle the sign up button
function signUp_btn_toggle(){   
    var element_Id = "signUpNavBtn";
    var btn_state = signUpBtnCurrentState;     
    $.ajax({
        url: 'assets/handlers/signUpFormHandler.php',
        method: 'POST',
        data: { Id : element_Id, btn_current_state : btn_state},
        cache: false,

        success: function(data){
            if(data == 1){
                signUpBtnCurrentState = 1;      
            }else{
                signUpBtnCurrentState = 0;      
            }
            //finally toggling the button
            if(signUpBtnCurrentState == 1){
                if(document.getElementById("signUp").hasAttribute("disabled") == true){
                    $("#signUp").removeAttr("disabled");
                    $("#signUp").css("cursor", "pointer");     //changing the cursor
                }   
            }else{
                if(document.getElementById("signUp").hasAttribute("disabled") == false){
                    $("#signUp").attr("disabled", "disabled");
                    $("#signUp").css("cursor", "no-drop");      //changing the cursor
                }      
            }
        }
    });
    signUpBtnCurrentState = 0;
}



//FIX: ajax function to reset the select inputs errno session variables
function reset_select_input_errnos(reset_value){
    var reset = reset_value;
    $.ajax({
        url: 'assets/resources/signUpFormFix.php',
        method: 'POST',
        data: {reset_var: reset},
        cache: false,
    });
} 