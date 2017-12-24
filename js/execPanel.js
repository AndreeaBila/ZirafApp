$(function(){
    //check if the accept request button is clicked
    $('.confirmRequestBtn').click(function(){
        var user = getUserData(this);
        //delete the user row
        $('#' + user.rowId).remove();
        //send the user data to the server
        $.ajax({
            data: user,
            url: "../php/phpDirectives/acceptRequest.php",
            type: "GET",
            success: function(response){
                if(response == '1'){
                    $('#numRequests').html("<span><strong>" + response + "</span></strong> pending request");
                }else{
                    $('#numRequests').html("<span><strong>" + response + "</span></strong> pending requests");
                }
            },
            error: function(){
                alert("Something went wrong");
            }
        });
    });

    //check if the decline request button is clicked
    $('.declineRequestBtn').click(function(){
        var user = getUserData(this);
        //delete the entry
        $("#confirmDeleteBtn").click(function(){
            $('#confirmDeclineModal').modal('hide');
            $('#' + user.rowId).remove();
            //send the user data to the server
            $.ajax({
                data: user,
                url: "../php/phpDirectives/declineRequest.php",
                type: "GET",
                success: function(response){
                    if(response == '1'){
                        $('#numRequests').html("<span><strong>" + response + "</span></strong> pending request");
                    }else{
                        $('#numRequests').html("<span><strong>" + response + "</span></strong> pending requests");
                    }
                },
                error: function(){
                    alert("Error");
                }
            });
        });
    });

    //close button for modal
    $('#closeModalBtn').click(function(){
        $('#confirmDeclineModal').modal('hide');
    });

    //when this is clickd load all zirafers into an array
    // $.getJSON("../php/phpDirectives/getEmailList.php", function(data){
    //     console.log(data);
    //     //bind the email list to the the search box
    //     $('#tags').autocomplete({
    //         source: data
    //     });
    // });
});

function getUserData(index){
    var user = {email: $(index).parent().siblings().first().children().first().children().first().next().html(),
                rowId: $(index).parent().parent().attr('id')};
    return user;
}