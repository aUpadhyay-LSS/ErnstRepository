<?php
header('P3P: CP="CAO PSA OUR"');
session_start();
ob_flush();

//Database connection
//$username="jimboind_demo";
//$password="Test123";
//$database="jimboind_Demo";

include ('les_config.php');

$db = mysql_connect('localhost',$username,$password);
@mysql_select_db($database) or die( "Unable to select database ". mysql_error());

error_reporting(E_ALL);

echo "<html><head><link rel='stylesheet' href='css/bootstrap.css' type='text/css' /></head><body style='background: #efeee9;'>";

$_SESSION['Rerun']= $_POST['ReRunGFE'];

switch($_SESSION['searchtype']){
    case "GFE":

$query="SELECT `State`, `County`, `Township`, `LoanType`, `LoanID`, `FileName`, `TitleOrderOnly`, `SalesPrice`, `LoanAmount`,"
."`ExDebt`, `FirstTime` FROM `Search_History` WHERE `Index`=".$_SESSION['Rerun'];

$row = mysql_fetch_array(mysql_query($query));

$_SESSION['state'] = $row[0];
$_SESSION['county'] = $row[1];
$_SESSION['township'] = $row[2];
$_SESSION['purpose'] = $row[3];
$_SESSION['loanid'] = $row[4];
$_SESSION['filename'] = $row[5];
$_SESSION['TitleOrderOnly'] = $row[6];
$_SESSION['purchaseprice'] = $row[7];
$_SESSION['loanamount'] = $row[8];
$_SESSION['exdebt'] = $row[9];
$_SESSION['FirstTime'] = $row[10];

echo "<h1>Your quote is in progress</h1><br/>";
//print_r($_SESSION);

echo "<meta http-equiv='refresh' content='1;URL=GFE_main.php'/></body></html>";

break;//End GFE

case "AC":
    $query="SELECT `State`,`County`, `Township`, `SalesPrice`, `Deposit`,`LoanAmount`, `InterestRate`, `LoanTerm`, ".
    "`AnnTaxes`, `TaxesPaid`, `HomeOwners`, `Buyer`, `Address`, `SettlementDate` FROM Search_History WHERE `Index`=".$_SESSION['Rerun'];

    $row = mysql_fetch_array(mysql_query($query));

    //Saving session variables
    $_SESSION['state'] = $row[0];
    $_SESSION['county'] = $row[1];
    $_SESSION['township'] = $row[2];
    $_SESSION['salesprice'] = $row[3];
    $_SESSION['deposit'] = $row[4];
    $_SESSION['loanamount'] = $row[5];
    $_SESSION['InterestRate'] = $row[6];
    $_SESSION['LoanTerm'] = $row[7];
    $_SESSION['RealEstateTaxes'] = $row[8];
    $_SESSION['WhenPaid'] = $row[9];
    $_SESSION['insurance'] = $row[10];
    $_SESSION['buyer'] = $row[11];
    $_SESSION['address'] = $row[12];
    $_SESSION['SettlementDate'] = $row[13];

echo "<h1>Your quote is in progress</h1><br/>";

echo "<meta http-equiv='refresh' content='1;URL=AC_main.php'/></body></html>";

break; //End HPC

case "NY":


$query="SELECT `County`, `Township`, `SalesPrice`, `LoanAmount`,`InsuranceType`,`PropertyType`,`PriorInsurance`,`PrincipalBalance`".
        "FROM `Search_History` WHERE `Index`=".$_SESSION['Rerun'];

$row = mysql_fetch_array(mysql_query($query));

$_SESSION['county'] = $row[0];
$_SESSION['township'] = $row[1];
$_SESSION['purchaseprice'] = $row[2];
$_SESSION['loanamount'] = $row[3];
$_SESSION['InsuranceType'] = $row[4];
$_SESSION['PropertyType'] = $row[5];
$_SESSION['insurance'] = $row[6];
$_SESSION['Principalbalance'] = $row[7];

echo "<h1>Your quote is in progress</h1><br/>";
//print_r($_SESSION);

echo "<meta http-equiv='refresh' content='1;URL=CEMA_main.php'/></body></html>";

break;//End NY

case "COMM":

$query="SELECT `State`, `County`, `Township`, `LoanType`, `LoanID`, `FileName`, `TitleOrderOnly`, `SalesPrice`, `LoanAmount`,"
."`ExDebt`, `FirstTime` FROM `Search_History` WHERE `Index`=".$_SESSION['Rerun'];

$row = mysql_fetch_array(mysql_query($query));

$_SESSION['state'] = $row[0];
$_SESSION['county'] = $row[1];
$_SESSION['township'] = $row[2];
$_SESSION['purpose'] = $row[3];
$_SESSION['loanid'] = $row[4];
$_SESSION['filename'] = $row[5];
$_SESSION['TitleOrderOnly'] = $row[6];
$_SESSION['purchaseprice'] = $row[7];
$_SESSION['loanamount'] = $row[8];
$_SESSION['exdebt'] = $row[9];
$_SESSION['FirstTime'] = $row[10];

echo "<h1>Your quote is in progress</h1><br/>";
//print_r($_SESSION);

echo "<meta http-equiv='refresh' content='1;URL=COMM_main.php'/></body></html>";

break;//End Commercial

} //End Switch

?>