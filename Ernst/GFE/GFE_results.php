<?php
//require '../PHPMailerAutoload.php';


header('P3P: CP="CAO PSA OUR"');
session_start();
ob_flush();

//#Implement
//Database connection
//$username="jimboind_demo";
//$password="Test123";
//$database="jimboind_Demo";

//include ('les_config.php');
include('les_config.php');

$con = mysql_connect('localhost',$username,$password);
@mysql_select_db($database) or die( "Unable to select database ". mysql_error());

//
//$result = mysql_query("SELECT path,Closing_Fee_text,Abstract_Fee_text,Notary_Fee_text,Lenders_Policy_text,
//                        Endorsements_text,Tax_Research_Fee_text,Courier_Fee_text,Wire_Fee_text,Discharge_Tracking_text,
//                        Recording_Processing_text,Tax_Certifications_text,Utility_Searches_text,Misc_State_Fees_text,Settlement_Fee_text,
//                        Closing_Fee_display,Abstract_Fee_display,Notary_Fee_display,Lenders_Policy_display,Endorsements_display,Tax_Research_Fee_display,
//                        Courier_Fee_display,Wire_Fee_display,Discharge_Tracking_display,Recording_Processing_display,Tax_Certifications_display,Utility_Searches_display,Misc_State_Fees_display,Settlement_Fee_display,client_phone
//                        FROM client_configuration
//                        where client_id ='8'");
//$values = mysql_fetch_row($result,MYSQL_BOTH);
//
//echo "Closing_Fee_text = ".$values['Closing_Fee_text']."</br>";
//echo "Abstract_Fee_text = ".$values['Abstract_Fee_text']."</br>";
//echo "Notary_Fee_text = ".$values['Notary_Fee_text']."</br>";
//echo "Lenders_Policy_text = ".$values['Closing_Fee_text']."</br>";
//echo "Endorsements_text = ".$values['Endorsements_text']."</br>";
//echo "Tax_Research_Fee_text = ".$values['Tax_Research_Fee_text']."</br>";
//echo "Courier_Fee_text = ".$values['Courier_Fee_text']."</br>";
//echo "Wire_Fee_text = ".$values['Wire_Fee_text']."</br>";
//echo "Discharge_Tracking_text = ".$values['Discharge_Tracking_text']."</br>";
//echo "Recording_Processing_text = ".$values['Recording_Processing_text']."</br>";
//echo "Tax_Certifications_text = ".$values['Tax_Certifications_text']."</br>";
//echo "Utility_Searches_text = ".$values['Utility_Searches_text']."</br>";
//echo "Misc_State_Fees_text = ".$values['Misc_State_Fees_text']."</br>";
//echo "Settlement_Fee_text = ".$values['Settlement_Fee_text']."</br>";
//echo "Closing_Fee_display = ".$values['Closing_Fee_display']."</br>";
//echo "Abstract_Fee_display = ".$values['Abstract_Fee_display']."</br>";
//echo "Notary_Fee_display = ".$values['Notary_Fee_display']."</br>";
//echo "Lenders_Policy_display = ".$values['Lenders_Policy_display']."</br>";
//echo "Endorsements_display = ".$values['Endorsements_display']."</br>";
//echo "Tax_Research_Fee_display = ".$values['Tax_Research_Fee_display']."</br>";
//echo "Courier_Fee_display = ".$values['Courier_Fee_display']."</br>";
//echo "Wire_Fee_display = ".$values['Wire_Fee_display']."</br>";
//echo "Discharge_Tracking_display = ".$values['Discharge_Tracking_display']."</br>";
//echo "Recording_Processing_display = ".$values['Recording_Processing_display']."</br>";
//echo "Tax_Certifications_display = ".$values['Tax_Certifications_display']."</br>";
//echo "Utility_Searches_display = ".$values['Utility_Searches_display']."</br>";
//echo "Misc_State_Fees_display = ".$values['Misc_State_Fees_display']."</br>";
//echo "Settlement_Fee_display = ".$values['Settlement_Fee_display']."</br>";
//echo "client_phone = ".$values['client_phone']."</br>";

//mysql_close($con);

//Variables from HTML Form  
if(isset( $_POST['state'])){ $state  =  $_POST['state'];}else{$state ="";}
if(isset($_POST['county'])){ $county  = $_POST['county'];}else{$county ="";}
if(isset( $_POST['township'])){ $township  =  $_POST['township'];}else{$township ="";}
if(isset( $_POST['purpose'])){ $purpose  =  $_POST['purpose'];}else{$purpose ="";}
if(isset( $_POST['loanid'])){ $LoanID  =  $_POST['loanid'];}else{$LoanID ="";}
if(isset( $_POST['filename'])){ $FileName  =  $_POST['filename'];}else{$FileName ="";}
if(isset( $_POST['TitleOrderOnly'])){ $TitleOrderOnly  =  $_POST['TitleOrderOnly'];}else{$TitleOrderOnly ="";}
if(isset( $_POST['purchase_price'])){ $purchase_price  =  $_POST['purchase_price'];}else{$purchase_price =0;}
if(isset( $_POST['loan_amount'])){ $loan_amount  =  $_POST['loan_amount'];}else{$loan_amount =0;}
if(isset( $_POST['exdebt'])){ $ExDebt  =  $_POST['exdebt'];}else{$ExDebt =0;}
if(isset( $_POST['PrintHUD'])){ $PrintHUD  =  $_POST['PrintHUD'];}else{$PrintHUD ="";}
if(isset( $_POST['FirstTime'])){ $FirstTime  =  $_POST['FirstTime'];}else{$FirstTime ="";}
if(isset($_POST['ReissueRate'])){ $Reissue = $_POST['ReissueRate'];}else{$Reissue="";}
if(isset( $_POST['PrincipleResidence'])){ $PrincipleResidence =1;}else{$PrincipleResidence =0;}



//Brings in existing session variables if using a history re-run
if(isset($_SESSION['Rerun'])){
$state = $_SESSION['state'] ;
$county = $_SESSION['county'] ;
$township = $_SESSION['township'] ;
$purpose = $_SESSION['purpose'] ;
$LoanID = $_SESSION['loanid'] ;
$FileName = $_SESSION['filename'] ;
$TitleOrderOnly = $_SESSION['TitleOrderOnly'] ;
$purchase_price = $_SESSION['purchase_price'] ;
$loan_amount = $_SESSION['loan_amount'] ;
$ExDebt = $_SESSION['exdebt'] ;
$PrintHUD = $_SESSION['PrintHUD'] ;
$FirstTime = $_SESSION['FirstTime'] ;
$Reissue = $_SESSION['ReissueRate'] ;
$_SESSION['Rerun']=null;
$ReRun="Yes";

$_POST['state'] = $state;
$_POST['county']= $county;
$_POST['township'] = $township;
$_POST['purpose'] = $purpose;
$_POST['loanid'] = $LoanID;
$_POST['filename'] = $FileName;
$_POST['TitleOrderOnly'] = $TitleOrderOnly;
$_POST['purchase_price'] = $purchase_price;
$_POST['loan_amount'] = $loan_amount;
$_POST['exdebt'] = $ExDebt;
$_POST['PrintHUD'] = $PrintHUD;
$_POST['FirstTime'] = $FirstTime; 
$_POST['ReissueRate'] = $Reissue;
$_POST['PrincipleResidence'] = $PrincipleResidence;

}
else{$ReRun="No";}
//Saving SESSION variables

$_SESSION['state'] = $state;
$_SESSION['county'] = $county;
$_SESSION['township'] = $township;
$_SESSION['purpose'] = $purpose;
$_SESSION['loanid'] = $LoanID;
$_SESSION['filename'] = $FileName;
$_SESSION['TitleOrderOnly'] = $TitleOrderOnly;
$_SESSION['purchase_price'] = $purchase_price;
$_SESSION['purchase_price'] = $purchase_price;
$_SESSION['loan_amount'] = $loan_amount;
$_SESSION['exdebt'] = $ExDebt;
$_SESSION['PrintHUD'] = $PrintHUD;
$_SESSION['FirstTime'] = $FirstTime;
$_SESSION['ReissueRate'] = $Reissue;
$_SESSION['Old_URL'] = "GFE";

$purchase= $purpose;

//Allows re-issue rates to stay as is when printing out the HUD
/*if(isset($_POST['CalculateRate'])){$_SESSION['ReIssue']=0;}
else if($PrintHUD=="" && $Reissue==""){$_SESSION['ReIssue']=0;}

if ($Reissue<>"" || ($_SESSION['ReIssue']==1 && $PrintHUD<>"")){$_SESSION['ReIssue']=1;}
else{$_SESSION['ReIssue']=0;}

//ReIssue Rate message
if ($Reissue<>"" && $purchase==1){echo "<script>alert('Reissue rates are only applicable for Refinances.');</script>";}


*/
if(is_null($_SESSION['Username'])){$_SESSION['Username']="Mobile";}



//Additional $_POST variables 
$_POST['search_type'] = 'GFE';
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

//SELECT query for State fees
//Lines 1101 and 1201 population
/*
$query = "SELECT * FROM HPC_GFE_Rates WHERE (HPC_GFE_Rates.State =  '".$state."')";

$row = mysql_fetch_array(mysql_query($query)); // Takes in array of HPC Rates
*/

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
$SettlementFee = $curl_results['settlementfee'];
$SimIssue= $curl_results['simissue'];
$OwnersPol= $curl_results['ownerspol'];
$LoanPol = $curl_results['loanpol'];
$Line1101 = $curl_results['line1101'];
$Line1103 = $curl_results['line1103'];
$Line1201 = $curl_results['line1201'];
$Line1203 = $curl_results['line1203'];
$Line1301 = $curl_results['line1301'];
$TitleOrderOnly = $curl_results['TitleOrderOnly'];
$purchase = $curl_results['purpose'];
$MortgageTax = $curl_results['mortgagetax'];
$TransferTax = $curl_results['transfertax'];
$RecordationTax = $curl_results['recordationtax'];
$StateTax = $curl_results['statetax'];
$TaxCert = $curl_results['TaxCert'];
$UtilSearch = $curl_results['UtilSearch'];               

//Updates for Mobile
$state = $curl_results['state'];   
$county = $curl_results['county'];   
$township =  $curl_results['town'];   
                
// Output for all states
$outputtext = PrintLine1101($state,$purchase,$ClosingFee,$AbstractFee,$NotaryFee,$LoanPol,$Endorsements,$TaxResearchFee,$CourierFee,$WireFee,$DischargeTracking,$RecordingProcessing,$Line1101,$purchase);


//Other Fees to Initialize
$MansionTax=0;
$GiveRates="Yes";
$Reissue=null;

if(isset($TitleOrderOnly)){$TitleOnly=1;}
else{$TitleOnly=0;}


switch($state){
        //Placeholder only, No rates yet
        //case "AK":
        //break;
        
        //In progress
        case "AL":
     
        break;
        
        //Placeholder only, No rates yet
        //case "AR":
        //break;
        
        //Placeholder only, No rates yet
        //case "AZ":
        //break;
        
        //Placeholder only, No rates yet
        //case "CA":
        //break;
        
        //In progress
        
        case "CO":
        
        break;
        
        case "CT":
        
        //#Implement
        
        $outputtext = $outputtext."<br/><br/>**Please note that recording fees include 1 mortgage and 1 discharge.  Please add an additional $159 for each additional discharge and/or subordination that needs to be recorded in this transaction.**";
        
        if(!empty($_SESSION['ReissueRate']) && $purchase==0){
            $outputtext = $outputtext."<br/><br/>For Connecticut...If refinanced within 10 years the lender policy is reduced to $".round($LoanPol);
        }
        
        //CT Complete 
        break;

        case "DC":
        //Placeholder only, all DC calculations done on LES engine
        break;

        case "DE":

         if(!empty($_SESSION['ReissueRate']) && $purchase==0){
            $outputtext = $outputtext."<br/><br/>For Delaware...If refinanced within 5 years the lender policy is reduced to $".round($LoanPol);
        }
        
        //DE pending questions 6/21    
        break;

        case "FL":
        
        if($purchase==1){
        $outputtext = $outputtext."<br/>Line 1301 fee of $".$Line1301." reflects the survey and plot fee in FL";
        $outputtext = $outputtext."<br/>Deed Stamps (paid by seller): $".round(.007*$purchase_price);
        $outputtext = $outputtext."<br/><br/>PLEASE NOTE, THAT IF A SIMULTANEOUS LOAN AND OWNER POLICY IS PURCHASED AT THE TIME OF CLOSING, THE LENDER PREMIUM WILL BE A FLAT FEE OF $400.";
        }
        //End FL    
        break;

        case "GA":
         //Placeholder only, all GA calculations done on LES engine
        break;

        //Placeholder only, No rates yet
        //case "HI":
        //break;        
        
        //Placeholder only, No rates yet
        //case "IA":
        //break;
        
        //Placeholder only, No rates yet
        //case "ID":
        //break;
        
        case "IL":
          //Placeholder only, all IL calculations done on LES engine
        break;

        case "IN":
            $outputtext = $outputtext."<br/>$35 Tax Fee Represents the CPL Fee for Indiana";
            
            if(!empty($_SESSION['ReissueRate']) && $purchase==0){
           $outputtext = $outputtext."<br/><br/>For Indiana...If refinanced within 10 years the lender policy is reduced to $".round($LoanPol);
           }
        break;

        //In PRogress
        case "KS":
        
        break;
        
        case "KY":
                      
           if(!empty($_SESSION['ReissueRate'])  && $purchase==0){
            $outputtext = $outputtext."<br/><br/>For Kentucky...If refinanced within 5 years the lender policy is reduced to $".round($LoanPol);
            }
           
        break;

        //In PRogress
        case "LA":
        
        break;

        
        case "MA":
        $outputtext = $outputtext."<br/>";
        if($Line1203 > 0){$outputtext = $outputtext."<br/>Line 1203 reflects the Land Bank Fee";}
       
        if($Line1301 > 0){$outputtext = $outputtext."<br/>Line 1301 fee reflects the survey and plot fee in MA";}
        
        if(!empty($_SESSION['ReissueRate']) && $purchase==0){
           $outputtext = $outputtext."<br/><br/>For Massachusetts...If refinanced within 10 years the lender policy is reduced to $".round($LoanPol);
           }

        break;

        case "MD":

        if(!empty($_SESSION['ReissueRate'])  && $purchase==0){$ReissueText="<br/><br/>Discount refinance rates are automatically taken into account for Maryland";}
        else if(!empty($_SESSION['ReissueRate'])  && $purchase==1){
          $ReissueText="<br/><br/>For Maryland purchase reissue rates please contact "; 
        }
        else {$ReissueText="";}

        $outputtext = "In MD, transfer tax is typically split equally between buyer and seller unless otherwise agreed, if that is the case, buyer would be responsible for half of this amount. <br/><br/>";
        $outputtext = $outputtext.PrintLine1101($state,$purchase,$ClosingFee,$AbstractFee,$NotaryFee,$LoanPol,$Endorsements,$TaxResearchFee,$CourierFee,$WireFee,$DischargeTracking,$RecordingProcessing,$Line1101,$purchase);
        $outputtext = $outputtext."<br>The above transfer tax is subject to change if borrower is NOT a first time home buyer, or if property is non-owner occupied.  Therefore, please contact prior to disclosing the GFE to ensure accurate fees.";
        $outputtext = $outputtext.$ReissueText."<br/><br/>";
        $outputtext = $outputtext."<table><tr><td colspan='2'><b>Tax Breakdown </b></td></tr>";
        $outputtext = $outputtext."<tr><td>City/County Tax:</td><td>".PrettyPrint($TransferTax)."</td></tr>";
        $outputtext = $outputtext."<tr><td>State Tax:</td><td>".PrettyPrint($StateTax)."</td></tr>";
        $outputtext = $outputtext."<tr><td>Recordation Tax:</td><td>".PrettyPrint($RecordationTax)."</td></tr>"; //local and state transfer taxes.
        $outputtext = $outputtext."<tr><td>Mortgage Tax:</td><td>".PrettyPrint($MortgageTax)."</td></tr></table>";
        break; //End MD

        case "ME":
        $outputtext = PrintLine1101_ME($state,$purpose,$ClosingFee,$AbstractFee,$NotaryFee,$LoanPol,$Endorsements,$TaxResearchFee,$CourierFee,$WireFee,$DischargeTracking,$RecordingProcessing,$Line1101,$purchase,$MiscStateFees);
         
            if(!empty($_SESSION['ReissueRate']) && $purchase==0){
            $outputtext = $outputtext."<br/><br/>For Maine...If refinanced within 2 years the lender policy is reduced to $".$LoanPol;
            
            } // End ME
        break;

        case "MI":
          if(!empty($_SESSION['ReissueRate']) && $purchase==0){
          $outputtext = $outputtext."<br/><br/>For Michigan...If refinanced within 2 years the lender policy is reduced to $".round($LoanPol);
          }
        break;

        case "MN":
        //Placeholder. no MN exceptions  
        break;

        //In Progress
        case "MO":
        break;
        
        //In Progress
        case "MS":
        break;
        
        //In PRogress
        case "MT":
        break;
        
        case "NC":
          if(!empty($_SESSION['ReissueRate']) && $purchase==0){
          $outputtext = $outputtext."<br/><br/>Please call for a reissue quote as more detailed information is required";
          }
          
        break;

        //In progress
        case "ND":
        break;
 
        //In progress
        case "NE":
        break;
    
        case "NH":
          
          if(!empty($_SESSION['ReissueRate']) && $purchase==0){
          $outputtext = $outputtext."<br/><br/>For New Hampshire...If refinanced within 3 years the lender policy is reduced to $".round($LoanPol);
          }

        break;

        case "NJ":
         $outputtext = PrintLine1101_NJ($state,$purchase,$ClosingFee,$AbstractFee,$NotaryFee,$LoanPol,$Endorsements,$TaxResearchFee,$CourierFee,$WireFee,$DischargeTracking,$RecordingProcessing,$Line1101,$purchase,$MiscStateFees,$SettlementFee);
    
         if(!empty($_SESSION['ReissueRate']) && $purchase==0){
          $outputtext = $outputtext."<br/><br/>NJ reduced rates (f/k/a reissue rates) are a combination of standard rate (new debt) and refi rate (old debt).  Please fill in both the loan amount and existing debt fields to obtain an accurate rate.";   
         }
        break;

        //Need Rates
     //   case "NM":
    //    break;
    
        //Need Rates
    //    case "NV":
      //  break;

        case "NY":
		
          $Line1101 = 0;
          $Line1103 = 0;
          $Line1201 = 0;
          $Line1203 = 0;
          $Line1301 = 0;
        //Redirects to New York Calculator

        $outputtext = "For NY Rates please refer to the New York specific Calculator";
        
        break;// End New York

        case "OH":
          if(!empty($_SESSION['ReissueRate']) && $purchase==0)
          {
          $outputtext = $outputtext."<br/><br/>For Ohio...If refinanced within 2 years the lender policy is reduced to $".round($LoanPol);
          }
        break;

        //Need rates
        //case "OK":
        //break;
        
        //Need rates
        //case "OR":
        //break;
        
        case "PA":
		 
         $outputtext = PrintLine1101_PA($state,$purchase,$ClosingFee,$AbstractFee,$NotaryFee,$LoanPol,$Endorsements,$TaxResearchFee,$CourierFee,$WireFee,$DischargeTracking,$RecordingProcessing,$Line1101,$purchase,$TaxCert, $UtilSearch); 

         
         if(!empty($_SESSION['ReissueRate']) && $purchase==0)
         {
            $outputtext = $outputtext."<br/><br/>As of July 2012, reissue rates do not apply in the state of Pennsylvania.  There are only Purchase and Refinance rates.";
         }
         
        break;

        case "RI":
         
         if(!empty($_SESSION['ReissueRate']) && $purchase==0){
            $outputtext = $outputtext."<br/><br/>For Rhode Island...If refinanced within 10 years the lender policy is reduced to $".$LoanPol;
            }

        break;

        case "SC":
         //placeholder only
        break;

       //Rates Needed
    //    case "SD":
    //    break;
    
        case "TN":
          if(!empty($_SESSION['ReissueRate']) && $purchase==0){
          $outputtext = $outputtext."<br/><br/>For Tennessee...If refinanced within 2 years the lender policy is reduced to $".round($LoanPol);
          }
        break;

    //Rates Needed
    //    case "TX":
    //    break;
    
       //Rates Needed
    //    case "UT":
    //    break;    
    
        case "VA":
          if(!empty($_SESSION['ReissueRate']) && $purchase==0)
          {
          $outputtext = $outputtext."<br/><br/>For Virginia...If refinanced within 10 years the lender policy is reduced to $".round($LoanPol);
          }
        break;

        case "VT":
         if(!empty($_SESSION['ReissueRate']) && $purchase==0)
          {
          $outputtext = $outputtext."<br/><br/>For Vermont...If refinanced within 10 years the lender policy is reduced to $".round($LoanPol);
          }

        break;

    //Rates Needed
    //    case "WA":
    //    break;
    
        case "WI":

         if($_SESSION['ReIssue']==1  && $purchase==0){
         $outputtext = $outputtext."<br/><br/>For Wisconsin...If refinanced within 10 years the lender policy is reduced to $".round($LoanPol);
         }
        break;

    //In progress
        case "WV":
        break;
    
    //Rates Needed
    //    case "WY":
    //    break;
    
        case "":
        case "NA":
        $GiveRates = "Please select a state and enter applicable purchase and loan amounts";
        break;

    default:
    
    // #Implement
    $GiveRates= "For rates regarding ".$state." please contact your sales representative.";
  
}//End State Switch
$outputtext = $outputtext.$Reissue;
//Resets output for clear values

if(isset($_POST['ClearValue'])){$GiveRates = "Please select a state and enter applicable purchase and loan amounts";}



// Saving Session variables 
$_SESSION['Line1101']=$Line1101;
$_SESSION['Line1103']=$Line1103;
$_SESSION['Line1201']=$Line1201;
$_SESSION['Line1203']=$Line1203;
$_SESSION['Line1301']=$Line1301;

//TEST OUTPUTS

    if($purchase==1){$Line0101 = $purchase_price;
        $Line0302 = PrettyPrint(($loan_amount));
	$Line0303 = PrettyPrint(round($Line0101 + $Line1101 + $Line1103 + $Line1201 + $Line1203 + $Line1301 -$loan_amount));
         }
        else {$Line0101="";
        $Line0302 ="";
        $Line0303 ="";}
        
        
        
        
  //HUD Output
 	$data = array (
        'Text427' => $LoanID,
        'Text429' => $FileName,
       // #Implement
        'Text433' => "TITLE AGENT",
        'Text437' => PrettyPrint($Line0101),
        'Text439' => PrettyPrint($Line1101 + $Line1103 + $Line1201 + $Line1203 + $Line1301),
        'Text440' => "Mortgage Payoff",
        'Text442' => "Mortgage Payoff",
        'Text462' => PrettyPrint($Line1101 + $Line1103 + $Line1201 + $Line1203 + $Line1301),
        'Text465' => PrettyPrint($loan_amount),
        'Text503' => PrettyPrint($loan_amount),
        'Text505' => PrettyPrint($Line0101 + $Line1101 + $Line1103 + $Line1201 + $Line1203 + $Line1301),
        'Text506' => $Line0302,
	'Text509' => $Line0303,
	'Text677' => PrettyPrint($Line1101),
        'Text680' => PrettyPrint($ClosingFee),
        'Text684' => PrettyPrint($Line1103),
        'Text687' => PrettyPrint($LoanPol),
	'Text714' => PrettyPrint($Line1201),
        'Text716' => PrettyPrint($DeedFee),        
        'Text722' => PrettyPrint($Line1203),       
        'Text735' => PrettyPrint($Line1301),
        'Text751' => PrettyPrint($Line1101 + $Line1103 + $Line1201 + $Line1203 + $Line1301),
        'Text760' => PrettyPrint($Line1203),
        'Text762' => PrettyPrint($Line1201),
        'Text814' => PrettyPrint($loan_amount));   
	

        if ($PrintHUD<>"" ){
        $insert = "INSERT INTO `HUD_Generation`(`State`,`SearchType`, `Username`) VALUES ('".$state."','GFE','".$_SESSION['Username']."')";
        mysql_query($insert);
        
            //For interactive HUD, re-directs to HUD form
        SessionClear("row");
        
        $_SESSION['row'][12]=$Line0101;
        $_SESSION['row'][16]=($Line1101 + $Line1103 + $Line1201 + $Line1203 + $Line1301);
        $_SESSION['row'][58]=($Line1101 + $Line1103 + $Line1201 + $Line1203 + $Line1301);
        $_SESSION['row'][64]=$loan_amount;
        $_SESSION['row'][138]=$loan_amount;
        $_SESSION['row'][142]=($Line1101 + $Line1103 + $Line1201 + $Line1203 + $Line1301);
 	$_SESSION['row'][251]=$Line1101;
        $_SESSION['row'][254]=$ClosingFee;
        $_SESSION['row'][258]=$Line1103;
        $_SESSION['row'][261]=$LoanPol;
	$_SESSION['row'][288]=$Line1201;
        $_SESSION['row'][290]=$DeedFee;        
        $_SESSION['row'][296]=$Line1203;       
        $_SESSION['row'][312]=$Line1301;
        $_SESSION['row'][328]=($Line1101 + $Line1103 + $Line1201 + $Line1203 + $Line1301);
        $_SESSION['row'][337]=$Line1203;
        $_SESSION['row'][339]=$Line1201;
        $_SESSION['row'][391]=$loan_amount; 
    
   // $_SESSION['preview'] = 'y';
   // echo "<meta http-equiv='refresh' content='0;URL=http://www.lssoftwaresolutions.com/ResTitle/HUD.php'/>";
    echo "<script type='text/javascript'>window.open('HUD.php');</script>";
	}
		
		
//HTML Output

echo "<!DOCTYPE html>";
echo "<html><head><style>";
echo "body { background: #efeee9; }";
echo "html, body { font-family: 'Lucida Grande',arial; font-size: 12px; }";
echo "p {text-indent: 50;}";
echo "</style>";


echo "</head><body>";
if($GiveRates=="Yes"){

if(isset($_POST['EmailQuote'])){$EmailSent="<p style='color:red;font-weight:bold;'>Email Sent to ".$_SESSION['Username']."</p>";}
else{$EmailSent= null;}

if($TitleOnly==1 && $state=="NJ"){
$headertext = "<p style=color:red;>This quote is for title related charges only. There is no lender representation quoted below.
If you need fees for additional closing services, please close this box and click on either purchase or refinance listed above.</p><br/>";
}
else {$headertext="";}

$headertext=$headertext."<table STYLE=margin-left:15px>";
$headertext=$headertext."<tr><td>HUD Line 1101: Title Services and Lender's Title Insurance (from GFE #4)</td>";
$headertext=$headertext.'<td><input type="text" name="line1101" value="'.PrettyPrint($Line1101).'" size=10 style="background-color:transparent;font-weight:bold;border: none;"></td></tr>';
$headertext=$headertext."<tr><td>HUD Line 1103: Owner's Title Insurance (from GFE #5)</td>";
$headertext=$headertext.'<td><input type="text" name="line1103" value="'.PrettyPrint($Line1103).'" size=10 style="background-color:transparent;font-weight:bold;border: none;"></td></tr>';
$headertext=$headertext.'<tr><td> HUD Line 1201: Government Recording Charges (From GFE #7)</td>';
$headertext=$headertext.'<td> <input type="text" name="line1201" value="'.PrettyPrint($Line1201).'" size=10 readonly="readonly" style="background-color:transparent;font-weight:bold;border: none;"></td></tr>';
$headertext=$headertext.'<tr><td> HUD Line 1203: Transfer Taxes (From GFE #8)</td><td> <input type="text" name="line1203" value="'.PrettyPrint($Line1203).'" size=10 readonly="readonly" style="background-color:transparent;font-weight:bold;border: none;"></td></tr>';   
$headertext=$headertext.'<tr><td>HUD Line 1301: Required Services That You Can Shop For</td><td> <input type="text" name="line1301" value="'.PrettyPrint($Line1301).'" size=10 readonly="readonly" style="background-color:transparent;font-weight:bold;border: none;"> </td></tr>';
$headertext=$headertext."</table></form>";


$emailheader= "<table STYLE=margin-left:15px><tr><td>File Name: </td>";
$emailheader=$emailheader.'<td><input type="text" name="filename" value="'.$FileName.'" size=10 style="background-color:transparent;border: none;"></td>';
$emailheader=$emailheader."<td>Loan ID:</td>";
$emailheader=$emailheader.'<td><input type="text" name="loanID" value="'.$LoanID.'" size=10 style="background-color:transparent;border: none;"></td></tr>';
$emailheader=$emailheader."<tr><td>State:</td>";
$emailheader=$emailheader.'<td><input type="text" name="state" value="'.$state.'" size=10 style="background-color:transparent;border: none;"></td>';
$emailheader=$emailheader."<td>Loan Type:</td>";
$emailheader=$emailheader.'<td><input type="text" name="purpose" value="';

if($purpose==1){$emailheader=$emailheader."Purchase";}
       else {$emailheader=$emailheader."Refinance";}

$emailheader=$emailheader.'" size=10 style="background-color:transparent;border: none;"></td></tr>';
$emailheader=$emailheader."<tr><td>County:</td>";
$emailheader=$emailheader.'<td><input type="text" name="state" value="'.$county.'" size=10 style="background-color:transparent;border: none;"></td>';
$emailheader=$emailheader."<td>Township:</td>";
$emailheader=$emailheader.'<td><input type="text" name="purpose" value="'.$township.'" size=10 style="background-color:transparent;border: none;"></td></tr>';
$emailheader=$emailheader."<tr><td>Purchase Price:</td>";
$emailheader=$emailheader.'<td><input type="text" name="state" value="'.PrettyPrint($purchase_price).'" size=10 style="background-color:transparent;border: none;"></td>';
$emailheader=$emailheader."<td>Loan Amount:</td>";
$emailheader=$emailheader.'<td><input type="text" name="purpose" value="'.PrettyPrint($loan_amount).'" size=10 style="background-color:transparent;border: none;"></td></tr>';
$emailheader=$emailheader."</table><br/><br/>";
   
     $_SESSION['EmailBody'] = $emailheader.$headertext."<p>".$outputtext."</p><br/><p><br/>Your Closing Connection in All 50 States";
//Test Output

//echo "County: ".$curl_results['county']."<br/>";



//Real Output
echo $EmailSent.$headertext."<p>".$outputtext."</p><br/>";

//echo "<br/><a href='http://lssoftwaresolutions.com/' target='_blank'><img src='http://www.lssoftwaresolutions.com/ResTitle/Images/PoweredByLodestar.jpg' width='120' height='69'></a>";

//Test output
if(isset($_POST['PrintQuote']))
{
        echo "<script type='text/javascript'>window.open('PrintQuote.php');</script>";
}

}
else{
echo $GiveRates;
}
       
echo "</body></html>";


//Code to Email Quote
if(isset($_POST['EmailQuote'])) {
    //No PDF attachment
    //output_fdf('http://lssoftwaresolutions.com/ResTitle/HUD1.pdf',$data,'y');
    
  

     
    //Create a new PHPMailer instance
    
    // #Implement
    
	$mail = new PHPMailer();
	// Set PHPMailer to use the sendmail transport
	$mail->isSendmail();
	//Set who the message is to be sent from
	$mail->setFrom($client_email);
	//Set an alternative reply-to address
	//$mail->addReplyToreplyto@example.com', 'First Last');
	
        //Set who the message is to be sent to

        if(isset($_POST['emailTo'])){
        //for mobile users
        $mail->addAddress($_POST['emailTo']);
	      }
        else{
          //non-mobile users
          $mail->addAddress($_SESSION['Username']);
        }
        //Attach Mobile Title Order Form
        if(isset($_POST['RequestTitle']))
        {
          $string = file_get_contents('attachedfiles/order-form-general.pdf');
          $mail->AddStringAttachment($string, 'order-fom.pdf', $encoding = 'base64', $type = 'application/pdf');
        }
	

        //Set the subject line
        if($purchase==1){
	$mail->Subject = ' GFE Calculations : '.$_SESSION['state'].' Purchase $'.$_SESSION['purchase_price'];
        }
        else{
        $mail->Subject = 'GFE Calculations : '.$_SESSION['state'].' Refinance $'.$_SESSION['loan_amount'];
        }
        
      
	
        
	$mail->Body = $_SESSION['EmailBody'];
        
        $mail->AltBody = 'Your created GFE results are attached.';
	// $string = file_get_contents('HUD1.pdf');
	// $mail->AddStringAttachment($string, 'HUD1.pdf', $encoding = 'base64', $type = 'application/pdf');
        
        if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
	} 
    } // End Email Quote Code

//End Calculator Code - functions below



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

    //Email Sending code for mobile and web "Email HUD" button    
        
	if ($stat['exitcode']===0) {
    //Create a new PHPMailer instance
	$mail = new PHPMailer();
	// Set PHPMailer to use the sendmail transport
	$mail->isSendmail();
	//Set who the message is to be sent from
        //#Implement
	$mail->setFrom($client_email);
	//Set an alternative reply-to address
	//$mail->addReplyTo('replyto@example.com', 'First Last');
	
        //Set who the message is to be sent to
	 $mail->addAddress($_POST['emailTo']);
	
        //Set the subject line
	$mail->Subject = 'GFE Calculations';
	
	$mail->Body = "GFE Quote is attached".
        "<img src='Images/PoweredByLodestar.jpg' width='120' height='69'></a>";
	
        $mail->AltBody = 'Your created GFE results are attached.';
	$string = file_get_contents('HUD1.pdf');
	$mail->AddStringAttachment($string, 'HUD1.pdf', $encoding = 'base64', $type = 'application/pdf');
        
        if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
        
	}
	
	
	} // End PHP Mailer
	// cleanup
foreach ($pipes as $pipe) {
   fclose($pipe);
}
proc_close($prochandle);
	
	}
}// End output fdf

//#Implement
//Add Client contact information on bottom line for each state
       function PrintLine1101($state,$purpose,$ClosingFee,$AbstractFee,$NotaryFee,$LoanPol,$Endorsements,$TaxResearchFee,$CourierFee,$WireFee,$DischargeTracking,$RecordingProcessing,$Line1101,$purchase){
        global $values;
        
       $ptext = "<table><td colspan='2' border='1'><tr><b>".$state." ";
       
       if($purpose==1){$ptext = $ptext."Purchase";}
       else {$ptext = $ptext."Refinance";}
       
       $ptext = $ptext." GFE Box 4 Totals: ".PrettyPrint($Line1101)."</b></td></tr>";
              if($GLOBALS['Closing_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Closing_Fee_text'].": </td><td>".PrettyPrint($ClosingFee)."</td></tr>";
       }
       
       if($GLOBALS['Abstract_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Abstract_Fee_text'].": </td><td>".PrettyPrint($AbstractFee)."</td></tr>";
       }
        if($GLOBALS['Notary_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Notary_Fee_text'].": </td><td>".PrettyPrint($NotaryFee)."</td></tr>";
       }
        if($GLOBALS['Lenders_Policy_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Lenders_Policy_text'].": </td><td>".PrettyPrint($LoanPol)."</td></tr>";
       }
        if($GLOBALS['Endorsements_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Endorsements_text'].": </td><td>".PrettyPrint($Endorsements)."</td></tr>";
       }
        if($GLOBALS['Tax_Research_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Tax_Research_Fee_text'].": </td><td>".PrettyPrint($TaxResearchFee)."</td></tr>";
       }
        if($GLOBALS['Courier_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Courier_Fee_text'].": </td><td>".PrettyPrint($CourierFee)."</td></tr>";
       }
        if($GLOBALS['Wire_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Wire_Fee_text'].": </td><td>".PrettyPrint($WireFee)."</td></tr>";
       }
        if($GLOBALS['Discharge_Tracking_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Discharge_Tracking_text'].": </td><td>".PrettyPrint($DischargeTracking)."</td></tr>";
       }
        if($GLOBALS['Recording_Processing_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Recording_Processing_text']." :</td><td>".PrettyPrint($RecordingProcessing)."</td></tr>";
       }
       $ptext = $ptext."<tr><td>Line 1101 Total (Excluding Lender's Policy): </td><td>".PrettyPrint(round($Line1101-$LoanPol))."</td></tr></table>";
       
         $ptext = $ptext."<br/>For questions please contact ".$GLOBALS['client_name']." at <a href='".$GLOBALS['client_email']."'>".$GLOBALS['client_email']."</a> or ".$GLOBALS['client_phone']."</br>";
       
       
       return $ptext;
       }

    function PrintLine1101_ME($state,$purpose,$ClosingFee,$AbstractFee,$NotaryFee,$LoanPol,$Endorsements,$TaxResearchFee,$CourierFee,$WireFee,$DischargeTracking,$RecordingProcessing,$Line1101,$purchase,$MiscStateFees){
       
       $ptext = "<table><td colspan='2' border='1'><tr><b>".$state." ";
       
       if($purpose==1){$ptext = $ptext."Purchase";}
       else {$ptext = $ptext."Refinance";}
        $ptext = $ptext." GFE Box 4 Totals: ".PrettyPrint($Line1101)."</b></td></tr>";
       if($GLOBALS['Closing_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Closing_Fee_text'].": </td><td>".PrettyPrint($ClosingFee)."</td></tr>";
       }
       
       if($GLOBALS['Abstract_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Abstract_Fee_text'].": </td><td>".PrettyPrint($AbstractFee)."</td></tr>";
       }
        if($GLOBALS['Notary_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Notary_Fee_text'].": </td><td>".PrettyPrint($NotaryFee)."</td></tr>";
       }
        if($GLOBALS['Lenders_Policy_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Lenders_Policy_text'].": </td><td>".PrettyPrint($LoanPol)."</td></tr>";
       }
        if($GLOBALS['Endorsements_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Endorsements_text'].": </td><td>".PrettyPrint($Endorsements)."</td></tr>";
       }
        if($GLOBALS['Tax_Research_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Tax_Research_Fee_text'].": </td><td>".PrettyPrint($TaxResearchFee)."</td></tr>";
       }
        if($GLOBALS['Courier_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Courier_Fee_text'].": </td><td>".PrettyPrint($CourierFee)."</td></tr>";
       }
        if($GLOBALS['Wire_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Wire_Fee_text'].": </td><td>".PrettyPrint($WireFee)."</td></tr>";
       }
       if($GLOBALS['Misc_State_Fees_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Misc_State_Fees_text']." :</td><td>".PrettyPrint($MiscStateFees)."</td></tr>";
       }
       if($GLOBALS['Discharge_Tracking_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Discharge_Tracking_text'].": </td><td>".PrettyPrint($DischargeTracking)."</td></tr>";
       }
       if($GLOBALS['Recording_Processing_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Recording_Processing_text']." :</td><td>".PrettyPrint($RecordingProcessing)."</td></tr>";
       }
       
       $ptext = $ptext."<tr><td>Line 1101 Total (Excluding Lender's Policy): </td><td>".PrettyPrint(round($Line1101-$LoanPol))."</td></tr></table>";
         $ptext = $ptext."<br/>For questions please contact ".$GLOBALS['client_name']." at <a href='".$GLOBALS['client_email']."'>".$GLOBALS['client_email']."</a> or ".$GLOBALS['client_phone']."</br>";
       
       
       return $ptext;
       //
       //$ptext = "<table><td colspan='2' border='1'><tr><b>".$state." ".$purpose." GFE Box 4 Totals:</b></td></tr><tr><td>".$GLOBALS['Closing_Fee_text'].": </td><td>".PrettyPrint($ClosingFee)."</td></tr><tr><td>".$GLOBALS['Abstract_Fee_text'].": </td><td>";
       //$ptext = $ptext.PrettyPrint($AbstractFee)."</td></tr><tr><td>".$GLOBALS['Notary_Fee_text']."</td><td>".PrettyPrint($NotaryFee)."</td></tr><tr><td>".$GLOBALS['Lenders_Policy_text']."</td><td>".PrettyPrint($LoanPol);
       //$ptext = $ptext."</td></tr><tr><td>".$GLOBALS['Endorsements_text'].": </td><td>".PrettyPrint($Endorsements)."</td></tr><tr><td>".$GLOBALS['Tax_Research_Fee_text'].": </td><td>".PrettyPrint($TaxResearchFee)."</td></tr><tr><td>".$GLOBALS['Courier_Fee_text'].": </td><td>".PrettyPrint($CourierFee);
       //$ptext = $ptext."</td></tr><tr><td>".$GLOBALS['Wire_Fee_text']."</td><td>".PrettyPrint($WireFee)."</td></tr><tr><td>".$GLOBALS['Misc_State_Fees_text']."</td><td>".PrettyPrint($MiscStateFees);
       //$ptext = $ptext."</td></tr><tr><td>".$GLOBALS['Discharge_Tracking_text'].": </td><td>".PrettyPrint($DischargeTracking)."</td></tr><tr><td>".$GLOBALS['Recording_Processing_text'].": </td><td>".PrettyPrint($RecordingProcessing);
       //$ptext = $ptext."</td></tr><tr><td>Line 1101 Total (Excluding Lender's Policy): </td><td>".PrettyPrint(round($Line1101-$LoanPol))."</td></tr></table>";
       //$ptext = $ptext."<br/>For questions please contact : ";
       //$ptext = $ptext.$GLOBALS['client_phone'];
       //return $ptext;
       }   
       
    function PrintLine1101_NJ($state,$purpose,$ClosingFee,$AbstractFee,$NotaryFee,$LoanPol,$Endorsements,$TaxResearchFee,$CourierFee,$WireFee,$DischargeTracking,$RecordingProcessing,$Line1101,$purchase,$MiscStateFees,$SettlementFee){
       
       $ptext = "<table><td colspan='2' border='1'><tr><b>".$state." ";
       
       if($purpose==1){$ptext = $ptext."Purchase";}
       else {$ptext = $ptext."Refinance";}
        $ptext = $ptext." GFE Box 4 Totals: ".PrettyPrint($Line1101)."</b></td></tr>";
         if($GLOBALS['Closing_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Closing_Fee_text'].": </td><td>".PrettyPrint($ClosingFee)."</td></tr>";
       }
       
       if($GLOBALS['Abstract_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Abstract_Fee_text'].": </td><td>".PrettyPrint($AbstractFee)."</td></tr>";
       }
        if($GLOBALS['Notary_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Notary_Fee_text'].": </td><td>".PrettyPrint($NotaryFee)."</td></tr>";
       }
        if($GLOBALS['Lenders_Policy_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Lenders_Policy_text'].": </td><td>".PrettyPrint($LoanPol)."</td></tr>";
       }
        if($GLOBALS['Endorsements_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Endorsements_text'].": </td><td>".PrettyPrint($Endorsements)."</td></tr>";
       }
        if($GLOBALS['Tax_Research_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Tax_Research_Fee_text'].": </td><td>".PrettyPrint($TaxResearchFee)."</td></tr>";
       }
        if($GLOBALS['Courier_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Courier_Fee_text'].": </td><td>".PrettyPrint($CourierFee)."</td></tr>";
       }
        if($GLOBALS['Wire_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Wire_Fee_text'].": </td><td>".PrettyPrint($WireFee)."</td></tr>";
       }
        if($GLOBALS['Discharge_Tracking_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Discharge_Tracking_text'].": </td><td>".PrettyPrint($DischargeTracking)."</td></tr>";
       }
        if($GLOBALS['Recording_Processing_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Recording_Processing_text']." :</td><td>".PrettyPrint($RecordingProcessing)."</td></tr>";
       }
       
        if($GLOBALS['Misc_State_Fees_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Misc_State_Fees_text']." :</td><td>".PrettyPrint($MiscStateFees)."</td></tr>";
       }
       
       if($GLOBALS['Settlement_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Settlement_Fee_text']." :</td><td>".PrettyPrint($SettlementFee)."</td></tr>";
       }
       $ptext = $ptext."<tr><td>Line 1101 Total (Excluding Lender's Policy): </td><td>".PrettyPrint(round($Line1101-$LoanPol))."</td></tr></table>";
        
      $ptext = $ptext."<br/>For questions please contact ".$GLOBALS['client_name']." at <a href='".$GLOBALS['client_email']."'>".$GLOBALS['client_email']."</a> or ".$GLOBALS['client_phone']."</br>";
       
       
       return $ptext;
       //$ptext = "<table><td colspan='2' border='1'><tr><b>".$state." ".$purpose." GFE Box 4 Totals:</b></td></tr><tr><td>".$GLOBALS['Closing_Fee_text'].": </td><td>".PrettyPrint($ClosingFee)."</td></tr><tr><td>".$GLOBALS['Abstract_Fee_text'].": </td><td>";
       //$ptext = $ptext.PrettyPrint($AbstractFee)."</td></tr><tr><td>".$GLOBALS['Notary_Fee_text'].":</td><td>".PrettyPrint($NotaryFee)."</td></tr><tr><td>".$GLOBALS['Lenders_Policy_text']."</td><td>".PrettyPrint($LoanPol);
       //$ptext = $ptext."</td></tr><tr><td>".$GLOBALS['Endorsements_text'].":</td><td>".PrettyPrint($Endorsements)."</td></tr><tr><td>".$GLOBALS['Tax_Research_Fee_text'].":</td><td>".PrettyPrint($TaxResearchFee)."</td></tr><tr><td>".$GLOBALS['Courier_Fee_text'].": </td><td>".PrettyPrint($CourierFee);
       //$ptext = $ptext."</td></tr><tr><td>".$GLOBALS['Wire_Fee_text'].": </td><td>".PrettyPrint($WireFee)."</td></tr><tr><td>".$GLOBALS['Discharge_Tracking_text'].": </td><td>".PrettyPrint($DischargeTracking)."</td></tr><tr><td>".$GLOBALS['Recording_Processing_text'].": </td><td>".PrettyPrint($RecordingProcessing);
       //$ptext = $ptext."</td></tr><tr><td>".$GLOBALS['Misc_State_Fees_text'].": </td><td>".PrettyPrint($MiscStateFees)."</td></tr><tr><td>".$GLOBALS['Settlement_Fee_text'].": </td><td>".PrettyPrint($SettlementFee);
       //$ptext = $ptext."</td></tr><tr><td>Line 1101 Total (Excluding Lender's Policy): </td><td>".PrettyPrint(round($Line1101-$LoanPol))."</td></tr></table>";
       //$ptext = $ptext."<br/>For questions please contact : ";
       //$ptext = $ptext.$GLOBALS['client_phone'];
       //return $ptext;
       }       
 
    function PrintLine1101_PA($state,$purpose,$ClosingFee,$AbstractFee,$NotaryFee,$LoanPol,$Endorsements,$TaxResearchFee,$CourierFee,$WireFee,$DischargeTracking,$RecordingProcessing,$Line1101,$purchase,$TaxCert, $UtilSearch){
       
       $ptext = "<table><td colspan='2' border='1'><tr><b>".$state." ";
       
       if($purpose==1){$ptext = $ptext."Purchase";}
       else {$ptext = $ptext."Refinance";}
       
        $ptext = $ptext." GFE Box 4 Totals: ".PrettyPrint($Line1101)."</b></td></tr>";
       
         if($GLOBALS['Closing_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Closing_Fee_text'].": </td><td>".PrettyPrint($ClosingFee)."</td></tr>";
       }
       
       if($GLOBALS['Abstract_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Abstract_Fee_text'].": </td><td>".PrettyPrint($AbstractFee)."</td></tr>";
       }
        if($GLOBALS['Notary_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Notary_Fee_text'].": </td><td>".PrettyPrint($NotaryFee)."</td></tr>";
       }
        if($GLOBALS['Lenders_Policy_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Lenders_Policy_text'].": </td><td>".PrettyPrint($LoanPol)."</td></tr>";
       }
        if($GLOBALS['Endorsements_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Endorsements_text'].": </td><td>".PrettyPrint($Endorsements)."</td></tr>";
       }
        if($GLOBALS['Tax_Research_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Tax_Research_Fee_text'].": </td><td>".PrettyPrint($TaxResearchFee)."</td></tr>";
       }
        if($GLOBALS['Courier_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Courier_Fee_text'].": </td><td>".PrettyPrint($CourierFee)."</td></tr>";
       }
        if($GLOBALS['Wire_Fee_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Wire_Fee_text'].": </td><td>".PrettyPrint($WireFee)."</td></tr>";
       }
        if($GLOBALS['Discharge_Tracking_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Discharge_Tracking_text'].": </td><td>".PrettyPrint($DischargeTracking)."</td></tr>";
       }
        if($GLOBALS['Recording_Processing_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Recording_Processing_text']." :</td><td>".PrettyPrint($RecordingProcessing)."</td></tr>";
       }
        if($GLOBALS['Tax_Certifications_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Tax_Certifications_text']." :</td><td>".PrettyPrint($TaxCertText)."</td></tr>";
       }
       if($GLOBALS['Utility_Searches_display']==1)
       {
       $ptext = $ptext."<tr><td>".$GLOBALS['Utility_Searches_text']." :</td><td>".PrettyPrint($UtilSearch)."</td></tr>";
       }
       $ptext = $ptext."<tr><td>Line 1101 Total (Excluding Lender's Policy): </td><td>".PrettyPrint(round($Line1101-$LoanPol))."</td></tr></table>";
       
       $ptext = $ptext."<br/>For questions please contact ".$GLOBALS['client_name']." at <a href='".$GLOBALS['client_email']."'>".$GLOBALS['client_email']."</a> or ".$GLOBALS['client_phone']."</br>";
       
       
       return $ptext;
    
       //$ptext = "<table><td colspan='2' border='1'><tr><b>".$state." ".$purpose." GFE Box 4 Totals:</b></td></tr><tr><td>".$GLOBALS['Closing_Fee_text'].": </td><td>".PrettyPrint($ClosingFee)."</td></tr><tr><td>".$GLOBALS['Abstract_Fee_text'].": </td><td>";
       //$ptext = $ptext.PrettyPrint($AbstractFee)."</td></tr><tr><td>".$GLOBALS['Notary_Fee_text'].":</td><td>".PrettyPrint($NotaryFee)."</td></tr><tr><td>".$GLOBALS['Lenders_Policy_text'].":</td><td>".PrettyPrint($LoanPol);
       //$ptext = $ptext."</td></tr><tr><td>".$GLOBALS['Endorsements_text']."</td><td>".PrettyPrint($Endorsements)."</td></tr><tr><td>".$GLOBALS['Tax_Research_Fee_text'].":</td><td>".PrettyPrint($TaxResearchFee)."</td></tr><tr><td>".$GLOBALS['Courier_Fee_text'].": </td><td>".PrettyPrint($CourierFee);
       //$ptext = $ptext."</td></tr><tr><td>".$GLOBALS['Wire_Fee_text'].": </td><td>".PrettyPrint($WireFee)."</td></tr><tr><td>".$GLOBALS['Discharge_Tracking_text'].": </td><td>".PrettyPrint($DischargeTracking)."</td></tr><tr><td>".$GLOBALS['Recording_Processing_text'].": </td><td>".PrettyPrint($RecordingProcessing);
       //$ptext = $ptext."</td></tr><tr><td>".$GLOBALS['TaxCertText'].": </td><td>".PrettyPrint($TaxCert)."</td></tr><tr><td>".$GLOBALS['Utility_Searches_text'].": </td><td>".PrettyPrint($UtilSearch);
       //$ptext = $ptext."</td></tr><tr><td>Line 1101 Total (Excluding Lender's Policy): </td><td>".PrettyPrint(round($Line1101-$LoanPol))."</td></tr></table>";
       //$ptext = $ptext."<br/>For questions please contact : ";
       //$ptext = $ptext.$GLOBALS['client_phone'];
       //return $ptext;
       }
      
function PrettyPrint($number){
    if(isset($number) && $number>0){    return "$".number_format($number);}
    else {return "$0";}
}//End PrettyPrint()

function SessionClear($name){
    for($i=0;$i<437;$i++){
        $_SESSION[$name][$i]="";
       }
}//end SessionClear()
?>