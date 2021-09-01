//enabling the bootstrap tooltip
$(function(){
    $('[data-toggle="tooltip"]').tooltip();
});


// correction for GET STARTED button address
$(document).ready(function(){
    $(".getStarted").click(function(){
        var navHeight = $("nav").css("height");
        var navHeightValue = parseInt(navHeight);
        var correction = (navHeightValue - 50) + "px";
        $("#featLocation").css("height", correction);     
    });
});

/************************************************************************************************************** */
//SIGN UP FORM

let collegeNameMsgId;       //variable to store the timer ID for "cant find college message"

//IN SIGN UP FORM: to change the avatar button's content after an avatar is selected
$("input[name='avatarRadio']").change(function(){
    var avatarValue = $("input[name='avatarRadio']:checked").val();
    var avatarImgPath = "assets/img/avatars/avatar" + avatarValue + ".png";
    $("#selectAvatar button").html("<img src='" + avatarImgPath + "' class='img-fluid rounded' height=20 width=20> Your Avatar");
});

//IN SIGN UP FORM: fetch cities on the basis of state selected
$("#selectState").change(function(){
    var stateName = $("#selectState option:selected").text();   //state selected

    $.post("assets/resources/signUpFormCityUpdate.php", {
        stateName: stateName
    }, function(data){
        $("#selectCity").html(data);
    });
});

//IN SIGN UP FORM: fetch colleges on the basis of city selected
$("#selectCity").change(function(){
    var stateName = $("#selectState option:selected").text();   //state selected
    var cityName = $("#selectCity option:selected").text();     //city selected

    $.post("assets/resources/signUpFormCollegeUpdate.php", {
        cityName: cityName, stateName : stateName
    }, function(data){
        $("#selectCollege").html(data);
    });
});


//SIGN UP FORM: allowing only numbers in the phone number fields
$("#phone1, #phone2").keypress(function(key){
    if(key.charCode < 48 || key.charCode > 57){
        return false;
    }
});

//SIGN UP FORM: fetching errors using ajax request
//calling ajax for first name
$("#firstName").keyup(function(){
    var elementId = $(this).attr('id');
    var userInput = $(this).val();
    
    fetch_errno(elementId, userInput);
}).focus(function(){
    var elementId = $(this).attr('id');
    var userInput = $(this).val();
    
    fetch_errno(elementId, userInput);
});


//calling ajax for last name
$("#lastName").keyup(function(){
    var elementId = $(this).attr('id');
    var userInput = $(this).val();
    
    fetch_errno(elementId, userInput);
}).focus(function(){
    var elementId = $(this).attr('id');
    var userInput = $(this).val();
    
    fetch_errno(elementId, userInput);
});


//calling ajax for username
$("#usernameSignUp").keyup(function(){
    var elementId = $(this).attr('id');
    var userInput = $(this).val();
    
    fetch_errno(elementId, userInput);
}).focus(function(){
    var elementId = $(this).attr('id');
    var userInput = $(this).val();
    
    fetch_errno(elementId, userInput);
});



//calling ajax for avatar
$("#avatarDropdown label").click(function(){
    var avatarValue = $(this).prev().val(); 
    var elementId = "selectAvatar";

    fetch_errno_avatar(elementId, avatarValue);
});
$("#avatarBtn").click(function(){
    var avatarValue = $("#avatarDropdown input[type='radio']:checked").val();
    var elementId = "selectAvatar";

    fetch_errno_avatar(elementId, avatarValue);
}).focus(function(){
    var avatarValue = $("#avatarDropdown input[type='radio']:checked").val();
    var elementId = "selectAvatar";

    fetch_errno_avatar(elementId, avatarValue);
});  


//calling ajax for email
$("#email").keyup(function(){
    var elementId = $(this).attr('id');
    var userInput = $(this).val();
    
    fetch_errno(elementId, userInput);
}).focus(function(){
    var elementId = $(this).attr('id');
    var userInput = $(this).val();
    
    fetch_errno(elementId, userInput);
});



//calling ajax for primary phone number
$("#phone1").keyup(function(){
    var elementId = $(this).attr('id');
    var userInput = $(this).val();

    //FIX: if phone1 is modified again after both the phone fields have already turned green
    if(phone2PerfectOnce == 1){
        var phone2_val = $("#phone2").val();     //phone2 input value

        //again calling the phone2 fetch errors fucntion to re-fetch the errors
        fetch_errno_phone2("phone2", phone2_val, userInput);
    }
    
    fetch_errno_phone1_toggle_phone2(elementId, userInput);
}).focus(function(){
    var elementId = $(this).attr('id');
    var userInput = $(this).val();
    
    fetch_errno_phone1_toggle_phone2(elementId, userInput);
});



//calling ajax for secondary phone number
$("#phone2").keyup(function(){
    var elementId = $(this).attr('id');
    var userInput = $(this).val();
    var reqUserInput = $("#phone1").val();
    
    fetch_errno_phone2(elementId, userInput, reqUserInput);
}).focus(function(){
    var elementId = $(this).attr('id');
    var userInput = $(this).val();
    var reqUserInput = $("#phone1").val();
    
    fetch_errno_phone2(elementId, userInput, reqUserInput);
});



//calling ajax for college state
$("#selectState").focus(function(){
    var elementId = $(this).attr('id');
    var userInput = $("#selectState option:selected").text();
    var req_element_Id = "selectCity";     
    
    fetch_errno_college_state_and_city(elementId, userInput, req_element_Id);
}).change(function(){
    var elementId = $(this).attr('id');
    var userInput = $("#selectState option:selected").text();   
    var req_element_Id = "selectCity";

    fetch_errno_college_state_and_city(elementId, userInput, req_element_Id);

    //FIX: resetting the city input if the state is changed again 
    if(selectCityPerfectOnce == 1){ 
        selectCityPerfectOnce = 0;          //resetting variable if the prev input is changed again

        $("#selectCity").next().empty();    //removing the "all good!" feedback
        $("#selectCity").removeClass("is-valid");   //removing the feedback display class
        $("#selectCollege").attr("disabled", "disabled");   //disabling the select college name input field

        //calling ajax function
        reset_select_input_errnos("resetState");     //resetting errno session variables
    }

    //FIX: resetting both city and college name input if the state is changed again 
    if(selectCollegePerfectOnce == 1){ 
        selectCollegePerfectOnce = 0;          //resetting variable if the prev input is changed again
        //resetting city input
        $("#selectCity").next().empty();    //removing the "all good!" feedback
        $("#selectCity").removeClass("is-valid");   //removing the feedback display class
        //resetting college name input
        $("#selectCollege").next().empty();    //removing the "all good!" feedback
        $("#selectCollege").removeClass("is-valid");   //removing the feedback display class
        $("#selectCollege").html("<option selected disabled>Select College</option>");  //resetting selected option
        $("#selectCollege").attr("disabled", "disabled");   //disabling the select college name input field

        //calling ajax function
        reset_select_input_errnos("resetState");     //resetting errno session variables
    }

    //stopping the "cant find college" message from appearing
    clearTimeout(collegeNameMsgId);
    $("#collegeNameMsg").hide();        //againj hiding the message     
});


//calling ajax for college city
$("#selectCity").focus(function(){
    var elementId = $(this).attr('id');
    var userInput = $("#selectCity option:selected").text();
    var req_element_Id = "selectCollege";     
    
    fetch_errno_college_state_and_city(elementId, userInput, req_element_Id);
}).change(function(){
    var elementId = $(this).attr('id');
    var userInput = $("#selectCity option:selected").text();
    var req_element_Id = "selectCollege";     
    
    fetch_errno_college_state_and_city(elementId, userInput, req_element_Id);

    //FIX: resetting the college name input if the city is changed again 
    if(selectCollegePerfectOnce == 1){ 
        selectCollegePerfectOnce = 0;          //resetting variable if the prev input is changed again

        $("#selectCollege").next().empty();    //removing the "all good!" feedback
        $("#selectCollege").removeClass("is-valid");   //removing the feedback display class

        //calling ajax function
        reset_select_input_errnos("resetCity");     //resetting errno session variables
    }

    //stopping the "cant find college" message from appearing
    clearTimeout(collegeNameMsgId)
    $("#collegeNameMsg").hide();        //againj hiding the message 
});


$("#collegeNameMsg").hide();        //hiding the "cant find college" message on page load

//calling ajax for college Name
$("#selectCollege").focus(function(){
    var elementId = $(this).attr('id');
    var userInput = $("#selectCollege option:selected").text();
    
    //starting timer to display the "can't find message"
    collegeNameMsgId = setTimeout(function(){
        $("#collegeNameMsg").show();
    }, 4000)
    
    fetch_errno(elementId, userInput);
}).change(function(){
    var elementId = $(this).attr('id');
    var userInput = $("#selectCollege option:selected").text();     
    
    fetch_errno(elementId, userInput);
});


//calling ajax for password
$("#password1").keyup(function(){
    var elementId = $(this).attr('id');
    var userInput = $(this).val();

    //FIX: cross verifying passwords, i.e. when the pw1 is modified again when both the pw fields have already turned green once
    if(confirmPwPerfectOnce == 1){  
        var pw2_val = $("#password2").val();    //pw2 input value

        //again calling the pw2 fetch errors function to re-fetch the errors
        fetch_errno_password2("password2", pw2_val, userInput);
    }
    
    fetch_errno(elementId, userInput);
}).focus(function(){
    var elementId = $(this).attr('id');
    var userInput = $(this).val();
    
    fetch_errno(elementId, userInput);
});


//calling ajax for confirm password
$("#password2").keyup(function(){
    var elementId = $(this).attr('id');
    var userInput = $(this).val();
    var reqUserInput = $("#password1").val();
    
    fetch_errno_password2(elementId, userInput, reqUserInput);
}).focus(function(){
    var elementId = $(this).attr('id');
    var userInput = $(this).val();
    var reqUserInput = $("#password1").val();
    
    fetch_errno_password2(elementId, userInput, reqUserInput);
});


//disabling sign up button by default
var signUpBtnCurrentState = 0;
if(document.getElementById("signUp").hasAttribute("disabled") == false){
    $("#signUp").attr("disabled", "disabled");   
}


//calling ajax for toggling sign up button
$("#signUpForm input, #signUpForm select, #avatarBtn").focus(function(){    
    var signUpBtnToggleId =  setInterval(signUp_btn_toggle, 500);   
    $("#signUp").click(function(){
        clearInterval(signUpBtnToggleId);          
    });
});


//toggling password visibility
$("#signUpPwVisibility").change(function(){
    if($(this).is(":checked")){
        $(".signUpPwVisibilityToggle label i").removeClass("fas fa-eye-slash");   //removing slashed eye icon
        $(".signUpPwVisibilityToggle label i").addClass("fas fa-eye");            //adding normal eye icon
        $("#password1, #password2").attr("type", "text");                   //showing the password
    }else{
        $(".signUpPwVisibilityToggle label i").removeClass("fas fa-eye");             //removing normal eye icon
        $(".signUpPwVisibilityToggle label i").addClass("fas fa-eye-slash");          //adding slashed eye icon
        $("#password1, #password2").attr("type", "password");                   //hiding the password
    }
});



/***************************************************************************************************************/
 //LOGIN FORM

 //toggling password visibility
$("#loginPwVisibility").change(function(){
    if($(this).is(":checked")){
        $(".loginPwVisibilityToggle label i").removeClass("fas fa-eye-slash");   //removing slashed eye icon
        $(".loginPwVisibilityToggle label i").addClass("fas fa-eye");                //adding normal eye icon
        $("#password").attr("type", "text");                                    //showing the password
    }else{
        $(".loginPwVisibilityToggle label i").removeClass("fas fa-eye");             //removing normal eye icon
        $(".loginPwVisibilityToggle label i").addClass("fas fa-eye-slash");          //adding slashed eye icon
        $("#password").attr("type", "password");                                     //hiding the password
    }
});


