<?php 
header('P3P: CP="CAO PSA OUR"');
session_start();
ob_flush();?>

<html><head>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<body style="background: #efeee9;">

<?php

require('http://www.lssoftwaresolutions.com/Live/PasswordHash.php');
include('PasswordHash.php');


include(__DIR__ . "/../les_config.php");

$db = mysql_connect('localhost',$username,$password);
mysql_select_db($database) or die( "Unable to select database ". mysql_error());

error_reporting(E_ALL);

if(!empty($_POST['username']) && !empty($_POST['passwordR']))  
{  
    $hasher = new PasswordHash(8, false);
    $loginusername = mysql_real_escape_string($_POST['username']);  
    $loginpassword =  $hasher->HashPassword($_POST['password']);    
      
      $stored_hash = mysql_result(mysql_query("SELECT Password FROM Users Where EmailAddress = '".$loginusername."'"),0);  
      
     if($stored_hash === $_POST['temppassword'])  
     {  
     	$registerquery = mysql_query("Update Users Set Password = '".$loginpassword."' Where EmailAddress = '".$loginusername."'");  
        if($registerquery)  
        {  
            // #Implement
	    echo "<h3>Success! You will now be directed to the login screen</h3>";
	    echo "<meta http-equiv='refresh' content='1;URL=http://lodestarss.com/gfe-demo.html'/>"; 
        }
        else  
        {  
            echo "<h1>Error</h1>";  
            echo "<p>Sorry, your password reset failed. Please go back and try again.</p>";      
        }      
         
     }  
     else  
     {  
        echo "<h1>Error</h1>";  
        echo "<p> Temporary Password or Username is incorrect.</p>"; 
     }  
}  
else  
{ 
?>
<div class='middle'>
<p STYLE= margin-left:15px;font-family:arial;color:grey;font-size:24px;text-align:center;">
    Thanks for visiting! Please reset your password here.</p>  
 <br/><br/>
 <div class="container">
    <!-- #Implement -->
    <form method="post" action="reset.php" name="loginform" id="loginform" >  
    <fieldset style="width:300px;">
      <table class="table table-hover" STYLE="margin-left:15px;align:center;" border="0" cellspacing="2" cellpadding="10">
      <tr><td> <label for="username">Email:</label></td><td><input type="text" name="username" id="username" readonly/> </td></tr>
      <tr><td> <label for="temppassword">Temporary Password:</label></td><td><input type="password" name="temppassword" id="temppassword" readonly/></td></tr>
      <tr><td> <label for="password">New Password:</label></td><td><input type="password" name="password" id="password" /> </td></tr>
      <tr><td> <label for="passwordR">Confirm New Password:</label></td>
      <td><input type="password" name="passwordR" id="passwordR" /><span id="message"></span> </td></tr>
      <tr><td colspan='2'> <input type="submit" name="login" id="login" value="Login" class="btn btn-default" />  </td></tr>
      </table>
    </fieldset>  
    </form>
 </div>
</div>
	
	<div class="logo"><img src="images/PoweredByLodestar.jpg" \/></div>  
	 <script>
    	$(document).ready(function (){
    	
    	document.getElementById('username').value = getParameterByName("un");
	document.getElementById('temppassword').value = getParameterByName("pword");
	
    	
    	$("#passwordR").keyup(function(){
    	
    	var password = $('#password').val();
    	var confirmPassword = $('#passwordR').val();

if (password != confirmPassword)
    	{
        $('#message').html("<img src='Images/red.jpg' />");
    	}
    	else
    	{
        $('#message').html("<img src='Images/green.png' />");
        }
        });
    	});
    	
    	function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results == null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
    </script>
<?php
}// End Else
?>
     
</body>
</html>