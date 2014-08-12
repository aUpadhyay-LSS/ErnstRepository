<?php 
header('P3P: CP="CAO PSA OUR"');
session_start();
ob_flush();


// #Implement
//Change URL directory to client file folder
require('http://www.lssoftwaresolutions.com/Live/PasswordHash.php');
//require('http://localhost/CookieCutter_Dev/Login/PasswordHash.php');
include('PasswordHash.php');


include(__DIR__ . "/../les_config.php");

$db = mysql_connect('localhost',$username,$password);
mysql_select_db($database) or die ( "Unable to select database ". mysql_error());

error_reporting(E_ALL);

if(!empty($_POST['username']) && !empty($_POST['password']))  
{   
    $loginusername = mysql_real_escape_string($_POST['username']);
    $hasher = new PasswordHash(8, false);  
    $loginpassword = $_POST['password'];
    
    if (strlen($loginpassword) > 72) { die ('Password must be 72 characters or less'); }
    
    $stored_hash = '*';
    $stored_hash = mysql_result(mysql_query("SELECT Password FROM Users Where EmailAddress = '".$loginusername."'"),0);
    $check = $hasher->CheckPassword($loginpassword, $stored_hash);
          
    if($check === true)  
    {  
    		//takes in username cookie
					$year = time() + 31536000;
					if(isset($_POST['remember'])) {setcookie('remember_me', $_POST['username'], $year);}
    			else {
						if(isset($_COOKIE['remember_me'])) {
							$past = time() - 1000;
							setcookie('remember_me', '', $past);
						}
    			}
                     
        $_SESSION['Username'] = $loginusername;    
        $_SESSION['LoggedIn'] = 1;  
  
	$LoginQuery = mysql_fetch_array(mysql_query("SELECT (count(*)+1) FROM Logins WHERE Username = '".$loginusername."'"));  
	$LoginCount = $LoginQuery[0];

	  //  #Implement
	  //Change URL directory to client file folder
   // if (!isset($_SESSION['lastref'])) {	$_SESSION['lastref'] = 'http://www.jimboindustries.com/CookieCutter_Dev/GFE_main.php';}
    if(preg_match('/(?i)msie [7-8]/',$_SERVER['HTTP_USER_AGENT'])==1)
	{
	$Version="Old";
	}
    else
	{
	$Version="New";
	}
  
      
	$insert = "INSERT INTO `Logins`(`Username`,`LoginCount`,`Destination`,`Version`) VALUES ('".$_SESSION['Username']."',".$LoginCount.",'".$_SESSION['lastref']."','".$Version."')";
	mysql_query($insert);  
  
     
//       //echo $_SESSION['lastref'];
//       if ($_SESSION['target']=="HPC"){
//	    echo "http://www.jimboindustries.com/CookieCutter_Dev/AC_main.php";
//       }
//       else{
//	    echo "http://www.jimboindustries.com/CookieCutter_Dev/GFE_main.php";
//       }
      	// #Implement
	    if(!isset($_SESSION['lastref']))
	    {
	      $_SESSION['lastref']=$GLOBALS['path']."GFE_main.php";
	    }
	    
      echo $_SESSION['lastref'];

    }  
    else  
    {    
        echo "Sorry, you did not enter the correct password or your account could not be found."; 
    }  
}  
?>  
