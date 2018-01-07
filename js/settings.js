function submitUserData(){
    //check if the two password fileds are equal
    if($('#settingsPassword').val() === $('#settingsConfirmPassword').val()){
        alert("Update Successfull");
        return true;
    }
    alert("The two passwords do not match");
    return false;
}