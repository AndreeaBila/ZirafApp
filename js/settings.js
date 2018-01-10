function submitUserData(){
    //check if the two password fileds are equal
    if($('#settingsPassword').val() === $('#settingsConfirmPassword').val()){
        //check if the email is unique
        //get the email address
        emailAddress = $('#settingsEmail').val();
        returnVar = false;
        $.ajaxSetup({async: false});
        $.getJSON("../php/phpDirectives/checkUniqueEmail.php?emailAddress=" + emailAddress, function(data){
            if(data == 0){
                returnVar = true;
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
            alert("The entered email address is not unique");
            return false;
        }
    }
    alert("The two passwords do not match");
    return false;
}