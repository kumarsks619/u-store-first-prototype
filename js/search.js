//hiding the seacrh result field by default
$(".searchResults").hide();

//global variable to store the link for the search page with arguements
var searchLink = "";

//starting the search functioning on when user starts typing something
$("#searchForm input").keyup(function(){
    $(".searchResults").show();

    var searchFor = $("#searchForm input").val();      //value to be searched for
    $.ajax({
        url: 'assets/resources/searchResource.php',
        method: 'POST',
        data: { search : searchFor},
        cache: false,

        success: function(response){
            var liveSearchResponse = response.split("*"); 
            $(".searchResults").html(liveSearchResponse[0]);
            if(liveSearchResponse[0] != ""){
                searchLink = "searchPage.php?" + liveSearchResponse[1];
                $(".searchResults").append("<p style='text-align: center; margin: 0; padding: 6px 0; border-radius: 7px; background-color: #eee;'><a href='" + searchLink + "' id='moreResultsLink'>See more results</a></p>");
            }else{
                searchLink = "";    //resetting the search page link 
                $(".searchResults").css("height", "fit-content");
                $(".searchResults").append("<p style='text-align: center; margin: 0; padding: 6px 0; border-radius: 7px; background-color: #eee;' class='text-muted'>no results found!</p>");
            }
        }
    });
});


//when search form is submitted or search button is pressed
$("#searchForm").on("submit", function(e){
    e.preventDefault();
    if(searchLink != ""){
        window.location.href = searchLink;          //redirecting to search page with results
    }else{
        window.location.href = "searchPage.php";    //redirecting to search page no results
    }  
});
 

//hiding the search results when clicked outside somewhere on page
$(document).click(function(e){
    if(e.target.class != "searchResults" && e.target.id != "searchForm"){
        $(".searchResults").hide();
    }else{
        $(".searchResults").show();
    }
});
