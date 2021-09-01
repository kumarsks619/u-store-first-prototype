/*************************************************************************************************************** */
//PRODUCT UPLOAD FORM

var fileOk = false;                   //variable for storing the status of file being selected
$("#uploadProgressBar").hide();       //hiding the progress bar until the upload button is pressed

//product photo extension validation and progress bar working
$("#productPhoto").change(function(){
    var file = $("#productPhoto")[0].files[0];     //file details array

    //checking if any file is selected or not
    if(file != undefined){
        var fileName = file['name'];                                        //file Name
        var fileExt = ($(fileName.split(".")).get(-1)).toLowerCase();     //file extension 
    
        var allowedExt = ["png", "jpg", "jpeg"];   //allowed file extensions
    
        if(jQuery.inArray(fileExt, allowedExt) != -1){  
            fileOk = true;        //file can NOT be uploaded   
        }else{
            fileOk = false;        //file can be uploaded
        }

        //resetting the progress bar and the cutsom feedbacks
        $("#uploadProgressBar .progress-bar").css("width", "0%");
        $("#uploadProgressBar").hide();
        $("#productPhotoCol .custom-valid-feedback").empty();
        $("#productPhotoCol .custom-invalid-feedback").empty();

        
        //showing error if any and toggling the upload button
        if(fileOk == true){
            //checking if the is-invalid class exists
            if($("#productPhoto").hasClass("is-invalid") == 1 && $("#productPhotoCol .input-group").hasClass("is-invalid") == 1){
                //removing is-invalid class as required
                $("#productPhotoCol .input-group").removeClass("is-invalid");
                $("#productPhoto").removeClass("is-invalid");
                //adding error to be displayed
                $("#productPhotoCol .invalid-feedback").empty();
            }
            
            //activating the upload button
            if(document.getElementById("productUploadBtn").hasAttribute("disabled") == true){
                $("#productUploadBtn").removeAttr("disabled");   
            }
        }else{
            //checking if the is-invalid class already exists
            if($("#productPhoto").hasClass("is-invalid") != 1 && $("#productPhotoCol .input-group").hasClass("is-invalid") != 1){
                //adding is-invalid class as required
                $("#productPhotoCol .input-group").addClass("is-invalid");
                $("#productPhoto").addClass("is-invalid");
                //adding error to be displayed
                $("#productPhotoCol .invalid-feedback").html("Invalid image file!!! Only .jpg, .jpeg and .png extensions are allowed. ");
            }
    
            //deactivatiing the upload button
            if(document.getElementById("productUploadBtn").hasAttribute("disabled") == false){
                $("#productUploadBtn").attr("disabled", "disabled");
            }
        }

        //FIX: show file value after file select in product photo select input
        $("#fileLabel").html(fileName);
    }else{
        //FIX: clear the file value(if any) if the cancel button(in the browse window) is pressed
        $("#fileLabel").html("Select a picture.");
        //checking if the is-invalid class exists
        if($("#productPhoto").hasClass("is-invalid") == 1 && $("#productPhotoCol .input-group").hasClass("is-invalid") == 1){
            //removing is-invalid class as required
            $("#productPhotoCol .input-group").removeClass("is-invalid");
            $("#productPhoto").removeClass("is-invalid");
            //adding error to be displayed
            $("#productPhotoCol .invalid-feedback").empty();
        }
        //removing the custom feedbacks
        $("#productPhotoCol .custom-valid-feedback").empty();
        $("#productPhotoCol .custom-invalid-feedback").empty();

        //resetting the progress bar
        $("#uploadProgressBar .progress-bar").css("width", "0%");
        $("#uploadProgressBar").hide();
        
        //activating the upload button
        if(document.getElementById("productUploadBtn").hasAttribute("disabled") == true){
            $("#productUploadBtn").removeAttr("disabled");   
        }
    }

});


//restricting keyboard inputs for price input
$("#productPrice").keypress(function(key){
    if(key.charCode < 48 || key.charCode > 57){
        return false;
    }
});

//progress bar show uploading effect
$("#productUploadBtn").click(function(){
    $("#uploadProgressBar").show();

    if(fileOk == true){
        var file = $("#productPhoto")[0].files[0];
        var formdata = new FormData();
        formdata.append("productPhoto", file);
        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progressHandler, false);
        ajax.addEventListener("load", completeHandler, false);
        ajax.addEventListener("error", errorHandler, false);
        ajax.addEventListener("abort", abortHandler, false);

        ajax.open("POST", "assets/handlers/productUploadFormHandler.php");
        ajax.send(formdata);

        function progressHandler(event){
            var percentageUploaded = (event.loaded / event.total) * 100;
            $("#uploadProgressBar .progress-bar").css("width", percentageUploaded + "%");
        }

        function completeHandler(){
            $("#productPhotoCol .custom-valid-feedback").html("Picture uploaded !");
        }

        function errorHandler(){
            $("#productPhotoCol .custom-invalid-feedback").html("Upload failed !!!");
        }

        function abortHandler(){
            $("#productPhotoCol .custom-invalid-feedback").html("Upload aborted !!!");
        }
    }
});
