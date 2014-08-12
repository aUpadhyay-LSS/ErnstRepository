 <?php
require '../PHPMailerAutoload.php';
 
header('P3P: CP="CAO PSA OUR"');
session_start();
ob_flush();

//#Implement
//Database connection
//$username="jimboind_demo";
//$password="Test123";
//$database="jimboind_Demo";

include('les_config.php');

$db = mysql_connect('localhost',$username,$password);
@mysql_select_db($database) or die( "Unable to select database ". mysql_error());

error_reporting(E_ALL);

$insert = "INSERT INTO `TitleOrders`(`State`, `Username`, `OrderedBy`) VALUES ('".$_POST['OrderState']."','".$_SESSION['Username']."','".$_POST['OrderName']."')";
$_SESSION['insert'] = $insert;
mysql_query($insert);


$body = "<b>General Information</b><br/>".
"<table border='1'><tr><td>Title Type:</td><td>".$_POST['Title_Type']."</td></tr>".
"<tr><td>Closing Date: </td><td>".$_POST['ClosingDate']."</td></tr>".
"<tr><td>Closer:</td><td>".$_POST['Closer']."</td></tr>".
"<tr><td>Closing Attorney:</td><td>".$_POST['ClosingAttorney']."</td></tr>".
"<tr><td>Name/Requested By: </td><td>".$_POST['OrderName']."</td></tr>".
"<tr><td>Firm/Company: </td><td>".$_POST['OrderCompany']."</td></tr>".
"<tr><td>Address: </td><td>".$_POST['OrderAddress']."</td></tr>".
"<tr><td>City: </td><td>".$_POST['OrderCity']."</td></tr>".
"<tr><td>State: </td><td>".$_POST['OrderState']."</td></tr>".
"<tr><td>Zip: </td><td>".$_POST['OrderZip']."</td></tr>".
"<tr><td>Phone: </td><td>".$_POST['OrderPhone']."</td></tr>".
"<tr><td>Fax: </td><td>".$_POST['OrderFax']."</td></tr>".
"<tr><td>Email: </td><td>".$_POST['OrderEmail']."</td></tr></table><br/>".

"<b>Property:</b><br/>".
"<table border='1'><tr><td>Property Address:</td><td>".$_POST['PropertyAddress']."</td></tr>".
"<tr><td>Property Municipality: </td><td>".$_POST['PropertyMunicipality']."</td></tr>".
"<tr><td>Property County: </td><td>".$_POST['PropertyCounty']."</td></tr>".
"<tr><td>Property Lot: </td><td>".$_POST['PropertyLot']."</td></tr>".
"<tr><td>Property Condo: </td><td>".$_POST['PropertyCondo']."</td></tr>".
"<tr><td>Property Unit Number: </td><td>".$_POST['PropertyUnitNumber']."</td></tr>".
"<tr><td>Property Building: </td><td>".$_POST['PropertyBuilding']."</td></tr>".
"<tr><td>Purchase Price: </td><td>".$_POST['PurchasePrice']."</td></tr>".
"<tr><td>Loan Amount: </td><td>".$_POST['LoanAmount']."</td></tr></table><br/>".

"<b>Parties:</b><br/>".
"<table border='1'><tr><td>Buyers/Mortgagers:</td><td>".$_POST['mortgagers']."</td></tr>".
"<tr><td>Marital Status:  </td><td>".$_POST['MaritalStatus']."</td></tr>".
"<tr><td>Maiden Name:  </td><td>".$_POST['MaritalStatus']."</td></tr>".
"<tr><td>Sellers:  </td><td>".$_POST['Sellers']."</td></tr>".
"<tr><td>Sellers Marital Status:  </td><td>".$_POST['MaritalStatusSellers']."</td></tr>".
"<tr><td>Sellers Attorney:  </td><td>".$_POST['SellersAttorney']."</td></tr>".
"<tr><td>Sellers Phone: </td><td>".$_POST['SellersPhone']."</td></tr>".
"<tr><td>Sellers Fax: </td><td>".$_POST['SellersFax']."</td></tr>".

"<tr><td>Sellers Address </td><td>".$_POST['SellersAddress']."</td></tr>".
"<tr><td>Sellers Email: </td><td>".$_POST['SellersEmail']."</td></tr></table><br/>".
"Send the above referenced attorney a copy of the commitment directly?: ".$_POST['SendCopy']."<br/>".

"<b>Lender Information:<b/><br/>".
"<table border='1'><tr><td>Lender Name:</td><td>".$_POST['LenderName']."</td></tr>".
"<tr><td>Lender Contact:  </td><td>".$_POST['LenderContact']."</td></tr>".
"<tr><td>Lender Phone:</td><td>".$_POST['LenderPhone']."</td></tr>".
"<tr><td>Lender Address:</td><td>".$_POST['LenderAddress']."</td></tr>".
"<tr><td>Lender City:</td><td>".$_POST['LenderCity']."</td></tr>".
"<tr><td>Lender State:</td><td>".$_POST['LenderState']."</td></tr>".
"<tr><td>Lender Zip:</td><td>".$_POST['LenderZip']."</td></tr>".
"<tr><td>Lender Fax:</td><td>".$_POST['LenderFax']."</td></tr>".
"<tr><td>Mortgage Clause:</td><td>".$_POST['MortgageClause']."</td></tr></table><br/>".

'<b>Would you like us to send the above referenced lender a copy of the Commitment?: '.$_POST['Lender_Copy']."<br/>". 
'Would you like us to order a Survey?: '.$_POST['OrderSurvey']."<br/>". 
'Would you like us to order a Flood Search?: '.$_POST['FloodSearch']."<br/>". 
'Would you like us to file a Notice of Settlement?: '.$_POST['NoticeOfSettlement']."<br/><br/>". 
'Existing Mortgage Payoff: '.$_POST['PayOff']."<br/>".
'SpecialInstructionsComments: </b><br/>'.$_POST['Comments']; 
 


	$mail = new PHPMailer();
	// Set PHPMailer to use the sendmail transport
	$mail->isSendmail();
	//Set who the message is to be sent from
	$mail->setFrom('support@lssoftwaresolutions.com');
	//Set an alternative reply-to address
	//$mail->addReplyTo('replyto@example.com', 'First Last');
	
        //Set who the message is to be sent to
        $mail->addAddress('support@lssoftwaresolutions.com');
	
        //Set the subject line
	$mail->Subject = 'LodeStar NY/NJ Online Order';

	$mail->Body = $body;
        
        $mail->AltBody = 'Your Res/Title created GFE results are attached.';
	// $string = file_get_contents('HUD.pdf');
	// $mail->AddStringAttachment($string, 'HUD.pdf', $encoding = 'base64', $type = 'application/pdf');
        
        if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
	} 
        else {echo "<html><body><script>location.href='titlesent.php'</script></body></html>";}


 ?>

<html>
<body>
    
    
</body>    
</html>