<?php 
header('P3P: CP="CAO PSA OUR"');
session_start();
ob_flush();

// #Implement
//Change URL file directory to client file folder
require('http://www.lssoftwaresolutions.com/Live/PasswordHash.php');
include('PasswordHash.php');


include(__DIR__ . "/../les_config.php");

$db = mysql_connect('localhost',$username,$password);
mysql_select_db($database) or die( "Unable to select database ". mysql_error());

error_reporting(E_ALL);

if(!empty($_POST['username']) && !empty($_POST['password']))  
{  
    $hasher = new PasswordHash(8, false);
    $loginusername = mysql_real_escape_string($_POST['username']);  
    $loginpassword =  $hasher->HashPassword($_POST['password']);    
      
      if (strlen($loginpassword) > 72) { die ('Password must be 72 characters or less'); }
     $checkusername = mysql_query("SELECT * FROM Users WHERE EmailAddress = '".$loginusername."'");  
       
     if(mysql_num_rows($checkusername) == 1)  
     {   
        echo "Sorry, that username is taken.";  
     }  
     else  
     {  
        $registerquery = mysql_query("INSERT INTO Users (EmailAddress, Password) VALUES('".$loginusername."', '".$loginpassword."')");  
        if($registerquery)  
        {
	    $_SESSION['Username'] = $_POST['username'];
	    $_SESSION['LoggedIn'] = 1;
	    
	    $insert = "INSERT INTO `Logins`(`Username`) VALUES ('".$_SESSION['Username']."')";
	    mysql_query($insert);
	    
	    	// #Implement
	    if(!isset($_SESSION['lastref']))
	    {
	      $_SESSION['lastref']="http://www.lssoftwaresolutions.com/Live/ResTitle/GFE_main.php";
	    }
	    
	    	    
	    echo $_SESSION['lastref'];
	    
        }  
        else  
        {    
            echo "Sorry, your registration failed. Please try agian.";      
        }         
     }  
}  

?>   
</div>  
</body>  
</html> 
