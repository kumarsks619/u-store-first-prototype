//PROFILE EDIT FORM ************************************************************************************

//toggling buttons*******************************
//first name
var firstNameCurrentVal;
$("#editFirstName .editBtn").click(function(){
    var group_Id = "editFirstName";
    firstNameCurrentVal = $("#" + group_Id + " .form-control").val();
    
    $("#" + group_Id + " .actionBtns").removeClass("d-none");
    $("#" + group_Id + " .editBtnDiv").addClass("d-none");
    $("#" + group_Id + " .form-control").removeAttr("readonly");
});
$("#editFirstName .cancelBtn").click(function(){
    var group_Id = "editFirstName";

    $("#" + group_Id + " .editBtnDiv").removeClass("d-none");
    $("#" + group_Id + " .actionBtns").addClass("d-none");
    $("#" + group_Id + " .form-control").val(firstNameCurrentVal);
    $("#" + group_Id + " .form-control").attr("readonly", "readonly");

    //removing validations
    if($("#" + group_Id + " .form-control").hasClass("is-valid") == true){
        $("#" + group_Id + " .form-control").removeClass("is-valid");
    }
    if($("#" + group_Id + " .form-control").hasClass("is-invalid") == true){
        $("#" + group_Id + " .form-control").removeClass("is-invalid");
    }

    //disabling the tick button if enabled
    if($("#" + group_Id + " .doneBtn").attr("disabled") == undefined){
        $("#" + group_Id + " .doneBtn").attr("disabled", "disabled");
    }
    
});

//last name
var lastNameCurrentVal;
$("#editLastName .editBtn").click(function(){
    var group_Id = "editLastName";
    lastNameCurrentVal = $("#" + group_Id + " .form-control").val();
    
    $("#" + group_Id + " .actionBtns").removeClass("d-none");
    $("#" + group_Id + " .editBtnDiv").addClass("d-none");
    $("#" + group_Id + " .form-control").removeAttr("readonly");
});
$("#editLastName .cancelBtn").click(function(){
    var group_Id = "editLastName";

    $("#" + group_Id + " .editBtnDiv").removeClass("d-none");
    $("#" + group_Id + " .actionBtns").addClass("d-none");
    $("#" + group_Id + " .form-control").val(lastNameCurrentVal);
    $("#" + group_Id + " .form-control").attr("readonly", "readonly");

    //removing validations
    if($("#" + group_Id + " .form-control").hasClass("is-valid") == true){
        $("#" + group_Id + " .form-control").removeClass("is-valid");
    }
    if($("#" + group_Id + " .form-control").hasClass("is-invalid") == true){
        $("#" + group_Id + " .form-control").removeClass("is-invalid");
    }

    //disabling the tick button if enabled
    if($("#" + group_Id + " .doneBtn").attr("disabled") == undefined){
        $("#" + group_Id + " .doneBtn").attr("disabled", "disabled");
    }
});

//email
var emailCurrentVal;
$("#editEmail .editBtn").click(function(){
    var group_Id = "editEmail";
    emailCurrentVal = $("#" + group_Id + " .form-control").val();
    
    $("#" + group_Id + " .actionBtns").removeClass("d-none");
    $("#" + group_Id + " .editBtnDiv").addClass("d-none");
    $("#" + group_Id + " .form-control").removeAttr("readonly");
});
$("#editEmail .cancelBtn").click(function(){
    var group_Id = "editEmail";

    $("#" + group_Id + " .editBtnDiv").removeClass("d-none");
    $("#" + group_Id + " .actionBtns").addClass("d-none");
    $("#" + group_Id + " .form-control").val(emailCurrentVal);
    $("#" + group_Id + " .form-control").attr("readonly", "readonly");

    //removing validations
    if($("#" + group_Id + " .form-control").hasClass("is-valid") == true){
        $("#" + group_Id + " .form-control").removeClass("is-valid");
    }
    if($("#" + group_Id + " .form-control").hasClass("is-invalid") == true){
        $("#" + group_Id + " .form-control").removeClass("is-invalid");
    }

    //disabling the tick button if enabled
    if($("#" + group_Id + " .doneBtn").attr("disabled") == undefined){
        $("#" + group_Id + " .doneBtn").attr("disabled", "disabled");
    }
});

//restricting keyboard inputs for phone number inputs
$("#editPhone1 .form-control, #editPhone2 .form-control").keypress(function(key){
    if(key.charCode < 48 || key.charCode > 57){
        return false;
    }
});

//primary phone number
var phone1CurrentVal;
$("#editPhone1 .editBtn").click(function(){
    var group_Id = "editPhone1";
    phone1CurrentVal = $("#" + group_Id + " .form-control").val();
    
    $("#" + group_Id + " .actionBtns").removeClass("d-none");
    $("#" + group_Id + " .editBtnDiv").addClass("d-none");
    $("#" + group_Id + " .form-control").removeAttr("readonly");
});
$("#editPhone1 .cancelBtn").click(function(){
    var group_Id = "editPhone1";

    $("#" + group_Id + " .editBtnDiv").removeClass("d-none");
    $("#" + group_Id + " .actionBtns").addClass("d-none");
    $("#" + group_Id + " .form-control").val(phone1CurrentVal);
    $("#" + group_Id + " .form-control").attr("readonly", "readonly");

    //removing validations
    if($("#" + group_Id + " .form-control").hasClass("is-valid") == true){
        $("#" + group_Id + " .form-control").removeClass("is-valid");
    }
    if($("#" + group_Id + " .form-control").hasClass("is-invalid") == true){
        $("#" + group_Id + " .form-control").removeClass("is-invalid");
    }

    //disabling the tick button if enabled
    if($("#" + group_Id + " .doneBtn").attr("disabled") == undefined){
        $("#" + group_Id + " .doneBtn").attr("disabled", "disabled");
    }
});

//secondary phone number
var phone2CurrentVal;
$("#editPhone2 .editBtn").click(function(){
    var group_Id = "editPhone2";
    phone2CurrentVal = $("#" + group_Id + " .form-control").val();
    
    $("#" + group_Id + " .actionBtns").removeClass("d-none");
    $("#" + group_Id + " .editBtnDiv").addClass("d-none");
    $("#" + group_Id + " .form-control").removeAttr("readonly");
});
$("#editPhone2 .cancelBtn").click(function(){
    var group_Id = "editPhone2";

    $("#" + group_Id + " .editBtnDiv").removeClass("d-none");
    $("#" + group_Id + " .actionBtns").addClass("d-none");
    $("#" + group_Id + " .form-control").val(phone2CurrentVal);
    $("#" + group_Id + " .form-control").attr("readonly", "readonly");

    //removing validations
    if($("#" + group_Id + " .form-control").hasClass("is-valid") == true){
        $("#" + group_Id + " .form-control").removeClass("is-valid");
    }
    if($("#" + group_Id + " .form-control").hasClass("is-invalid") == true){
        $("#" + group_Id + " .form-control").removeClass("is-invalid");
    }

    //disabling the tick button if enabled
    if($("#" + group_Id + " .doneBtn").attr("disabled") == undefined){
        $("#" + group_Id + " .doneBtn").attr("disabled", "disabled");
    }
});

//passwords
$("#oldPassword .editBtn").click(function(){
    $("#oldPassword").slideUp(300, function(){
        $("#changePassword").slideDown(300);
    });
});
$("#changePassword .cancelBtn").click(function(){
    $("#changePassword").slideUp(300, function(){
        $("#oldPassword").slideDown(300);
    });
});


//edit form validation********************************************
//first name
$("#editFirstName .form-control").keyup(function(){
    var element_Id = "editFirstName";
    var input_val = $("#editFirstName .form-control").val();

    if($("#" + element_Id + " .form-control").attr("readonly") == undefined){
        fetch_errno(element_Id, input_val);
    }
});

//last name
$("#editLastName .form-control").keyup(function(){
    var element_Id = "editLastName";
    var input_val = $("#editLastName .form-control").val();

    if($("#" + element_Id + " .form-control").attr("readonly") == undefined){
        fetch_errno(element_Id, input_val);
    }
});

//email
$("#editEmail .form-control").keyup(function(){
    var element_Id = "editEmail";
    var input_val = $("#editEmail .form-control").val();

    if($("#" + element_Id + " .form-control").attr("readonly") == undefined){
        fetch_errno(element_Id, input_val);
    }
});

//primary phone number
$("#editPhone1 .form-control").keyup(function(){
    var element_Id = "editPhone1";
    var input_val = $("#editPhone1 .form-control").val();

    if($("#" + element_Id + " .form-control").attr("readonly") == undefined){
        fetch_errno(element_Id, input_val);
    }
});

//secondary phone number
$("#editPhone2 .form-control").keyup(function(){
    var element_Id = "editPhone2";
    var input_val = $("#editPhone2 .form-control").val();
    var req_val = $("#editPhone1 .form-control").val(); 

    if($("#" + element_Id + " .form-control").attr("readonly") == undefined){
        fetch_errno_phone2(element_Id, input_val, req_val);
    }
});

//new password 1
$("#newPw1 .form-control").keyup(function(){
    var element_Id = "newPw1";
    var input_val = $("#newPw1 .form-control").val();
    //FIX: cross verifying passwords, i.e. when the pw1 is modified again when both the pw fields have already turned green once
    if(confirmNewPwPerfectOnce == 1){  
        var req_val = $("#newPw2 .form-control").val();    //new pw2 input value

        //again calling the pw2 fetch errors function to re-fetch the errors
        fetch_errno_new_pw2("newPw2", req_val, input_val);
    }

    fetch_errno(element_Id, input_val);
});

//new password 2
$("#newPw2 .form-control").keyup(function(){
    var element_Id = "newPw2";
    var input_val = $("#newPw2 .form-control").val();
    var req_val = $("#newPw1 .form-control").val();

    fetch_errno_new_pw2(element_Id, input_val, req_val);
});


//edit form updating database************************************************
//first name
$("#editFirstName .doneBtn").click(function(){
    var element_Id = "editFirstName";
    var input_val = $("#editFirstName .form-control").val();

    update_profile(element_Id, input_val);
});

//last name
$("#editLastName .doneBtn").click(function(){
    var element_Id = "editLastName";
    var input_val = $("#editLastName .form-control").val();

    update_profile(element_Id, input_val);
});

//email
$("#editEmail .doneBtn").click(function(){
    var element_Id = "editEmail";
    var input_val = $("#editEmail .form-control").val();

    update_profile(element_Id, input_val);
});

//primary phone number
$("#editPhone1 .doneBtn").click(function(){
    var element_Id = "editPhone1";
    var input_val = $("#editPhone1 .form-control").val();

    update_profile(element_Id, input_val);
});

//secondary phone number
$("#editPhone2 .doneBtn").click(function(){
    var element_Id = "editPhone2";
    var input_val = $("#editPhone2 .form-control").val();

    update_profile(element_Id, input_val);
});


//toggling password visibility
$("#editPwVisibility").change(function(){
    if($(this).is(":checked")){
        $(".editPwVisibilityToggle label i").removeClass("fas fa-eye-slash");   //removing slashed eye icon
        $(".editPwVisibilityToggle label i").addClass("fas fa-eye");                //adding normal eye icon
        $("#newPw1 .form-control, #newPw2 .form-control").attr("type", "text");                                    //showing the password
    }else{
        $(".editPwVisibilityToggle label i").removeClass("fas fa-eye");             //removing normal eye icon
        $(".editPwVisibilityToggle label i").addClass("fas fa-eye-slash");          //adding slashed eye icon
        $("#newPw1 .form-control, #newPw2 .form-control").attr("type", "password");                                     //hiding the password
    }
});
