// Team Member Search Functionality from teampage.html

$("#member-search").keypress(function(){
    $.getJSON("../scripts/js/tmp/usersearch.json", function (result){
        $.each(result, function (i, field){
            
            var user = $("<div>").append("#member-search");
            user.append($("<div>").append(field.fName));
            
        });
    });

})