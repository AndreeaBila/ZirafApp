<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<style>
#yourBtn{
   position: relative;
       top: 150px;
   font-family: calibri;
   width: fit-content;
   padding: 10px;
   -webkit-border-radius: 5px;
   -moz-border-radius: 5px;
   border: 1px solid #BBB; 
   text-align: center;
   background-color: #DDD;
   cursor:pointer;
  }
</style>
<script type="text/javascript">
$(document).ready(function()
{
    $('input[type=file]').each(function()
    {
        $(this).attr('onchange',"sub(this)");
        $('<div id="yourBtn" onclick="getFile()">choose a profile picture</div>').insertBefore(this);
        $(this).wrapAll('<div style="height: 0px;width: 0px; overflow:hidden;"></div>');
    });
});
 function getFile(){
   $('input[type=file]').click();
 }
 function sub(obj){
    var file = obj.value;
    var fileName = file.split("\\");
    document.getElementById("yourBtn").innerHTML = fileName[fileName.length-1];
 }
</script>
</head>
<body>
<?php 
    var_dump($_FILES);
?>
<center>
<form action="" method="post" enctype="multipart/form-data" name="myForm">

<input id="upfile" name="file" type="file" value="upload"/>
<input type="submit" value='submit' >
</form>
</center>
</body>
</html>