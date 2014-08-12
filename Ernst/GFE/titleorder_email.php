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

include ('les_config.php');

$db = mysql_connect('localhost',$username,$password);
@mysql_select_db($database) or die( "Unable to select database ". mysql_error());

error_reporting(E_ALL);

$insert = "INSERT INTO `TitleOrders`(`State`,`Username`,`OrderedBy`,`LoanOfficer`,`Processor`) VALUES ('".$_POST['OrderState']."','".$_SESSION['Username'].
"','".$_POST['RequestedBy']."','".$_POST['LoanOfficer']."','".$_POST['Processor']."')";
mysql_query($insert);
$_SESSION['insert'] = $insert;

// $body = "We have received the following information:\n\n"; foreach($fields as $a => $b){ 	$body .= sprintf("%20s: %s\n",$b,$_REQUEST[$a]); } 

$body = "<table border='1'><tr><td>LoanType:</td><td>".$_SESSION['loantype']."</td></tr>".
"<tr><td>State:</td><td>".$_POST['PropertyState']."</td></tr>".
"<tr><td>Purchase Price:</td><td>".$_SESSION['salesprice']."</td></tr><tr><td>Loan Amount:</td><td>".$_SESSION['loanamount']."</td></tr>".
"<tr><td>Home Equity Line:</td><td>".$_POST['checkbox']."</td></tr>".
"<tr><td>Requested By:</td><td>".$_POST['RequestedBy']."</td></tr>".
"<tr><td>Phone:</td><td>".$_POST['Phone']."</td></tr>".
"<tr><td>E-Mail:</td><td>".$_POST['Email']."</td></tr>".
"<tr><td>Fax:</td><td>".$_POST['Fax']."</td></tr></table><br/>";

$body=$body."<b>Processor Information</b><br/>".
"<table border='1'><tr><td>Processor Name:</td><td>".$_POST['Processor']."</td></tr>".
"<tr><td>Processor Phone:</td><td>".$_POST['ProcessorPhone']."</td></tr>".
"<tr><td>Processor E-Mail:</td><td>".$_POST['ProcessorEmail']."</td></tr>".
"<tr><td>Processor Fax:</td><td>".$_POST['ProcessorFax']."</td></tr></table><br/>";

$body=$body."<b>Borrower Information</b><br/>".
"<table border='1'><tr><td>Borrower 1 Name:</td><td>".$_POST['Borrower1LastName'].", ".$_POST['Borrower1FirstName']."</td></tr>".
"<tr><td>Borrower 1 Work Phone:</td><td>".$_POST['BorrowerWorkPhone']."</td></tr>".
"<tr><td>Borrower 1 Cell Phone:</td><td>".$_POST['BorrowerCellPhone']."</td></tr>".
"<tr><td>Borrower 1 Home Phone:</td><td>".$_POST['BorrowerHomePhone']."</td></tr>".
"<tr><td>Borrower 1 E-Mail:</td><td>".$_POST['BorrowerEmail']."</td></tr>".
"<tr><td>Borrower 1 Processor Fax:</td><td>".$_POST['BorrowerFax']."</td></tr><tr><td colspan='2'></td></tr>".
"<tr><td>Borrower 2 Name:</td><td>".$_POST['Borrower2LastName'].", ".$_POST['Borrower2FirstName']."</td></tr>".
"<tr><td>Borrower 2 Work Phone:</td><td>".$_POST['Borrower2WorkPhone']."</td></tr>".
"<tr><td>Borrower 2 Cell Phone:</td><td>".$_POST['Borrower2CellPhone']."</td></tr>".
"<tr><td>Borrower 2 Home Phone:</td><td>".$_POST['Borrower2HomePhone']."</td></tr>".
"<tr><td>Borrower 2 Processor Fax:</td><td>".$_POST['Borrower2Fax']."</td></tr></table><br/>";

$body=$body."<b>Loan Information</b><br/>".
"<table border='1'><tr><td>Estimated Closing Date:</td><td>".$_POST['EstimatedClosing']."</td></tr>".
"<tr><td>Loan Amount:</td><td>".$_POST['LoanAmount']."</td></tr>".
"<tr><td>Loan ID:</td><td>".$_POST['LoanIDNumber']."</td></tr>".
"<tr><td>Property Address:</td><td>".$_POST['PropertyAddress']."</td></tr>".
"<tr><td>City:</td><td>".$_POST['PropertyCityTown']."</td></tr>".
"<tr><td>State:</td><td>".$_POST['PropertyState']."</td></tr>".
"<tr><td>Zip Code:</td><td>".$_POST['PropertyZipCode']."</td></tr>".
"<tr><td>Tax Parcel ID:</td><td>".$_POST['TaxParcelID']."</td></tr>".
"<tr><td colspan='2'></td></tr>".
"<tr><td>Loan Officer:</td><td>".$_POST['LoanOfficer']."</td></tr>".
"<tr><td>Loan Officer Phone:</td><td>".$_POST['LoanOfficerPhone']."</td></tr>".
"<tr><td>Loan Officer E-Mail:</td><td>".$_POST['LoanOfficerEmail']."</td></tr>".
"<tr><td>Loan Officer Fax:</td><td>".$_POST['LoanOfficerFax']."</td></tr>".
"<tr><td>Lender Name:</td><td>".$_POST['LenderNameMortgagee']."</td></tr>".
"<tr><td>Lender Address:</td><td>".$_POST['LenderAddress']."</td></tr>".
"<tr><td>Lender Phone:</td><td>".$_POST['LenderPhone']."</td></tr>".
"<tr><td>Lender Fax:</td><td>".$_POST['LenderFax']."</td></tr></table><br/>";

$body=$body."<b>Other</b><br/>".
"<table border='1'><tr><td>Title Insurance Policy:</td><td>".$_POST['TitleInsurancePolicy']."</td></tr>".
"<tr><td>Survey Plot Affidavit:</td><td>".$_POST['SurveyPlotAffidavit']."</td></tr>".
"<tr><td>Other:</td><td>".$_POST['Other1']."</td></tr>".
"<tr><td>Seller 1 Name:</td><td>".$_POST['Seller1LastName'].', '.$_POST['Seller1FirstName']."</td></tr>".
"<tr><td>Seller 1 Phone:</td><td>".$_POST['Seller1Phone']."</td></tr>".
"<tr><td>Seller 1 Cell Phone:</td><td>".$_POST['Seller1Cell']."</td></tr>".
"<tr><td>Seller 1 Fax:</td><td>".$_POST['Seller1Fax']."</td></tr>".
"<tr><td>Seller 2 Name:</td><td>".$_POST['Seller2LastName'].', '.$_POST['Seller2FirstName']."</td></tr>".
"<tr><td>Seller 2 Phone:</td><td>".$_POST['Seller2Phone']."</td></tr>".
"<tr><td>Seller 2 Cell Phone:</td><td>".$_POST['Seller2Cell']."</td></tr>".
"<tr><td>Seller 2 Fax:</td><td>".$_POST['Seller2Fax']."</td></tr></table><br/>";

$body=$body."<b>Comments/Special Instructions</b><br/>".
"<table ><tr><td>".$_POST['SpecialInstructionsComments']."</td></tr></table>";



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
	$mail->Subject = 'LodeStar Online Order';

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