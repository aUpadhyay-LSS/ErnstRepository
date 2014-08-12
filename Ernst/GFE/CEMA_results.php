<?php
require '../PHPMailerAutoload.php';

header('P3P: CP="CAO PSA OUR"');
session_start();
ob_flush();

// #Implement
//Database connection
//$username="jimboind_demo";
//$password="Test123";
//$database="jimboind_Demo";

include ('les_config.php');

$db = mysql_connect('localhost',$username,$password);
@mysql_select_db($database) or die( "Unable to select database ". mysql_error());
error_reporting(E_ALL);


//HTML Output
echo "<html><head>";

if(preg_match('/(?i)msie [7-8]/',$_SERVER['HTTP_USER_AGENT'])==1)
{

echo '<link rel="stylesheet" href="css/GFE_old.css" type="text/css" />';
echo '<style>li{float:left;display:inline;}</style>';
}
else
{
echo '<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />';
}

echo "</head><body style='background: #efeee9;'>";

echo '<div class="container">';
 
if(preg_match('/(?i)msie [7-8]/',$_SERVER['HTTP_USER_AGENT'])==1)
{

echo '<ul>';
if($GLOBALS["gfe"]=="1"){echo '<li><a href="GFE_main.php" class="navbutton">GFE</a></li>';}
if($GLOBALS["ac"]=="1"){echo '<li><a href="AC_main.php" class="navbutton">Affordability</a></li>'; }
if($GLOBALS["nyc"]=="1"){echo '<li class="active"><a href="CEMA_main.php" class="navbutton">New York</a></li>'; } 
if($GLOBALS["ctic"]=="1"){echo '<li><a href="COMM_main.php" class="navbutton">Commercial</a></li>';}
 
echo '<li><a href="history.php" class="navbutton">Search History</a></li>
<li><a href="ordertitle.php" class="navbutton">Order Title</a></li>
<li><a href="myprofile.php" class="navbutton">Profile</a></li>
<li><a href="logout.php" class="navbutton">Log Out</a></li>';
echo '</ul>';

}
else{

echo '<nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="http://lssoftwaresolutions.com/" target="_blank"><img class="img-responsive" src="./Images/lode_star_logo.png" style="height:50px;widht:102px" alt="Responsive image"></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">';
 if($GLOBALS["gfe"]=="1"){echo '<li><a href="GFE_main.php" class="navbutton">GFE</a></li>';}
if($GLOBALS["ac"]=="1"){echo '<li><a href="AC_main.php" class="navbutton">Affordability</a></li>'; }
if($GLOBALS["nyc"]=="1"){echo '<li class="active"><a href="CEMA_main.php" class="navbutton">New York</a></li>'; } 
if($GLOBALS["ctic"]=="1"){echo '<li><a href="COMM_main.php" class="navbutton">Commercial</a></li>';}
 echo '</ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="ordertitle.php">Order Title</a></li>
      <li><a href="myprofile.php">Profile</a></li>
      <li><a href="history.php">Searches</a></li>
      <li><a href="logout.php">Log Out</a></li>
    </ul>
  </div><!-- /.navbar-collapse -->

</nav>';


}

echo '</div>';

echo "<div class='container'> <div id='cema-results'>";
echo "<a href='CEMA_main.php'>Back to New York Calculator</a><br/><br/>";


if(isset($_POST['CEMA_Email'])){

$_SESSION['CEMA_Email'] = $_POST['CEMA_Email'];
//#Implement
//Create a new PHPMailer instance
	$mail = new PHPMailer();
	// Set PHPMailer to use the sendmail transport
	$mail->isSendmail();
	//Set who the message is to be sent from
	
	$mail->setFrom('support@lssoftwaresolutions.com');
	
	//Set an alternative reply-to address
	//$mail->addReplyTo('replyto@example.com', 'First Last');
	//Set who the message is to be sent to
	$mail->addAddress($_SESSION['CEMA_Email']);
	//Set the subject line
	$mail->Subject = 'New York Calculations: '.$_SESSION['InsuranceType'];
	
	$mail->Body = "<b>Ready to Order Title for this quote? </b><br/><br/>".$_SESSION['outputtext']."</p><br/>";
	
	$mail->AltBody = 'Your created GFE results are attached.';
	

	if (!$mail->send()) {
	echo "<script>alert('Email Address not valid');";
	} else {	}    
    
    #Implement

    
     echo "<meta http-equiv='refresh' content='0;URL=CEMA_main.php'/>";
    }
    else {

//sets $purchase values for 
if($_POST['InsuranceType']=='Refinance' || $_POST['InsuranceType']=='Refinance_CEMA'){$purchase=0;}
else {$purchase=1;}

//Variable initialization
$loan_amount=$_POST['loan_amount'];  $_SESSION['loan_amount']=$loan_amount;  
if(isset( $_POST['TitleOrderOnly'])){ $TitleOrderOnly  =  0;$_SESSION['TitleOrderOnly']=0;}else{$TitleOrderOnly =1;$_SESSION['TitleOrderOnly']=1;}//
if(isset( $_POST['purchase_price'])){ $purchase_price  =  $_POST['purchase_price'];$_SESSION['purchase_price']=$purchase_price;}else{$purchase_price =0;}
if(isset($_POST['county'])){ $county  = $_POST['county'];$_SESSION['county']=$county;}else{$county ="";}
if(isset( $_POST['township'])){ $township  =  $_POST['township'];}else{$township ="NA";}$_SESSION['township']=$township;
$_SESSION['InsuranceType']=$_POST['InsuranceType'];
$_SESSION['PropertyType']=$_POST['PropertyType'];
if(isset( $_POST['prior_insurance'])){ $PriorInsurance  =  $_POST['prior_insurance'];$_SESSION['PriorInsurance']=$PriorInsurance;}else{$PriorInsurance =0;}
if(isset( $_POST['Principalbalance']) && $_POST['InsuranceType']=='Refinance_CEMA'){ $PrincipalBalance  =  $_POST['Principalbalance'];$_SESSION['PrincipalBalance']= $PrincipalBalance;}else{$PrincipalBalance =0;}


if(is_null($_SESSION['Username'])){$_SESSION['Username']="Mobile";}



//Querying LES_engine
//Setting posts

$_POST['purpose'] = $purchase;
$_POST['state']="NY";
$_POST['search_type']= "CEMA";
$_POST['Username'] = $_SESSION['Username'];

$engineURL = $GLOBALS['path'].'les_engine.php';
//open connection
$ch = curl_init();
$postvars='';
$sep='';
foreach($_POST as $key=>$value) 
{ 
   $postvars.= $sep.urlencode($key).'='.urlencode($value); 
   $sep='&'; 
}

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL,$engineURL);
curl_setopt($ch,CURLOPT_POST,count($postvars));
curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

//execute post
$curl_results2 = curl_exec($ch);
//echo $curl_result;
//close connection
curl_close($ch);


$curl_results = json_decode($curl_results2,true);

$ClosingFee = $curl_results['closingfee'];

//Fee Initialization
$Residential_Mortgage = $curl_results['residential_mortgage'];
$Tirsa81 = $curl_results['tirsa81'];
$WaiverOfArbitration = $curl_results['waiver_of_arbitration'];
$TBPsearch = $curl_results['TBP_search'];
$AttorneySettlement = $curl_results['settlementfee'];
$Muni_Searches = $curl_results['muni_searches'];

$ClosingFee = $curl_results['closingfee'];
$AbstractFee = $curl_results['abstractfee'];
$NotaryFee = $curl_results['notaryfee'];
$Endorsements= $curl_results['endorsements'];
$TaxResearchFee= $curl_results['taxresearchfee'];
$CourierFee= $curl_results['courierfee'];
$WireFee = $curl_results['wirefee'];
$DeedFee = $curl_results['deedfee'];
$MortgageRecording = $curl_results['mortgagerecording'];
$RecordingProcessing = $curl_results['recordingprocessing'];
$DischargeTracking = $curl_results['dischargetracking'];
$MiscStateFees = $curl_results['miscstatefees'];
$DischargeMortgage = $curl_results['dischargemortgage'];
$SimIssue= $curl_results['simissue'];
$LendersMtgTax = $curl_results['mortgagetax'];
$MansionTax= $curl_results['MansionTax'];


//Updated Recording Fees
$CEMA_Assignment = $curl_results['CEMA_Assignment'];
$Satisfaction = $curl_results['Satisfaction'];
$DeedRecording = $curl_results['DeedRecording'];
$CondoEndorsement= $curl_results['CondoEndorsement'];
$Line1203 = $curl_results['line1203'];
$transfertax = $curl_results['transfertax'];
$LoanPol = $curl_results['loanpol'];
$OwnersPol = $curl_results['ownerspol'];
$AttorneySettlement = $curl_results['settlementfee'];

$county = $curl_results['county'];
$township = $curl_results['town'];

$Line1101 = $curl_results['line1101'];
$Line1103 = $curl_results['line1103'];
$Line1201 = $curl_results['line1201'];

$BuyerTotal = $curl_results['buyer_total'];
$SellerTotal= $curl_results['seller_total'];
$LenderTotal = $curl_results['lender_total'];
$TotalEstimate = $curl_results['total_estimate'];


//Title Order Only Message
if($TitleOrderOnly==0){
$outputtext = "<p style=color:red;>This quote is for title related charges only. There
is no lender representation quoted below. If you need fees for additional closing services,
please return to the input page and uncheck the “Title Order Only” box.</p><br/>";
}
else {$outputtext="";}


//Output switch statement for various purchase types
switch($_POST['InsuranceType']){
case "Refinance":

$outputtext =$outputtext."<h1><b>Description</b></h1>";
$outputtext =$outputtext."<table border='0' width=500px >";    
$outputtext =$outputtext."<tr><td><b>County:</b></td><td>".$county."</td><td><b>Loan Amount:</b></td><td>".PrettyPrint($_POST['loan_amount'])."</td></tr>";
$outputtext =$outputtext."<tr><td><b>Municipality:</b></td><td>".$township."</td><td><b>Prior Insurance:</b></td><td>".PrettyPrint($_POST['prior_insurance'])."</td></tr>";
$outputtext =$outputtext."<tr><td><b>Property Type:</b></td><td>".$_POST['PropertyType']."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td><b>Insurance Type:</b></td><td>".$_POST['InsuranceType']."</td><td></td><td></td></tr>";
$outputtext =$outputtext."</table><br/><br/>";
$outputtext =$outputtext."<h1><b>Loan Estimate</b></h1><form method='post' action='CEMA_results.php'><table border='0' width=500 >";    
$outputtext =$outputtext."<tr><td><b>Loan Policy and Endorsements</b></td><td width = 100><b>Buyer</b></td><td width = 100><b>Seller</b></td><td><b>Lender</b></td></tr>";
$outputtext =$outputtext."<tr><td>Mortgage Ins.(".PrettyPrint($_POST['loan_amount']).")</td><td>".PrettyPrint($LoanPol)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>Residential Mortgage</td><td>".PrettyPrint($Residential_Mortgage)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>TIRSA-8.1 Environmental Lien</td><td>".PrettyPrint($Tirsa81)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>Waiver of Arbitration</td><td>".PrettyPrint($WaiverOfArbitration)."</td><td></td><td></td></tr>";
if($_POST['PropertyType']=="Condo"){$outputtext =$outputtext."<tr><td>Condominium Endorsement</td><td>".PrettyPrint($CondoEndorsement)."</td><td></td><td></td></tr>";}
$outputtext =$outputtext."<tr><td>&nbsp;</td></tr><tr><td colspan='4'><b>Miscellaneous Charges</b></td></tr>";
$outputtext =$outputtext."<tr><td>Tax, Bankruptcy, & Patriot Searches</td><td>".PrettyPrint($TBPsearch)."</td><td></td><td></td></tr>";
if($TitleOrderOnly==1){$outputtext =$outputtext."<tr><td>Attorney Settlement Fee</td><td>".PrettyPrint($AttorneySettlement)."</td><td></td><td></td></tr>";}
$outputtext =$outputtext."<tr><td>Courier Fee</td><td>".PrettyPrint($CourierFee)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>Wire Fee</td><td>".PrettyPrint($WireFee)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>Recording Processing</td><td>".PrettyPrint($RecordingProcessing)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>&nbsp;</td></tr><tr><td colspan='4'><b>State & Local Taxes</b></td></tr>";
$outputtext =$outputtext."<tr><td>Mortgage Tax</td><td>".PrettyPrint($Line1203)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>Lender's Mtg. Tax</td><td></td><td></td><td>".PrettyPrint($LendersMtgTax)."</td></tr>";
$outputtext =$outputtext."<tr><td>&nbsp;</td></tr><tr><td colspan='4'><b>Recording Fees</b></td></tr>";
$outputtext =$outputtext."<tr><td>Mortgage Recording</td><td>".PrettyPrint($MortgageRecording)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>Satisfaction</td><td>".PrettyPrint($Satisfaction)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>&nbsp;</td></tr><tr><td><b>Total Estimate: ".PrettyPrint($TotalEstimate)."</b></td><td><b>".PrettyPrint($BuyerTotal)."</b></td><td><b>".PrettyPrint($SellerTotal)."</b></td><td><b>".PrettyPrint($LenderTotal)."<b/></td></tr>";
$outputtext =$outputtext."</table><br/><br/>";

break; //end Refinance

case "Refinance_CEMA":

$outputtext =$outputtext."<h1><b>Description</b></h1>";
$outputtext =$outputtext."<table border='0' width=500px >";    
$outputtext =$outputtext."<tr><td><b>County:</b></td><td>".$county."</td><td><b>Loan Amount:</b></td><td>".PrettyPrint($_POST['loan_amount'])."</td></tr>";
$outputtext =$outputtext."<tr><td><b>Municipality:</b></td><td>".$township."</td><td><b>Prior Insurance:</b></td><td>".PrettyPrint($_POST['prior_insurance'])."</td></tr>";
$outputtext =$outputtext."<tr><td><b>Property Type:</b></td><td>".$_POST['PropertyType']."</td><td><b>Principal Balance:</b></td><td>".PrettyPrint($_POST['Principalbalance'])."</td></tr>";
$outputtext =$outputtext."<tr><td><b>Insurance Type:</b></td><td>".$_POST['InsuranceType']."</td><td></td><td></td></tr>";
$outputtext =$outputtext."</table><br/><br/>";
$outputtext =$outputtext."<h1><b>Loan Estimate</b></h1><form method='post' action='CEMA_results.php'><table border='0' width=500 >";    
$outputtext =$outputtext."<tr><td><b>Loan Policy and Endorsements</b></td><td width = 100><b>Buyer</b></td><td width = 100><b>Seller</b></td><td><b>Lender</b></td></tr>";
$outputtext =$outputtext."<tr><td>Mortgage Ins.(".PrettyPrint($_POST['loan_amount']).")</td><td>".PrettyPrint($LoanPol)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>Residential Mortgage</td><td>".PrettyPrint($Residential_Mortgage)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>TIRSA-8.1 Environmental Lien</td><td>".PrettyPrint($Tirsa81)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>Waiver of Arbitration</td><td>".PrettyPrint($WaiverOfArbitration)."</td><td></td><td></td></tr>";
if($_POST['PropertyType']=="Condo"){$outputtext =$outputtext."<tr><td>Condominium Endorsement</td><td>".PrettyPrint($CondoEndorsement)."</td><td></td><td></td></tr>";}
$outputtext =$outputtext."<tr><td>&nbsp;</td></tr><tr><td colspan='4'><b>Miscellaneous Charges</b></td></tr>";
$outputtext =$outputtext."<tr><td>Tax, Bankruptcy, & Patriot Searches</td><td>".PrettyPrint($TBPsearch)."</td><td></td><td></td></tr>";
if($TitleOrderOnly==1){$outputtext =$outputtext."<tr><td>Attorney Settlement Fee</td><td>".PrettyPrint($AttorneySettlement)."</td><td></td><td></td></tr>";}
$outputtext =$outputtext."<tr><td>Courier Fee</td><td>".PrettyPrint($CourierFee)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>Wire Fee</td><td>".PrettyPrint($WireFee)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>Recording Processing</td><td>".PrettyPrint($RecordingProcessing)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>&nbsp;</td></tr><tr><td colspan='4'><p><i>*CEMA Processing Fee of $250 may apply</i></p></td></tr>";
$outputtext =$outputtext."<tr><td>&nbsp;</td></tr><tr><td colspan='4'><b>State & Local Taxes</b></td></tr>";
$outputtext =$outputtext."<tr><td>Mortgage Tax</td><td>".PrettyPrint($Line1203)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>Lender's Mtg. Tax</td><td></td><td></td><td>".PrettyPrint($LendersMtgTax)."</td></tr>";
$outputtext =$outputtext."<tr><td>&nbsp;</td></tr><tr><td colspan='4'><b>Recording Fees</b></td></tr>";
$outputtext =$outputtext."<tr><td>Mortgage Recording</td><td>".PrettyPrint($MortgageRecording)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>CEMA & Assignment</td><td>".PrettyPrint($CEMA_Assignment)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>Satisfaction</td><td>".PrettyPrint($Satisfaction)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>&nbsp;</td></tr><tr><td><b>Total Estimate: ".PrettyPrint($TotalEstimate)."</b></td><td><b>".PrettyPrint($BuyerTotal)."</b></td><td><b>".PrettyPrint($SellerTotal)."</b></td><td><b>".PrettyPrint($LenderTotal)."<b/></td></tr>";
$outputtext =$outputtext."</table><br/><br/>";

break; //end CEMA Refinance

case "Fee Insurance":
    
$outputtext =$outputtext."<h1><b>Description</b></h1>";
$outputtext =$outputtext."<table border='0' width=500px >";    
$outputtext =$outputtext."<tr><td class='tdb'><b>County:</b></td><td>".$county."</td><td class='tdb'><b>Purchase Price:</b></td><td>".PrettyPrint($_POST['purchase_price'])."</td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'><b>Municipality:</b></td><td>".$township."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'><b>Property Type:</b></td><td>".$_POST['PropertyType']."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'><b>Insurance Type:</b></td><td>".$_POST['InsuranceType']."</td><td></td><td></td></tr>";
$outputtext =$outputtext."</table><br/><br/>";
$outputtext =$outputtext."<h1><b>Loan Estimate</b></h1><form method='post' action='CEMA_results.php'><table border='0' width=500 >";    
$outputtext =$outputtext."<tr><td><b>Owners Policy and Endorsements</b></td><td width = 100><b>Buyer</b></td><td width = 100><b>Seller</b></td><td><b>Lender</b></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>Fee Ins.(".PrettyPrint($_POST['purchase_price']).")</td><td>".PrettyPrint($OwnersPol)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>&nbsp;</td></tr><tr><td colspan='4'><b>Miscellaneous Charges</b></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>Tax, Bankruptcy, & Patriot Searches</td><td>".PrettyPrint($TBPsearch)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>Courier Fee</td><td>".PrettyPrint($CourierFee)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>Wire Fee</td><td>".PrettyPrint($WireFee)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>Recording Processing</td><td>".PrettyPrint($RecordingProcessing)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>Municipal Searches</td><td>".PrettyPrint($Muni_Searches)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>&nbsp;</td></tr><tr><td colspan='4'><p><i>*CEMA Processing Fee of $250 may apply</i></p></td></tr>";

if($MansionTax>0 || $transfertax>0){ $outputtext =$outputtext."<tr><td>&nbsp;</td></tr><tr><td colspan='4'><b>State & Local Taxes</b></td></tr>";}
if($MansionTax>0){$outputtext =$outputtext."<tr><td>Mansion Tax</td><td>".PrettyPrint($MansionTax)."</td><td></td><td></td></tr>";}
if($transfertax>0){$outputtext =$outputtext."<tr><td>Transfer Tax</td><td></td><td>".PrettyPrint($transfertax)."</td><td></td></tr>";}

$outputtext =$outputtext."<tr><td>&nbsp;</td></tr><tr><td colspan='4'><b>Recording Fees</b></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>Deed Recording</td><td>".PrettyPrint($DeedRecording)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>&nbsp;</td></tr><tr><td><b>Total Estimate: ".PrettyPrint($TotalEstimate)."</b></td><td><b>".PrettyPrint($BuyerTotal)."</b></td><td><b>".PrettyPrint($SellerTotal)."</b></td><td><b>".PrettyPrint($LenderTotal)."<b/></td></tr>";
$outputtext =$outputtext."</table><br/><br/>";

break;

case "Purchase":
      
$outputtext =$outputtext."<h1><b>Description</b></h1>";
$outputtext =$outputtext."<table border='0' width=500px >";    
$outputtext =$outputtext."<tr><td class='tdb'><b>County:</b></td><td>".$county."</td><td><b>Purchase Price:</b></td><td>".PrettyPrint($_POST['purchase_price'])."</td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'><b>Municipality:</b></td><td>".$township."</td><td><b>Loan Amount:</b></td><td>".PrettyPrint($_POST['loan_amount'])."</td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'><b>Property Type:</b></td><td>".$_POST['PropertyType']."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'><b>Insurance Type:</b></td><td>".$_POST['InsuranceType']."</td><td></td><td></td></tr>";
$outputtext =$outputtext."</table><br/><br/>";
$outputtext =$outputtext."<h1><b>Loan Estimate</b></h1><form method='post' action='CEMA_results.php'><table border='0' width=500 >";    
$outputtext =$outputtext."<tr><td class='tdb'><b>Owners Policy and Endorsements</b></td><td width = 100><b>Buyer</b></td><td width = 100><b>Seller</b></td><td><b>Lender</b></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>Fee Ins.(".PrettyPrint($_POST['purchase_price']).")</td><td>".PrettyPrint($OwnersPol)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>&nbsp;</td></tr><tr><td colspan='4'><b>Loan Policy and Endorsements</b></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>Mortgage Ins.(".PrettyPrint($_POST['loan_amount']).")</td><td>".PrettyPrint($LoanPol)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>Residential Mortgage</td><td>".PrettyPrint($Residential_Mortgage)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>TIRSA-8.1 Environmental Lien</td><td>".PrettyPrint($Tirsa81)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>Waiver of Arbitration</td><td>".PrettyPrint($WaiverOfArbitration)."</td><td></td><td></td></tr>";
if($_POST['PropertyType']=="Condo"){$outputtext =$outputtext."<tr><td>Condominium Endorsement</td><td>".PrettyPrint($CondoEndorsement)."</td><td></td><td></td></tr>";}
$outputtext =$outputtext."<tr><td>&nbsp;</td></tr><tr><td colspan='4'><b>Miscellaneous Charges</b></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>Tax, Bankruptcy, & Patriot Searches</td><td>".PrettyPrint($TBPsearch)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>Courier Fee</td><td>".PrettyPrint($CourierFee)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>Wire Fee</td><td>".PrettyPrint($WireFee)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>Recording Processing</td><td>".PrettyPrint($RecordingProcessing)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>Municipal Searches</td><td>".PrettyPrint($Muni_Searches)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td>&nbsp;</td></tr><tr><td colspan='4'><p><i>*CEMA Processing Fee of $250 may apply</i></p></td></tr>";
$outputtext =$outputtext."<tr><td>&nbsp;</td></tr><tr><td colspan='4'><b>State & Local Taxes</b></td></tr>";
$outputtext =$outputtext."<tr><td>Mortgage Tax</td><td>".PrettyPrint($Line1203)."</td><td></td><td></td></tr>";
if($MansionTax>0){$outputtext =$outputtext."<tr><td>Mansion Tax</td><td>".PrettyPrint($MansionTax)."</td><td></td><td></td></tr>";}
if($transfertax>0){$outputtext =$outputtext."<tr><td>Transfer Tax</td><td></td><td>".PrettyPrint($transfertax)."</td><td></td></tr>";}
$outputtext =$outputtext."<tr><td>&nbsp;</td></tr><tr><td colspan='4'><b>Recording Fees</b></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>Deed Recording</td><td>".PrettyPrint($DeedRecording)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>Mortgage Recording</td><td>".PrettyPrint($MortgageRecording)."</td><td></td><td></td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>Satisfaction</td><td></td><td>".PrettyPrint($Satisfaction)."</td><td></td></tr>";
$outputtext =$outputtext."<tr><td>&nbsp;</td></tr><tr><td><b>Total Estimate: ".PrettyPrint($TotalEstimate)."</b></td><td><b>".PrettyPrint($BuyerTotal)."</b></td><td><b>".PrettyPrint($SellerTotal)."</b></td><td><b>".PrettyPrint($LenderTotal)."<b/></td></tr>";
$outputtext =$outputtext."</table><br/><br/>";

break;

}//end InsuranceType Switch

$outputtext =$outputtext."<h1>Good Faith Estimate</h1><br/>";
$outputtext =$outputtext."<table border='0' width='500px'>";
$outputtext =$outputtext."<tr><td class='tdb'>GFE Line 4 - Title services and lender's title insurance</td><td>".PrettyPrint($Line1101)."</td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>GFE Line 5 - Owner's title insurance</td><td>".PrettyPrint($Line1103)."</td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>GFE Line 7 - Government Recording Charges</td><td>".PrettyPrint($Line1201)."</td></tr>";
$outputtext =$outputtext."<tr><td class='tdb'>GFE Line 8 - Transfer Taxes</td><td>".PrettyPrint($Line1203+$MansionTax)."</td></tr>";
$outputtext =$outputtext."</table><br/><br/>";


$_SESSION['outputtext']=$outputtext;
$outputtext =$outputtext."<h1>Email Rate Estimate</h1>";
$outputtext =$outputtext."<table><tr><td>Email Address:<input type='text' name='CEMA_Email' value='".$_SESSION['Username']."' size='50'/>&nbsp;&nbsp;&nbsp;";
$outputtext =$outputtext."<input type='submit' style='height:25px; width:90px; text-align:center;' name='SendEmail' value= 'Send Email' /></td></tr></table></form>";

//Table Output
echo $outputtext;



//Test Outputs


echo "</div> </div>";
echo "<br/><br/><a href='CEMA_main.php'>Back to New York Calculator</a>";
    
    }//End calculations 

echo "</body></html>";    


function PrettyPrint($number){
    if(isset($number) && $number>=0){    return "$".number_format($number);}
    else {return;}
}//End PrettyPrint()

?>