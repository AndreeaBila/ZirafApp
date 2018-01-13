var selectedEmails = [];

var databaseEmails = [];

$(function(){
    $('.alert').hide();
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
                $('#execErrorAlert').show();
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
                    $('#execErrorAlert').show();
                }
            });
        });
    });

    //close button for modal
    $('#closeModalBtn').click(function(){
        $('#confirmDeclineModal').modal('hide');
    });

    //retrieve all available users from the database
    $.getJSON("../php/phpDirectives/getEmailList.php", function(data){
        databaseEmails = data;
    });
      
    //chekc if the user tried to select email addres to revoke by enter
    $('#selectUserEmailsToRevoke').keydown(function(e){
        if(e.keyCode == 13){
            selectUserToRevoke();
        }
    });
    //or by button
    $('#selectEmailForRevoke').click(function(){
        selectUserToRevoke();
    });

    //when the user tries to remove an option
    $(document).on('click', 'button.removeMemberBtnToAdd', function(){
        var deletedEmail = $(this).siblings().first().text();
        //remove the email from the list of selected emails
        //get the index
        elementIndex = selectedEmails.indexOf(deletedEmail);
        //remove the element itself
        selectedEmails.splice(elementIndex, 1);
        //add the email back to the array of database emails
        databaseEmails.push(deletedEmail);
        //remove the row from the modal
        $(this).parent().remove();
        //clear the list of dropdown emails
        $('#dropDownList').empty();
        //rebuild the dropdown
        getSuggestions();
    });

    //when a user clicks an option take that option's value and place it into
    //the input search box
    $(document).on('click', 'p.suggestionOption', function(){
        $('#selectUserEmailsToRevoke').val($(this).text());
        //clear the dropdown
        $('#dropDownList').empty();
    });
});

function getUserData(index){
    var user = {email: $(index).parent().siblings().first().children().first().children().first().next().html(),
                rowId: $(index).parent().parent().attr('id')};
    return user;
}

function selectUserToRevoke(){
    //get the value of the selected email
    var selectedEmail = $('#selectUserEmailsToRevoke').val();
    //add the email to a list of selected emails
    if(checkOptionValue(databaseEmails, selectedEmail)){
        selectedEmails.push(selectedEmail);
        //add the selected email to the list of selected emails
        $('#addedMembersToRevoke').append('<div class="members row">' +
                                        '<p class="emails col-8">' + selectedEmail + '</p>' +
                                        '<button type="button" class="removeMemberBtnToAdd removeMemberBtn col-4">cancel &times;</button>' +
                                        '</div>');
        //delete the input data
        $('#selectUserEmailsToRevoke').val("");
        //delete the selected email from the list of available emails from the databaseEmails array
        databaseEmails.splice(databaseEmails.indexOf(selectedEmail), 1);

        //check if the user pressed on the revoke vonfirm button
        $('#confirmUserRevokeModalBtn').click(function(){
            //send the array of emails to the server
            $.ajax({
                data: {emails: JSON.stringify(selectedEmails)},
                url: "../php/phpDirectives/revokeUserAccess.php",
                type: "GET",
                success: function(response){
                    //clean the list of selected emails
                    location.reload();
                },
                error: function(){
                    alert("An error occured while trying to remove the selected user.");
                }
            });
            //close the modal
            $('#searchUserModal').modal('toggle');
        });
        //check if the user pressed cancel
        $('#closeUserRevokeModalBtn').click(function(){
            location.reload();
        });
    }
}

function checkOptionValue(options, value){
    for(var i=0;i<options.length;i++){
      if(options[i] == value){
        return true;
      }
    }
    return false;
}

function getSuggestions(){
    //get the emails from the user
    userInput = $('#selectUserEmailsToRevoke').val();
    if(userInput !== ''){
        $.getJSON("../php/phpDirectives/liveSearch.php?userInput=" + userInput, function(data){
            console.log(data);
            //create drop down
            dropDown = "";
            data.forEach(function(object){
                if($.inArray(object, selectedEmails) === -1){
                    dropDown += "<p class='suggestionOption'>" + object + "</p>";
                }
            });

            $('#dropDownList').empty();
            $('#dropDownList').append(dropDown);
        });
    }else{
        $('#dropDownList').empty();
    }
}