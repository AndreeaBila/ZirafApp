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

    //when this is clickd load all zirafers into an array
    // $.getJSON("../php/phpDirectives/getEmailList.php", function(data){
    //     console.log(data);
    //     //bind the email list to the the search box
    //     $('#tags').autocomplete({
    //         source: data
    //     });
    // });
    function checkOptionValue(options, value){
        for(var i=0;i<options.length;i++){
          if(options[i].value == value){
            return true;
          }
        }
        return false;
      }

    $('#selectUserEmailsToRevoke').keydown(function(e){
        if(e.keyCode == 13){
          //get the value of the selected email
          var selectedEmail = $('#selectUserEmailsToRevoke').val();
          //get the list of all options
          var allOptions = $('#revokeUsers').children();
          if(checkOptionValue(allOptions, selectedEmail)){
            //add the selected email to the list of selected emails
            $('#addedMembersToRevoke').append('<div class="members row">' +
                                           '<p class="emails col-8">' + selectedEmail + '</p>' +
                                           '<button type="button" class="removeMemberBtnToAdd removeMemberBtn col-4">cancel &times;</button>' +
                                           '</div>');
            //delete the input data
            $('#selectUserEmailsToRevoke').val("");
            //delete the selected email from the list of available options
            $('#revokeUsers option[value="'+ selectedEmail +'"]').remove();
            //chekc if a row from the selected emails list has been deleted
            $('.removeMemberBtnToAdd').unbind('click');
            $('.removeMemberBtnToAdd').bind('click', function(){
              var deletedEmail = $(this).siblings().first().text();
              //add the email back to the select
              $('#revokeUsers').append('<option value="'+ deletedEmail +'">');
              $(this).parent().remove();
            });
          }
        }
      });
});

function getUserData(index){
    var user = {email: $(index).parent().siblings().first().children().first().children().first().next().html(),
                rowId: $(index).parent().parent().attr('id')};
    return user;
}