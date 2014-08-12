<?php
require '../PHPMailerAutoload.php';
include('PasswordHash.php');


include(__DIR__ . "/../les_config.php");

$db = mysql_connect('localhost',$username,$password);
mysql_select_db($database) or die( "Unable to select database ". mysql_error());

error_reporting(E_ALL);


if(!empty($_POST['username']))  
{
$semi_rand = md5(time());
$temp_password = md5(time());

	  $checkusername = mysql_query("SELECT * FROM Users WHERE EmailAddress = '".$_POST['username']."'");  
	
   if(mysql_num_rows($checkusername) == 0)  
	 {
	    echo "Username does not exist"; 
	 }
   else{

     $registerquery = mysql_query("Update Users Set Password = '".$temp_password."' Where EmailAddress = '".$_POST['username']."'");  

 //#Implement
 //Change Email sent, body, altbody and subject to match client information
   //Create a new PHPMailer instance
	$mail = new PHPMailer();
	// Set PHPMailer to use the sendmail transport
	$mail->isSendmail();
	//Set who the message is to be sent from
	$mail->setFrom('support@lssoftwaresolutions.com');
	//Set an alternative reply-to address
	//$mail->addReplyTo('replyto@example.com', 'First Last');
	
        //Set who the message is to be sent to
        $mail->addAddress($_POST['username']);
	
        //Set the subject line
	$mail->Subject = 'Your New Lodestar GFE Password';
	
	// #Implement
	//Change URL directory to client folder
	$mail->Body = "Please use the link below to change your password<br/><br/>
      <a href ='http://www.jimboindustries.com/CookieCutter_Dev/Login/reset.php?un=".$_POST['username']."&pword=".$temp_password."'>Password Reset<a/>";
	
        $mail->AltBody = 'Your lodestar created GFE results are attached.';

        if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
	} 

	      echo "A link to reset your password has been sent to ".$_POST['username'];
	
	 }        
}
?>

