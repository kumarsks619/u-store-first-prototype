//enabling the bootstrap tooltip
$(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

//displaying toast
$('.toast').toast('show');


//manipulating sidebar height
$(document).ready(function(){
    var navHeight = $("nav").css("height");
    var footerHeight = $("footer").css("height");

    $("aside").css("height", "calc(100vh - " + navHeight + " - " + footerHeight + ")");
});


//setting the sidebar postion from top
$(document).ready(function(){
    var navHeight = $("nav").css("height");
    
    $("aside").css("top", navHeight);
});
$(window).resize(function(){
    var navHeight = $("nav").css("height");

    $("aside").css("top", navHeight);
});


//setting main container width and position from top
$(document).ready(function(){
    var navHeight = $("nav").css("height");
    var asideWidth = $("aside").css("width");

    $(".main-container").css("top", navHeight);
    
    if($(window).width() >= 992){
        $(".main-container").css("width", "calc(100vw - " + asideWidth + ")");
    }else{
        $(".main-container").css("width", "100vw");
    } 
});
$(window).resize(function(){
    var asideWidth = $("aside").css("width");

    if($(window).width() >= 992){
        $(".main-container").css("width", "calc(100vw - " + asideWidth + ")");
    }else{
        $(".main-container").css("width", "100vw");
    } 
});

//setting the max-height for expanded navbar
$("#navbarContent").on('shown.bs.collapse', function(){
    $("#navbarContent").css({
        "max-height" : "60vh",
        "overflow" : "auto"
    });
});


//freeing the footer to move
// $(document).ready(function(){
//     if($(window).width() >= 992){
//         $("footer .container-fluid").addClass("fixed-bottom");
//     }else{
//         $("footer .container-fluid").removeClass("fixed-bottom");
//     } 
// });
// $(window).resize(function(){
//     if($(window).width() >= 992){
//         $("footer .container-fluid").addClass("fixed-bottom");
//     }else{
//         $("footer .container-fluid").removeClass("fixed-bottom");
//     }
// });








