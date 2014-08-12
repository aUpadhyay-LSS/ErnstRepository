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

error_reporting(E_ALL ^ E_NOTICE);


//Variables from HTML Form  
if(isset( $_POST['state'])){ $state  =  $_POST['state'];}else{$state ="";}
if(isset($_POST['county'])){ $county  = $_POST['county'];}else{$county ="";}
if(isset( $_POST['township'])){ $township  =  $_POST['township'];}else{$township ="";}
if(isset( $_POST['purpose'])){ $purchase  =  $_POST['purpose'];}else{$purchase ="";}
if(isset( $_POST['loanid'])){ $LoanID  =  $_POST['loanid'];}else{$LoanID ="";}
if(isset( $_POST['filename'])){ $FileName  =  $_POST['filename'];}else{$FileName ="";}
if(isset( $_POST['TitleOrderOnly'])){ $TitleOrderOnly  =  $_POST['TitleOrderOnly'];}else{$TitleOrderOnly ="";}
if(isset( $_POST['purchase_price'])){ $purchase_price  =  $_POST['purchase_price'];}else{$purchase_price =0;}
if(isset( $_POST['loan_amount'])){ $loan_amount  =  $_POST['loan_amount'];}else{$loan_amount =0;}
if(isset( $_POST['exdebt'])){ $ExDebt  =  $_POST['exdebt'];}else{$ExDebt =0;}
if(isset( $_POST['PrintHUD'])){ $PrintHUD  =  $_POST['PrintHUD'];}else{$PrintHUD ="";}
if(isset( $_POST['FirstTime'])){ $FirstTime  =  $_POST['FirstTime'];}else{$FirstTime ="";}
if(isset($_POST['ReissueRate'])){ $Reissue = $_POST['ReissueRate'];}else{$Reissue="";}

//Initialize fees
$GiveRates="Yes";

//Brings in existing session variables if using a history re-run
if(isset($_SESSION['Rerun'])){
$state = $_SESSION['state'] ;
$county = $_SESSION['county'] ;
$township = $_SESSION['township'] ;
$LoanType = $_SESSION['loantype'] ;
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
$_SESSION['purpose'] = $purchase;
$_SESSION['loanid'] = $LoanID;
$_SESSION['filename'] = $FileName;
$_SESSION['TitleOrderOnly'] = $TitleOrderOnly;
$_SESSION['purchase_price'] = $purchase_price;
$_SESSION['loan_amount'] = $loan_amount;
$_SESSION['exdebt'] = $ExDebt;
$_SESSION['PrintHUD'] = $PrintHUD;
$_SESSION['FirstTime'] = $FirstTime;
$_SESSION['ReissueRate'] = $Reissue;
$_SESSION['Old_URL'] = "GFE";


//Allows re-issue rates to stay as is when printing out the HUD
if(isset($_POST['CalculateRate'])){$_SESSION['ReIssue']=0;}
else if($PrintHUD=="" && $Reissue==""){$_SESSION['ReIssue']=0;}

if ($Reissue<>"" || ($_SESSION['ReIssue']==1 && $PrintHUD<>"")){$_SESSION['ReIssue']=1;}
else{$_SESSION['ReIssue']=0;}

//ReIssue Rate message
if ($Reissue<>"" && $purchase==1){echo "<script>alert('Reissue rates are only applicable for Refinances.');</script>";}

if($TitleOrderOnly<>""){$TitleOnly=1;}
else{$TitleOnly=0;}

if(is_null($_SESSION['Username'])){$_SESSION['Username']="Mobile";}

if($state<>"" && $state<>"NA"){
//INSERT into history table


//if($purchase==0){$LoanType="Refinance";}
//else{$LoanType="Purchase";}
//
//$HistoryInsert = "INSERT INTO `Search_History`(`SearchType`, `Username`,`SearchCount`,`State`, `County`, `Township`, `LoanType`, `LoanID`, `FileName`, `TitleOrderOnly`, `SalesPrice`, `LoanAmount`, `ExDebt`, `FirstTime`, `ReRun`, `ReIssue`)
//VALUES ('COMM','".$_SESSION['Username']."',".$SearchCount.",'".$state."', '".$county."', '".$township."', '".$LoanType."', '".$LoanID."', '".$FileName."', '".$TitleOrderOnly."', ".$purchase_price.", ".$loan_amount.", ".$ExDebt.",'".$FirstTime."','".$ReRun."','".$Reissue."')";
//
//mysql_query($HistoryInsert);
}


//Querying LES_engine
//Setting posts

$_POST['search_type']= "COMM";
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
$LoanPol = $curl_results['loanpol'];
$Line1103 = $curl_results['line1103'];
$Endorsements = $curl_results['endorsements'];
$Line1203 = $curl_results['line1203'];
$Purpose = $curl_results['purpose'];
$MortgageTax = $curl_results['mortgagetax'];
$TransferTax = $curl_results['transfertax'];
$RecordationTax = $curl_results['recordationtax'];
$StateTax = $curl_results['statetax'];

$outputtext = "";

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

        $outputtext = $outputtext.$ReissueText."<br/><br/>";
        $outputtext = "In MD, transfer tax is typically split equally between buyer and seller unless otherwise agreed, if that is the case, buyer would be responsible for half of this amount. <br/><br/>";
        $outputtext = $outputtext."<table><tr><td colspan='2'><b>Tax Breakdown </b></td></tr>";
        $outputtext = $outputtext."<tr><td>City/County Tax:</td><td>".PrettyPrint($TransferTax)."</td></tr>";
        $outputtext = $outputtext."<tr><td>State Tax:</td><td>".PrettyPrint($StateTax)."</td></tr>";
        $outputtext = $outputtext."<tr><td>Recordation Tax:</td><td>".PrettyPrint($RecordationTax)."</td></tr>"; //local and state transfer taxes.
        $outputtext = $outputtext."<tr><td>Mortgage Tax:</td><td>".PrettyPrint($MortgageTax)."</td></tr></table>";
        break; //End MD

        case "ME":
      //  $outputtext = PrintLine1101_ME($state,$purpose,$ClosingFee,$AbstractFee,$NotaryFee,$LoanPol,$Endorsements,$TaxResearchFee,$CourierFee,$WireFee,$DischargeTracking,$RecordingProcessing,$Line1101,$purchase,$MiscStateFees);
         
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
       //  $outputtext = PrintLine1101_NJ($state,$purchase,$ClosingFee,$AbstractFee,$NotaryFee,$LoanPol,$Endorsements,$TaxResearchFee,$CourierFee,$WireFee,$DischargeTracking,$RecordingProcessing,$Line1101,$purchase,$MiscStateFees,$SettlementFee);
    
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
		 
        // $outputtext = PrintLine1101_PA($state,$purchase,$ClosingFee,$AbstractFee,$NotaryFee,$LoanPol,$Endorsements,$TaxResearchFee,$CourierFee,$WireFee,$DischargeTracking,$RecordingProcessing,$Line1101,$purchase,$TaxCert, $UtilSearch); 

         
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


//Resets output for clear values
if(isset($_POST['ClearValue'])){$GiveRates = "Please select a state and enter applicable purchase and loan amounts";}

//Citizens Bank Purchase Exception
if (strpos($_SESSION['Username'],'citizensbank') !== false && $purchase==1 && $state=="RI")
{
$ClosingFee = 525;
$AbstractFee = 0;
$Endorsements=0;
$NotaryFee = 0;
$TaxResearchFee=0;
$CourierFee = 0;
$WireFee = 0;
$DeedFee = 0;
$MortgageRecording = 0;
$RecordingProcessing = 0;
$DischargeTracking = 0;
$MiscStateFees = 0;
$DischargeMortgage = 0;
$SettlementFee = 0;
$SimIssue = 0;

$Line1101 = $ClosingFee + $LoanPol;
$outputtext = PrintLine1101($state,$LoanType,$ClosingFee,$AbstractFee,$NotaryFee,$LoanPol,$Endorsements,$TaxResearchFee,$CourierFee,$WireFee,$DischargeTracking,$RecordingProcessing,$Line1101,$purchase);

}



// Saving Session variables 
$_SESSION['LoanPol']=$LoanPol;
$_SESSION['Line1103']=$Line1103;
$_SESSION['Line1203']=$Line1203;

//TEST OUTPUTS
  
        
		
		
//HTML Output

echo "<!DOCTYPE html>";
echo "<html><head><style>";
echo "body { background: #efeee9; }";
echo "html, body { font-family: 'Lucida Grande',arial; font-size: 12px; }";
echo "p {text-indent: 50;}";
echo "</style></head>";
echo "<body>";

if($GiveRates=="Yes"){

if(isset($_POST['EmailQuote'])){$EmailSent="<p style='color:red;font-weight:bold;'>Email Sent to ".$_SESSION['Username']."</p>";}
else{$EmailSent= null;}

if($TitleOnly==1 && $state=="NJ"){
$headertext = "<p style=color:red;>This quote is for title related charges only. There is no lender representation quoted below.
If you need fees for additional closing services, please close this box and click on either purchase or refinance listed above.</p><br/>";
}
else {$headertext="";}


//$headertext=$headertext."<table STYLE=margin-left:15px>";
//$headertext=$headertext."<tr><td>HUD Line 1101: Title Services and Lender's Title Insurance (from GFE #4)</td>";
//$headertext=$headertext.'<td><input type="text" name="line1101" value="'.PrettyPrint($Line1101).'" size=10 style="background-color:transparent;font-weight:bold;border: none;"></td></tr>';
//$headertext=$headertext."<tr><td>HUD Line 1103: Owner's Title Insurance (from GFE #5)</td>";
//$headertext=$headertext.'<td><input type="text" name="line1103" value="'.PrettyPrint($Line1103).'" size=10 style="background-color:transparent;font-weight:bold;border: none;"></td></tr>';
//$headertext=$headertext.'<tr><td> HUD Line 1201: Government Recording Charges (From GFE #7)</td>';
//$headertext=$headertext.'<td> <input type="text" name="line1201" value="'.PrettyPrint($Line1201).'" size=10 readonly="readonly" style="background-color:transparent;font-weight:bold;border: none;"></td></tr>';
//$headertext=$headertext.'<tr><td> HUD Line 1203: Transfer Taxes (From GFE #8)</td><td> <input type="text" name="line1203" value="'.PrettyPrint($Line1203).'" size=10 readonly="readonly" style="background-color:transparent;font-weight:bold;border: none;"></td></tr>';   
//$headertext=$headertext.'<tr><td>HUD Line 1301: Required Services That You Can Shop For</td><td> <input type="text" name="line1301" value="'.PrettyPrint($Line1301).'" size=10 readonly="readonly" style="background-color:transparent;font-weight:bold;border: none;"> </td></tr>';
//$headertext=$headertext."</table></form>";

//echo $EmailSent.$headertext."<p>".$outputtext."</p><br/>";

$headertext=$headertext."<table STYLE=margin-left:15px>";
$headertext=$headertext."<tr><td>Lender's Title Insurance Premium</td>";
$headertext=$headertext.'<td><input type="text" name="LoanPol" value="'.PrettyPrint($LoanPol).'" size=10 style="background-color:transparent;font-weight:bold;border: none;"></td></tr>';
$headertext=$headertext."<tr><td>Owner's Title Insurance  Premium</td>";
$headertext=$headertext.'<td><input type="text" name="line1103" value="'.PrettyPrint($Line1103).'" size=10 style="background-color:transparent;font-weight:bold;border: none;"></td></tr>';
$headertext=$headertext.'<tr><td> Title Search/Review Fee</td>';
$headertext=$headertext.'<td> <input type="text" name="endorsements" value="'.PrettyPrint($Endorsements).'" size=10 readonly="readonly" style="background-color:transparent;font-weight:bold;border: none;"></td></tr>';
$headertext=$headertext.'<tr><td>Mortgage Tax</td><td> <input type="text" name="line1203" value="'.PrettyPrint($Line1203).'" size=10 readonly="readonly" style="background-color:transparent;font-weight:bold;border: none;"></td></tr>';   
//$headertext=$headertext.'<tr><td>HUD Line 1301: Required Services That You Can Shop For</td><td> <input type="text" name="line1301" value="'.PrettyPrint($Line1301).'" size=10 readonly="readonly" style="background-color:transparent;font-weight:bold;border: none;"> </td></tr>';
$headertext=$headertext."</table></form>";

if($state=="NY"){
    $headertext="<table STYLE=margin-left:15px>";
    $headertext=$headertext."<tr><td>Lender's Title Insurance Premium</td>";
    $headertext=$headertext.'<td><input type="text" name="LoanPol" value="'.PrettyPrint($LoanPol).'" size=10 style="background-color:transparent;font-weight:bold;border: none;"></td></tr>';
    $headertext=$headertext."<tr><td>Owner's Title Insurance  Premium</td>";
    $headertext=$headertext.'<td><input type="text" name="line1103" value="'.PrettyPrint($Line1103).'" size=10 style="background-color:transparent;font-weight:bold;border: none;"></td></tr>';
    $headertext=$headertext.'<tr><td> Municipal Searches</td>';
    $headertext=$headertext.'<td> <input type="text" name="endorsements" value="'.PrettyPrint($Endorsements).'" size=10 readonly="readonly" style="background-color:transparent;font-weight:bold;border: none;"></td></tr>';
    $headertext=$headertext.'<tr><td>Mortgage Tax</td><td> <input type="text" name="line1203" value="'.PrettyPrint($Line1203).'" size=10 readonly="readonly" style="background-color:transparent;font-weight:bold;border: none;"></td></tr>';   
//$headertext=$headertext.'<tr><td>HUD Line 1301: Required Services That You Can Shop For</td><td> <input type="text" name="line1301" value="'.PrettyPrint($Line1301).'" size=10 readonly="readonly" style="background-color:transparent;font-weight:bold;border: none;"> </td></tr>';
$headertext=$headertext."</table></form>";
}

echo $EmailSent.$headertext."<br/>Quote does not include negotiated title endorsement or exceptions";

echo "<br/>".$outputtext;


//test output


//echo "<br/><a href='http://lssoftwaresolutions.com/' target='_blank'><img src='http://www.lssoftwaresolutions.com/ResTitle/Images/PoweredByLodestar.jpg' width='120' height='69'></a>";
}
else{
echo $GiveRates;
}
       
echo "</body></html>";


//Code to Email Quote
if(isset($_POST['EmailQuote'])) {
    //No PDF attachment
    //output_fdf('http://lssoftwaresolutions.com/ResTitle/HUD.pdf',$data,'y');
    
  
$emailheader= "<b>Ready to Order Title for this quote? <a href='http://res-title.com/titleform.php'>Click here</a></b><br/><br/>";
$emailheader=$emailheader."<tr><td>File Name: </td>";
$emailheader=$emailheader.'<td><input type="text" name="filename" value="'.$FileName.'" size=10 style="background-color:transparent;border: none;"></td>';
$emailheader=$emailheader."<td>Loan ID:</td>";
$emailheader=$emailheader.'<td><input type="text" name="loanID" value="'.$LoanID.'" size=10 style="background-color:transparent;border: none;"></td></tr>';
$emailheader=$emailheader."<tr><td>State:</td>";
$emailheader=$emailheader.'<td><input type="text" name="state" value="'.$state.'" size=10 style="background-color:transparent;border: none;"></td>';
$emailheader=$emailheader."<td>Loan Type:</td>";
$emailheader=$emailheader.'<td><input type="text" name="loantype" value="'.$LoanType.'" size=10 style="background-color:transparent;border: none;"></td></tr>';
$emailheader=$emailheader."<tr><td>County:</td>";
$emailheader=$emailheader.'<td><input type="text" name="state" value="'.$county.'" size=10 style="background-color:transparent;border: none;"></td>';
$emailheader=$emailheader."<td>Township:</td>";
$emailheader=$emailheader.'<td><input type="text" name="loantype" value="'.$township.'" size=10 style="background-color:transparent;border: none;"></td></tr>';
$emailheader=$emailheader."<tr><td>Purchase Price:</td>";
$emailheader=$emailheader.'<td><input type="text" name="state" value="'.PrettyPrint($purchase_price).'" size=10 style="background-color:transparent;border: none;"></td>';
$emailheader=$emailheader."<td>Loan Amount:</td>";
$emailheader=$emailheader.'<td><input type="text" name="loantype" value="'.PrettyPrint($loan_amount).'" size=10 style="background-color:transparent;border: none;"></td></tr>';
$emailheader=$emailheader."</table><br/><br/>";
    
    //Create a new PHPMailer instance
    
    // #Implement
    
	$mail = new PHPMailer();
	// Set PHPMailer to use the sendmail transport
	$mail->isSendmail();
	//Set who the message is to be sent from
	$mail->setFrom('nationaldesk@res-title.com');
	//Set an alternative reply-to address
	//$mail->addReplyTo('replyto@example.com', 'First Last');
	
        //Set who the message is to be sent to
        $mail->addAddress($_SESSION['Username']);
	
        //Set the subject line
        if($purchase==1){
	$mail->Subject = 'RES/Title GFE Calculations : '.$_SESSION['state'].' Purchase $'.$_SESSION['purchase_price'];
        }
        else{
        $mail->Subject = 'RES/Title GFE Calculations : '.$_SESSION['state'].' Refinance $'.$_SESSION['loan_amount'];
        }
        
        $_SESSION['EmailBody'] = $emailheader.$headertext."<p>".$outputtext."</p><br/><p> Res/Title National Desk <br/>Your Closing Connection in All 50 States".
        "<br/>866-737-8485 p<br/>866-651-9742 f<br/>www.res-title.com<br/>nationaldesk@res-title.com</p>";
	
        
	$mail->Body = $_SESSION['EmailBody'];
        
        $mail->AltBody = 'Your Res/Title created GFE results are attached.';
	// $string = file_get_contents('HUD.pdf');
	// $mail->AddStringAttachment($string, 'HUD.pdf', $encoding = 'base64', $type = 'application/pdf');
        
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

    //Email Sending code for mobile and web "Email HUD" button    
        
	if ($stat['exitcode']===0) {
    //Create a new PHPMailer instance
	$mail = new PHPMailer();
	// Set PHPMailer to use the sendmail transport
	$mail->isSendmail();
	//Set who the message is to be sent from
	$mail->setFrom('nationaldesk@res-title.com');
	//Set an alternative reply-to address
	//$mail->addReplyTo('replyto@example.com', 'First Last');
	
        //Set who the message is to be sent to
	 $mail->addAddress($_POST['emailTo']);
	
        //Set the subject line
	$mail->Subject = 'RES-Title GFE Calculations';
	
	$mail->Body = "GFE Quote is attached".
        "<img src='Images/PoweredByLodestar.jpg' width='120' height='69'></a>";
	
        $mail->AltBody = 'Your Res-Title.com created GFE results are attached.';
	$string = file_get_contents('HUD.pdf');
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

      
function PrettyPrint($number){
    if(isset($number) && $number>0){    return "$".number_format($number);}
    else {return "$0";}
}//End PrettyPrint()

?>