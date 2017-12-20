$(function(){
    //check if the accept request button is clicked
    $('.confirmRequestBtn').click(function(){
        var user = getUserData(this);
        //send the user data to the server
        $.ajax({
            data: user,
            url: "../php/phpDirectives/acceptRequest.php",
            type: "GET",
            success: function(){

            },
            error: function(){
                alert("Something went wrong");
            }
        });
    });

    //check if the decline request button is clicked
    $('.declineRequestBtn').click(function(){
        var user = getUserData(this);
        //send the user data to the server
        $.ajax({
            data: user,
            url: "../php/phpDirectives/declineRequest.php",
            type: "GET"
        });
    });
});

function getUserData(index){
    var user = {email: $(index).parent().siblings().first().children().first().children().first().next().html(),
                rowId: $(index).parent().parent().attr('id')};
    return user;
}