<?php
require '../PHPMailerAutoload.php';

header('P3P: CP="CAO PSA OUR"');
session_start();
ob_flush();

error_reporting(E_ALL);

//Initialize Variables
$EmailText="";

//HTML Header
echo "<!DOCTYPE html>";
echo "<html><head>";
echo "<link rel='stylesheet' href='css/bootstrap.css' type='text/css' />";
echo "</head>";
echo "<body style='background: #efeee9;'>";
echo '<div class="container">
      <nav class="navbar navbar-default" role="navigation">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	    <span class="sr-only">Toggle navigation</span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="http://lssoftwaresolutions.com/" target="_blank"><img class="img-responsive" src="./Images/lode_star_logo.png" style="height:50px;width:102px" alt="Responsive image"></a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	  <ul class="nav navbar-nav">
	    <li><a href="GFE_main.php">GFE</a></li>
	    <li><a href="AC_main.php">Affordability</a></li>
	    <li class="active"><a href="CEMA_main.php">New York</a></li>
	    <li><a href="COMM_main.php">Commercial</a></li>
	  </ul>
	  <ul class="nav navbar-nav navbar-right">
	    <li><a href="ordertitle.php">Order Title</a></li>
	    <li><a href="myprofile.php">My Profile</a></li>
	    <li><a href="history.php">My Searches</a></li>
	    <li><a href="logout.php">Log Out</a></li>
	  </ul>
	</div><!-- /.navbar-collapse -->
      </nav>
      </div>'.
      '<div class="middle"><br/><br/><br/>';


	// #Implement
	$pdf_file_url = 'http://www.jimboindustries.com/CookieCutter_Dev/HUD1.pdf';
	//$pdf_file_url = 'http://www.jimboindustries.com/CookieCutter_Dev/HUD1.pdf';
	//$xfdf = createXFDF( $pdf_file_url, $data );

if(isset($_POST['EmailHUD'])) {

	$_SESSION['HPCEmail']="Yes";

	// #Implement
	//output_fdf('http://www.jimboindustries.com/CookieCutter_Dev/HUD1.pdf', $_SESSION['Email_data'],'y');
	output_fdf('HUD1.pdf', $_SESSION['Email_data'],'y');

	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	// Set PHPMailer to use the sendmail transport
	$mail->isSendmail();
	//Set who the message is to be sent from
	$mail->setFrom('support@lssoftwaresolutions.com');
	//Set an alternative reply-to address
	//$mail->addReplyTo('replyto@example.com', 'First Last');

        //Set who the message is to be sent to
        $mail->addAddress($_SESSION['Username']);

        //Set the subject line
	$mail->Subject = 'GFE Calculations: '.$_SESSION['state'].' '.$_SESSION['loantype'];

	$mail->Body = '<table><tr><td>&nbsp;</td><td>&nbsp;</td></tr>'.
	'<tr><td>Buyer</td><td>'.$_SESSION['buyer'].'</td></tr>'.
	'<tr><td>Seller</td><td>'.$_SESSION['seller'].'</td></tr>'.
	'<tr><td>Address</td><td>'.$_SESSION['address'].'</td></tr>'.
	'<tr><td>&nbsp;</td><td>&nbsp;</td></tr>'.
	'<tr><td>Sales Price</td><td>'.PrettyPrint($_SESSION['salesprice']).'</td></tr>'.
	'<tr><td>Loan Amount</td><td>'.PrettyPrint($_SESSION['loanamount']).'</td></tr>'.
	'<tr><td>Interest Rate</td><td>'.$_SESSION['InterestRate'].'%'.'</td></tr>'.
	'<tr><td>Loan Term</td><td>'.$_SESSION['LoanTerm'].' Years'.'</td></tr>'.
	'<tr><td>&nbsp;</td><td>&nbsp;</td></tr>'.
	'<tr><td colspan="2" style="text-align: center"><b>Monthly Payments</b></td></tr>'.
	'<tr><td>Principle & Interest Payment</td><td>'.PrettyPrint($_SESSION['MortgagePayment']).'</td></tr>'.
	'<tr><td>Taxes</td><td>'.PrettyPrint($_SESSION['MonthlyTaxes']).'</td></tr>'.
	'<tr><td>Home Owners Insurance</td><td>'.PrettyPrint($_SESSION['MonthlyHomeowners']).'</td></tr>'.
	'<tr><td>PMI (If Applicable)</td><td>'.PrettyPrint($_SESSION['MonthlyPMI']).'</td></tr>'.
	'<tr><td><b>Total Monthly Payment</b></td><td><b>'.PrettyPrint($_SESSION['MonthlyPayment']).'</b></td></tr>'.
	'<tr><td>&nbsp;</td><td>&nbsp;</td></tr>'.
	'<tr><td colspan="2" style="text-align: center"><b>Cash to Close</b></td></tr>'.
	'<tr><td>Deposit</td><td>'.PrettyPrint($_SESSION['deposit']).'</td></tr>'.
	'<tr><td>Cash at Closing</td><td>'.PrettyPrint($_SESSION['Closing_Costs']).'</td></tr>'.
	'<tr><td><b>**Total Cash to Close</b></td><td><b>'.PrettyPrint($_SESSION['Closing_Costs'] + $_SESSION['deposit']).'</b></td></tr>'.
	'<tr><td colspan="2"><i>**Does not include adjustments between buyer and seller at closing</i></td></tr>'.
	'<tr><td>&nbsp;</td><td>&nbsp;</td></tr></table>';

        $mail->AltBody = 'Your GFE results are attached.';
	$string = file_get_contents('HUD1.pdf');
	$mail->AddStringAttachment($string, 'HUD1.pdf', $encoding = 'base64', $type = 'application/pdf');

        if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
	}

     echo '<meta http-equiv="refresh" content="0;url=AC_monthly.php"></body></html>';

    } // End Email Quote Code

else{
	// Code to go to interactive HUD for newer browsers, straight HUD download for others
if(preg_match('/(?i)msie [7-8]/',$_SERVER['HTTP_USER_AGENT'])==1)
{
echo "HUD Preview not supported for Internet Explorer 7 and 8. Please click 'Preview HUD' on the main Affordability calculator page";
echo "<meta http-equiv='refresh' content='1;URL=AC_main.php'/>";
}

else
{
echo "<meta http-equiv='refresh' content='0;URL=HUD.php'/>";
}
}

function form_spaces ($form_values){
  //remove "_" form submit put into array and add " " space to match PDF form objects
  $temp = explode("_",$form_values);
  $form_values = $temp[0];
  $array_count = count($temp);
  for ( $count = 1; $count < $array_count ; $count++ ) {
    $form_values.= " ".$temp[$count];
  }
  return $form_values;
}
	//window.location = 'HUD1.pdf';}

function output_fdf ($pdf_file, $pdf_data, $emailNeeded = "n") {

$fdf  = "%FDF-1.2\n\n";
$fdf .= "1 0 obj\n";
$fdf .= "<< /FDF << /Fields [\n";

foreach ($pdf_data as $key => $val) {
$key = form_spaces($key);
$fdf .= "<< /V ($val)/T ($key) >>\n";
}

$fdf .= "]/F ($pdf_file) >>\n";
$fdf .= ">>\nendobj\ntrailer\n";
$fdf .= "<</Root 1 0 R >>\n";
$fdf .= "%%EOF";
	if($emailNeeded === "n"){
	$fh = fopen("HUD1.fdf","w");
	$fdf_name = "HUD1.fdf";
	if ($fh){
	fwrite($fh,$fdf);
	//echo "File Written";
	fclose($fh);
	// echo "File Closed";

	header("Content-Type: application/force-download");
	header("Content-Disposition: attachment; filename=HUD1.pdf");
	passthru("/usr/bin/pdftk $pdf_file fill_form $fdf_name output - ");
	exit;
	}
	 else{  echo "File Could Not Be Opened"; } }
	else{
	$fp = fopen("php://temp", 'r+');
	fwrite($fp, $fdf);
	rewind($fp);
	$command = "/usr/bin/pdftk $pdf_file fill_form - output HUD1.pdf";
	$descriptorspec = array(
    0 => $fp, // feed stdin of process from this file descriptor
	//    1 => array('pipe', 'w'), // Note you can also grab stdout from a pipe, no need for temp file
	);
	$prochandle = proc_open($command, $descriptorspec, $pipes);
	// busy-wait until it finishes running
	do {
    usleep(10000);
    $stat = proc_get_status($prochandle);
	} while ($stat and $stat['running']);


	// cleanup
foreach ($pipes as $pipe) {
   fclose($pipe);
}
proc_close($prochandle);

	}
}// End output fdf

function PrettyPrint($number){
    if(isset($number) && $number>=0){    return "$".number_format($number);}
    else {return;}
}//End PrettyPrint()

?>