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

//Variables from HTML Form 
 
$state = $_POST['state'];
$county =$_POST['county'];
$township = $_POST['township'];
$purchase_price = $_POST['purchase_price'];
$deposit = $_POST['deposit'];
$loan_amount = $_POST['loan_amount'];
$InterestRate = $_POST['interest_rate'];
$loanterm = $_POST['loan_term'];
$RealEstateTaxes= $_POST['RealEstateTaxes'];
$taxespaid = $_POST['TaxesPaid'];
$HomeOwners = $_POST['insurance'];
$buyer = $_POST['buyer'];
$seller = $_POST['seller'];
$lender = $_POST['lender'];
$address = $_POST['address'];
$SettlementDate = $_POST['date'];
if(isset( $_POST['TitleOrderOnly'])){ $TitleOrder =0;}else{$TitleOrder =1;}

//Brings in existing session variables if using a history re-run
//if(isset($_SESSION['Rerun'])){
// $state = $_SESSION['state'] ;
// $county = $_SESSION['county'] ;
// $township = $_SESSION['township'] ;
// $purchase_price = $_SESSION['purchase_price'] ;
// $deposit = $_SESSION['deposit'] ;
// $loan_amount = $_SESSION['loan_amount'] ;
// $InterestRate = $_SESSION['InterestRate'] ;
// $loanterm = $_SESSION['LoanTerm'] ;
// $RealEstateTaxes= $_SESSION['RealEstateTaxes'] ;
// $taxespaid = $_SESSION['WhenPaid'] ;
// $HomeOwners = $_SESSION['insurance'] ;
// $buyer = $_SESSION['buyer'] ;
// $address = $_SESSION['address'] ;
// $SettlementDate = $_SESSION['SettlementDate'] ;
//}

//Save as session variables
$_SESSION['state'] = $state;
$_SESSION['county'] = $county;
$_SESSION['township'] = $township;
$_SESSION['purchase_price'] = $purchase_price;
$_SESSION['deposit'] = $deposit;
$_SESSION['loan_amount'] = $loan_amount;
$_SESSION['InterestRate'] = $InterestRate;
$_SESSION['LoanTerm'] = $loanterm;
$_SESSION['RealEstateTaxes'] = $RealEstateTaxes;
$_SESSION['TaxesPaid'] = $taxespaid;
$_SESSION['insurance'] = $HomeOwners;
$_SESSION['buyer'] = $buyer;
$_SESSION['address'] = $address;
$_SESSION['seller'] = $seller;
$_SESSION['lender'] = $lender;
$_SESSION['SettlementDate'] = $SettlementDate;
$_SESSION['Old_URL'] = "HPC";
$_SESSION['loantype'] = "HPC";


//Setting posts
$_POST['purpose'] = 1;
$_POST['search_type']= "AC";
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


//$ClosingFee = $curl_results['closingfee'];
//$AbstractFee = $curl_results['abstractfee'];
//$NotaryFee = $curl_results['notaryfee'];
//$Endorsements= $curl_results['endorsements'];
//$TaxResearchFee= $curl_results['taxresearchfee'];
//$CourierFee= $curl_results['courierfee'];
//$WireFee = $curl_results['wirefee'];
//$DeedFee = $curl_results['deedfee'];
//$MortgageRecording = $curl_results['mortgagerecording'];
//$RecordingProcessing = $curl_results['recordingprocessing'];
//$DischargeTracking = $curl_results['dischargetracking'];
//$MiscStateFees = $curl_results['miscstatefees'];
//$DischargeMortgage = $curl_results['dischargemortgage'];
//$SettlementFee = $curl_results['settlementfee'];
$SimIssue= $curl_results['simissue'];
$OwnersPol= $curl_results['ownerspol'];
$LoanPol = $curl_results['loanpol'];
$LenderCost = $curl_results['lender_cost'];
// I dont know what to do with this $TaxRate = $row[1];
$Line803 = $curl_results['line803'];
$Line804 = $curl_results['line804'];
$Line805 = $curl_results['line805'];
$Line806 = $curl_results['line806'];
$Line807 = $curl_results['line807'];
$Line808 = $curl_results['line808'];
$Line808_Header = $curl_results['line808_header'];
$Line809 = $curl_results['line809'];
$Line809_Header = $curl_results['line809_header'];
$Line810 = $curl_results['line810'];
$Line810_Header = $curl_results['line810_header'];
$Line1001 = $curl_results['line1001'];
$Line1101 = $curl_results['line1101'];
$Line1103 = $curl_results['line1103'];
$Line1201 = $curl_results['line1201'];
$Line1203 = $curl_results['line1203'];
$Line1205 = $curl_results['line1205'];
$Line1301 = $curl_results['line1301'];
$TitleOrderOnly = $curl_results['TitleOrderOnly'];
$purchase = $curl_results['purpose'];
$MortgageTax = $curl_results['mortgagetax'];
$RecordationTax = $curl_results['recordationtax'];
$StateTax = $curl_results['statetax'];
$TaxCert = $curl_results['TaxCert'];
$UtilSearch = $curl_results['UtilSearch'];
$PMI = $curl_results['pmi'];
$PMI_monthly = $curl_results['pmi'];
$MortgagePayment = $curl_results['monthly'];
$MonthlyTaxes  = $curl_results['monthly_taxes'];
$MonthlyHomeowners  = $curl_results['monthly_homeowners'];
$MonthlyPayment = $curl_results['monthly_total'];
$ClosingCosts =  $curl_results['closing_costs'];
$MonthlyInterest =  $curl_results['interest_monthly'];
$Interest = $curl_results['interest_remaining'];
$TaxAdjustment = $curl_results['tax_adjustment'];

//Session variables to pass to Monthly Results 
  $_SESSION['MortgagePayment'] = $MortgagePayment;
  $_SESSION['MonthlyTaxes'] = $MonthlyTaxes;
  $_SESSION['MonthlyHomeowners']= $MonthlyHomeowners;
  $_SESSION['MonthlyPayment']=$MonthlyPayment;
  $_SESSION['MonthlyPMI']=$PMI_monthly;
  $_SESSION['Closing_Costs']= $ClosingCosts;
 
if($PMI>0)
{
   $PMI_Check = "Yes";
}
else
{
   $PMI_Check = "Off";
}

//Other Fees to Initialize
$MansionTax=0;
$purchase=1; //all orders are purchases for HPC
$ExDebt=0;


 
 $MonthlyArray = array("mp" =>$MortgagePayment,"at" => round($MonthlyTaxes),"hi" => round($MonthlyHomeowners),"pmi" => $PMI,"tp" => $MonthlyPayment);
 
 //Sets HUD Output
 	$data = array (
	'Text429' => $buyer,
        'Text430' => $seller,
        'Text431' => $_POST['lender'],
        'Text432' => $_POST['address'].", ".$state,
        //#Implement
        'Text433' => "TITLE AGENT",
        'Text435' => $SettlementDate,
        'Text437' => PrettyPrint($_POST['purchase_price']),
	'Text439' => PrettyPrint($ClosingCosts),
	'Text447' => PrettyPrint($TaxAdjustment),
        'Text462' => PrettyPrint(round($purchase_price+$ClosingCosts+$TaxAdjustment)),
        'Text464' => PrettyPrint($_POST['deposit']),
	'Text465' => PrettyPrint($_POST['loan_amount']),
	'Text503' => PrettyPrint($loan_amount+$deposit),
	'Text505' => PrettyPrint(round($purchase_price+$ClosingCosts+$TaxAdjustment)),
	'Text506' => PrettyPrint($loan_amount+$deposit),
	'Text509' => PrettyPrint(round($purchase_price+$ClosingCosts+$TaxAdjustment-$loan_amount-$deposit)),
        //Seller HUD values
        'Text510' => PrettyPrint($_POST['purchase_price']),
        'Text512' => "Settlement Charges from Buyer",
        'Text521' => PrettyPrint($TaxAdjustment),
        'Text536' => PrettyPrint(round($purchase_price+$ClosingCosts+$TaxAdjustment)),
        'Text538' => PrettyPrint($_POST['deposit']),
        'Text539' => PrettyPrint($ClosingCosts),
        'Text575' => PrettyPrint($loan_amount+$deposit),
	'Text577' => PrettyPrint(round($purchase_price+$ClosingCosts+$TaxAdjustment)),
	'Text578' => PrettyPrint($loan_amount+$deposit),
	'Text581' => PrettyPrint(round($purchase_price+$ClosingCosts+$TaxAdjustment-$loan_amount-$deposit)),     
        'Text588' => PrettyPrint(.06*$_POST['purchase_price']), //Sales Tax commission paid by seller
	'Text601' => PrettyPrint($Line803),
	'Text604' => PrettyPrint($Line804),
	'Text607' => PrettyPrint($Line805),
	'Text610' => PrettyPrint($Line806),
	'Text613' => PrettyPrint($Line807),
        'Text627' => $SettlementDate,
        'Text629' => round($MonthlyInterest/30),
	'Text631' => PrettyPrint($Interest),
        'Text637' => "1",
	'Text638' => "Insurance Company",
	'Text639' => PrettyPrint($HomeOwners),
	'Text645' => PrettyPrint($Line1001),
	'Text647' => "3",
	'Text648' => ($HomeOwners/12),
	'Text649' => ($HomeOwners/4),
	'Text870' => ($HomeOwners/4),
	'Text657' => $taxespaid,

	'Text652' => 3,
	'Text653' => round($PMI),
	'Text871' => round($PMI*3),
	'Text654' => round($PMI*3),
	'Text658' => round($RealEstateTaxes/12),
	'Text659' => $TaxAdjustment,
	'Text677' => PrettyPrint($Line1101),
	'Text684' => PrettyPrint($OwnersPol),
        
        //test only
        'Text687' => $LoanPol,
        
	'Text714' => PrettyPrint($Line1201),
	'Text722' => PrettyPrint($Line1203),	
	'Text751' => PrettyPrint($ClosingCosts),
        'Text752' => PrettyPrint(.06*$_POST['purchase_price']), //Sales Tax commission paid by seller
        'Text758' => PrettyPrint($Line803),
        'Text760' => PrettyPrint($Line1203),
        'Text762' => PrettyPrint($Line1201),
        'Text796' => PrettyPrint($Line1001),     
	'Text872' => PrettyPrint($TaxAdjustment),
	'Text814' => $loan_amount,
	'Text815' => $loanterm,
	'Text816' => $InterestRate,
	'Text817' => $MonthlyPayment,
	'Check Box818' => "Yes",
	'Check Box819' => "Yes",
	'Check Box820' => $PMI_Check);
 
 
//session variable population
SessionClear("row");

$_SESSION['row'][5] = $_POST['buyer'];
$_SESSION['row'][6] = $_POST['seller'];
$_SESSION['row'][7] = $_POST['lender'];
$_SESSION['row'][8] = $_POST['address'];
//#Implement
$_SESSION['row'][9] = "TITLE AGENT";

$_SESSION['row'][11] = $SettlementDate;
$_SESSION['row'][12] = $_POST['purchase_price'];
$_SESSION['row'][16] = $ClosingCosts;
$_SESSION['row'][26] = $TaxAdjustment;
$_SESSION['row'][58] = round($purchase_price+$ClosingCosts+$TaxAdjustment);
$_SESSION['row'][62] = $_POST['deposit'];
$_SESSION['row'][64] = $_POST['loan_amount'];
$_SESSION['row'][138] = $loan_amount+$deposit;
$_SESSION['row'][142] = round($purchase_price+$ClosingCosts+$TaxAdjustment);
$_SESSION['row'][144] = $loan_amount+$deposit;
$_SESSION['row'][148] = round($purchase_price+$ClosingCosts+$TaxAdjustment-$loan_amount-$deposit);

//Seller HUD values
$_SESSION['row'][13] = $_POST['purchase_price'];
$_SESSION['row'][430] = "Settlement Charges from Buyer";
$_SESSION['row'][29] = $TaxAdjustment;
$_SESSION['row'][59] = round($purchase_price+$ClosingCosts+$TaxAdjustment);
$_SESSION['row'][63] = $_POST['deposit'];
$_SESSION['row'][65] = $ClosingCosts;
$_SESSION['row'][139] = $loan_amount+$deposit;
$_SESSION['row'][143] = round($purchase_price+$ClosingCosts+$TaxAdjustment);
$_SESSION['row'][145] = $loan_amount+$deposit;
$_SESSION['row'][151] = round($purchase_price+$ClosingCosts+$TaxAdjustment-$loan_amount-$deposit);     
$_SESSION['row'][158] = .06*$_POST['purchase_price']; //Sales Tax commission paid by seller
$_SESSION['row'][171] = $Line803;
$_SESSION['row'][175] = $Line804;
$_SESSION['row'][179] = $Line805;
$_SESSION['row'][183] = $Line806;
$_SESSION['row'][187] = $Line807;
$_SESSION['row'][189] = $Line808_Header;
$_SESSION['row'][190] = $Line808;
$_SESSION['row'][192] = $Line809_Header;
$_SESSION['row'][193] = $Line809;
$_SESSION['row'][195] = $Line810_Header;
$_SESSION['row'][196] = $Line810;
$_SESSION['row'][201] =  $SettlementDate;
$_SESSION['row'][203] = round($MonthlyInterest/30);
$_SESSION['row'][205] = $Interest;
$_SESSION['row'][207] = 3;
$_SESSION['row'][211] =  "1";
$_SESSION['row'][212] = "Insurance Company";
$_SESSION['row'][213] = $HomeOwners;
$_SESSION['row'][219] = $Line1001;
$_SESSION['row'][221] = "3";
$_SESSION['row'][222] = ($HomeOwners/12);
$_SESSION['row'][223] = ($HomeOwners/4);

$_SESSION['row'][231] = $taxespaid;
$_SESSION['row'][226] = 3;
$_SESSION['row'][227] = round($PMI);
$_SESSION['row'][228] = round($PMI*3);
$_SESSION['row'][232] = round($RealEstateTaxes/12);
$_SESSION['row'][233] = $TaxAdjustment;
$_SESSION['row'][251] = $Line1101;
$_SESSION['row'][258] = $OwnersPol;
$_SESSION['row'][261] =  $LoanPol;
        
$_SESSION['row'][288] = $Line1201;
$_SESSION['row'][296] = $Line1203;
$_SESSION['row'][307] = $Line1205;
$_SESSION['row'][328] = $ClosingCosts;
$_SESSION['row'][329] = .06*$_POST['purchase_price']; //Sales Tax commission paid by seller
$_SESSION['row'][335] = $Line803;
$_SESSION['row'][337] = $Line1203;
$_SESSION['row'][339] = $Line1201;
$_SESSION['row'][373] = $Line1001;     
$_SESSION['row'][391] = $loan_amount;
$_SESSION['row'][392] = $loanterm;
$_SESSION['row'][393] = $InterestRate;
$_SESSION['row'][394] = $MonthlyPayment;
//	'Check Box818' => "Yes",
//	'Check Box819' => "Yes",
//	'Check Box820' => $PMI_Check);

//	'Text870' => ($HomeOwners/4),
//	'Text871' => round($PMI/4),
//	'Text872' => PrettyPrint($TaxAdjustment),
 
 
      $_SESSION['EmailBody'] = '<table>'.
       '<tr><td>Buyer</td><td>'.$_SESSION['buyer'].'</td></tr>'.
       '<tr><td>Seller</td><td>'.$_SESSION['seller'].'</td></tr>'.
       '<tr><td>Address</td><td>'.$_SESSION['address'].'</td></tr>'.
       '<tr><td>&nbsp;</td><td>&nbsp;</td></tr>'.
       '<tr><td>Sales Price</td><td>'.PrettyPrint($_SESSION['purchase_price']).'</td></tr>'.
       '<tr><td>Loan Amount</td><td>'.PrettyPrint($_SESSION['loan_amount']).'</td></tr>'.
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
       '<tr><td><b>**Total Cash to Close</b></td><td><b>'.PrettyPrint(($_SESSION['Closing_Costs'] + $_SESSION['deposit'])).'</b></td></tr>'.
       '<tr><td colspan="2"><i>**Does not include adjustments between buyer and seller at closing</i></td></tr>';
   

 //Directs to Monthly Payment Page and Checks for Email 
  if (isset($_POST['CalculateMP'])|| isset($_POST['EmailQuote'])){

//Code to Sent HUD and quote
    if(isset($_POST['EmailQuote'])){
      $_SESSION['HPCEmail']="Yes";
      //#Implement
     output_fdf($path.'HUD.pdf',$data,'y');
     //#Implement
    //Create a new PHPMailer instance
	$mail = new PHPMailer();
	// Set PHPMailer to use the sendmail transport
	$mail->isSendmail();
	//Set who the message is to be sent from
	$mail->setFrom($client_email);
	//Set an alternative reply-to address
	//$mail->addReplyTo('replyto@example.com', 'First Last');
	
        //Set who the message is to be sent to
        $mail->addAddress($_SESSION['Username']);
	
        //Set the subject line
	$mail->Subject = 'Home Purchase Calculations: '.$_SESSION['state'].' $'.$_SESSION['purchase_price'];
	
 
	$mail->Body = $_SESSION['EmailBody'];
	
        $mail->AltBody = 'Your GFE results are attached.';
	$string = file_get_contents('HUD.pdf');
	$mail->AddStringAttachment($string, 'HUD1.pdf', $encoding = 'base64', $type = 'application/pdf');
        
        if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
	} 
    } // End Email Quote Code
  
  header("Location:AC_monthly.php");
  
  }
  
  //else go to HUD Generation
else{
    


// Code to go to interactive HUD for newer browsers, straight HUD download for others
if(preg_match('/(?i)msie [7-8]/',$_SERVER['HTTP_USER_AGENT'])==1)
{
    // #Implement
    $pdf_file_url = $GLOBALS['path'].'HUD1.pdf';
	//$xfdf = createXFDF( $pdf_file_url, $data );
	
	//header('Content-type: application/vnd.fdf');
	output_fdf($pdf_file_url, $data);
}

else
{
echo "<meta http-equiv='refresh' content='0;URL=HUD.php'/>";
}

}// End HUD Generation


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
	$command = "/usr/bin/pdftk $pdf_file fill_form - output HUD.pdf"; 
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
}//End output FDF
 
function PrettyPrint($number){
    if(isset($number) && $number>=0){    return "$".number_format($number);}
    else {return;}
}//End PrettyPrint()

function SessionClear($name){
    for($i=0;$i<437;$i++){
        $_SESSION[$name][$i]="";
       }
}//end SessionClear()


?>