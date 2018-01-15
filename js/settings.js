$(function() {
    $('.alert').hide();
});

function submitUserData(){

    //check if the two password fileds are equal
    if($('#settingsPassword').val() === $('#settingsConfirmPassword').val()){
        //check if the email is unique
        //get the email address
        emailAddress = $('#settingsEmail').val();
        returnVar = false;
        $.ajaxSetup({async: false});
        $.getJSON("../php/phpDirectives/getUserEmail.php?", function(data){
            if(data === emailAddress){
                returnVar = true;
            }else{
                $.getJSON("../php/phpDirectives/checkUniqueEmail?emailAddress="+emailAddress, function(response){
                    if(response == 0){
                        returnVar = true;
                    }
                });
            }
        });
        $.ajaxSetup({async: true});
        if(returnVar){
            if(confirm("If you update you email address you will be logged out and ask to verify your email address once again.") == true){
                alert("Update Successfull");
                return true;
            }else{
                return false;
            }
        }else{
            $('#settingsUniqueEmailAlert').show();
            return false;
        }
    }
    $('#settingsPasswordsMissmatchAlert').show();
    return false;
}