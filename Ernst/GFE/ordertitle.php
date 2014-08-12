<?php
header('P3P: CP="CAO PSA OUR"');
session_start();
ob_flush();

//query to take in profile information
// #Implement
//$username="jimboind_demo";
//$password="Test123";
//$database="jimboind_Demo";

include 'les_config.php';

$db = mysql_connect('localhost',$username,$password);
@mysql_select_db($database) or die( "Unable to select database ". mysql_error());

error_reporting(E_ALL);

$query="SELECT `RequestedBy`,`Phone`,`Fax`,`Email`,`Processor`,`ProcessorPhone`,`ProcessorFax`,`ProcessorEmail`,`LO_Name`,`LO_Phone`,`LO_Email`,`LO_Fax` FROM `TitleOrderProfile` WHERE Username='".$_SESSION['Username']."'";
$array=mysql_fetch_array(mysql_query($query));

?>
<html>

<head>



<title>Title Insurance Closing Packages Title Escrow Services</title>

<!--#Implement-->
<meta name="Description" content="Title Insurance Closing Packages which handles closings in Massachusetts, Rhode Island, Connecticut, and New Hampshire. Attorneys close in the Registry of Deeds, realtor's office and borrower's home.">
<meta name="Keywords" content="Title Insurance Packages ">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<?php
if(preg_match('/(?i)msie [7-8]/',$_SERVER['HTTP_USER_AGENT'])==1)
{
?>
<link rel="stylesheet" href="css/GFE_old.css" type="text/css" />
<style>li{float:left;display:inline;}</style>
<?php
}
else{
?>
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<?php
}
?>
<meta charset="utf-8" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<?php
if($_SESSION['state']){echo '<script>$("document").ready(function(){$("#state").val("'.$_SESSION['state'].'");})</script>';}
?>

<!-- <link rel="stylesheet" href="stylesheets/datepicker.css" />   -->
<script>$(function() {    $( "#datepicker" ).datepicker();  });

function FormCheck(){
  if(!document.TitleOrder.RequestedBy.value)
  {
    alert("Please fill out the Requested By field");
    return false;
  }
  if(!document.TitleOrder.Phone.value)
  {
    alert("Please fill out the Requestor Phone field");
    return false;
  }
  if(!document.TitleOrder.Email.value)
  {
    alert("Please fill out the Requestor Email field");
    return false;
  }
  if(!document.TitleOrder.Processor.value)
  {
    alert("Please fill out the Processor field");
    return false;
  }

  if(!document.TitleOrder.ProcessorPhone.value)
  {
    alert("Please fill out the Processor Phone field");
    return false;
  }
  if(!document.TitleOrder.ProcessorEmail.value)
  {
    alert("Please fill out the Processor Email field");
    return false;
  }
  if(!document.TitleOrder.LoanOfficer.value)
  {
    alert("Please fill out the Loan Officer field");
    return false;
  }

  if(!document.TitleOrder.LoanOfficerPhone.value)
  {
    alert("Please fill out the Loan Officer Phone field");
    return false;
  }
  if(!document.TitleOrder.LoanOfficerEmail.value)
  {
    alert("Please fill out the Loan Officer Email field");
    return false;
  }

    if(!document.TitleOrder.PropertyAddress.value)
  {
    alert("Please fill out the Property Address field");
    return false;
  }

  if(!document.TitleOrder.PropertyCityTown.value)
  {
    alert("Please fill out the Property City/Town field");
    return false;
  }
  if(document.TitleOrder.PropertyState.value=="NA")
  {
    alert("Please select a valid state");
    return false;
  }
  if(!document.TitleOrder.Borrower1LastName.value)
  {
    alert("Please fill out the Borrower Last name field");
    return false;
  }
  if(!document.TitleOrder.Borrower1FirstName.value)
  {
    alert("Please fill out the Borrower First name field");
    return false;
  }
  if(!document.TitleOrder.BorrowerWorkPhone.value)
  {
    alert("Please fill out the Borrower Work Phone field");
    return false;
  }
  if(!document.TitleOrder.LoanAmount.value)
  {
    alert("Please fill out the Loan Amount field");
    return false;
  }
  if(!document.TitleOrder.LoanIDNumber.value)
  {
    alert("Please fill out the Loan ID field");
    return false;
  }
  if(!document.TitleOrder.LenderNameMortgagee.value)
  {
    alert("Please fill out the Lender Name field");
    return false;
  }
  if(!document.TitleOrder.LenderAddress.value)
  {
    alert("Please fill out the Lender Address field");
    return false;
  }
  if(!document.TitleOrder.LenderPhone.value)
  {
    alert("Please fill out the Lender Phone field");
    return false;
  }
  if(!document.TitleOrder.Seller1LastName.value)
  {
    alert("Please fill out the Seller Last name field");
    return false;
  }
  if(!document.TitleOrder.Seller1FirstName.value)
  {
    alert("Please fill out the Seller First name field");
    return false;
  }
  if(!document.TitleOrder.Seller1Phone.value)
  {
    alert("Please fill out the Seller Phone field");
    return false;
  }


}// End Form Check

</script>
</head>

<body style="background: #efeee9; ">
    <!-- Online Area Navigation menu -->
    <div class="container">

  <?php
if(preg_match('/(?i)msie [7-8]/',$_SERVER['HTTP_USER_AGENT'])==1)
{
?>
<ul>
<!--<li><a href="GFE_main.php" class="navbutton">GFE</a></li>
<li><a href="AC_main.php" class="navbutton">Affordability</a></li>
<li><a href="COMM_main.php" class="navbutton">Commercial</a></li>
<li><a href="CEMA_main.php" class="navbutton">New York Calculator</a></li>-->
<?php if($gfe=="1"){?><li><a href="GFE_main.php">GFE</a></li><?php } ?>
<?php if($ac=="1"){?><li><a href="AC_main.php">Affordability</a></li><?php } ?>
<?php if($nyc=="1"){?><li><a href="CEMA_main.php">New York</a></li><?php } ?>
<?php if($ctic=="1"){?><li><a href="COMM_main.php">Commercial</a></li><?php } ?>
<li><a href="history.php" class="navbutton">Search History</a></li>
<li><a href="ordertitle.php" class="navbutton">Order Title</a></li>
<li><a href="myprofile.php" class="navbutton">My Profile</a></li>
<li><a href="logout.php" class="navbutton">Log Out</a></li>
</ul>
<?php
}
else{
?>

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
      <!--<li><a href="GFE_main.php">GFE</a></li>
      <li><a href="AC_main.php">Affordability</a></li>
      <li><a href="CEMA_main.php">New York</a></li>
      <li><a href="COMM_main.php">Commercial</a></li>-->
      <?php if($gfe=="1"){?><li><a href="GFE_main.php">GFE</a></li><?php } ?>
      <?php if($ac=="1"){?><li><a href="AC_main.php">Affordability</a></li><?php } ?>
      <?php if($nyc=="1"){?><li><a href="CEMA_main.php">New York</a></li><?php } ?>
      <?php if($ctic=="1"){?><li><a href="COMM_main.php">Commercial</a></li><?php } ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li class="active"><a href="ordertitle.php">Order Title</a></li>
      <li><a href="myprofile.php">My Profile</a></li>
      <li><a href="history.php">My Searches</a></li>
      <li><a href="logout.php">Log Out</a></li>
    </ul>
  </div><!-- /.navbar-collapse -->

</nav>

<?php
}
?>

    </div>

    <div class='middle'>
    <div class='container'>
        <p STYLE= margin-left:15px;font-family:arial;color:grey;font-size:30px;">Title Order Form</p>


                  <h1></h1>
                  <p class="textmain">Complete the form below and then press the
                    &quot;Submit&quot; button at the bottom. Text areas marked
                    in <font color="red">red</font> are <font color="red">required
                    fields</font>.</p><br />

<!-- Begin  Form -->
<form enctype="multipart/form-data" name="TitleOrder" method="post" action="titleorder_email.php" accept-charset="UTF-8" onsubmit="return FormCheck()">

                    <table width="575" align="center" cellpadding="0" cellspacing="3">
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred"><font color="red">Name/Requested
                            By:</font></div></td>
                        <td colspan="2"><input name="RequestedBy" type="text" class="textforms"  size="23" value="<?= $array[0] ?>"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred"><font color="red">Phone:</font></div></td>
                        <td width="186"><input name="Phone" type="text" class="textforms"  size="23" value="<?= $array[1] ?>"></td>
                        <td width="213" class="textformb"><span class="textformbred">Fax:</span>
                          <input name="Fax" type="text" class="textforms"  size="15" value="<?= $array[2] ?>"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right"><font color="red">Email</font></div></td>
                        <td colspan="2"><input name="Email" type="text" class="textforms" size="23" value="<?= $array[3] ?>"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD"><div align="right">&nbsp;</div></td>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right"><font color="red">Processor:</font></div></td>
                        <td colspan="2"><input name="Processor" type="text" class="textforms"  size="23" value="<?= $array[4] ?>"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right"><font color="red">Phone:</font></div></td>
                        <td><input name="ProcessorPhone" type="text" class="textforms" size="23"  value="<?= $array[5] ?>">
                        </td>
                        <td class="textformb">Fax:
                          <input name="ProcessorFax" type="text" class="textforms"  size="15"  value="<?= $array[6] ?>"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right"><font color="red">Email</font></div></td>
                        <td colspan="2"><input name="ProcessorEmail" type="text" class="textforms" size="23" value="<?= $array[7] ?>"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD"><div align="right"></div></td>
                        <td colspan="2">Note: If you do not have a processor please write "N/A" for the fields above</td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD"><div align="right"></div></td>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right"><font color="red">Loan
                            Officer's Name: </font></div></td>
                        <td colspan="2"><input name="LoanOfficer" type="text" class="textforms"  size="23" value="<?= $array[8] ?>"></td>
                      </tr>
                      <tr>
                        <td height="24" bgcolor="#DDDDDD" class="textformb"><div align="right"><font color="red">Phone:</font></div></td>
                        <td><input name="LoanOfficerPhone" type="text" class="textforms"  size="23" value="<?= $array[9] ?>"></td>
                        <td class="textformb">Fax:
                          <input name="LoanOfficerFax" type="text" class="textforms"  size="15"  value="<?= $array[11] ?>"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right"><font color="red">Email</font></div></td>
                        <td colspan="2"><input name="LoanOfficerEmail" type="text" class="textforms" size="23"  value="<?= $array[10] ?>"></td>
                      </tr>
                      <tr>
                        <td colspan="3">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3"><div align="left" class="textformheaders">Property
                            information</div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred"><font color="red">Property
                            Address:</font></div></td>
                        <td colspan="2"><input name="PropertyAddress" type="text" class="textforms" id="PropertyAddress" size="23"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred"><font color="red">
                            City/Town</font></div></td>
                        <td colspan="2"><input name="PropertyCityTown" type="text" class="textforms" id="PropertyCityTown" size="23"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred"><font color="red">
                            State</font></div></td>
                        <td><select name="PropertyState" class="textforms" id="PropertyState">
                            <option value="NA">Select a State</option>
                             <?php   
                               foreach($GLOBALS['states'] as $state)
                              {
            
                                   echo '<option value="'.$state;
                                   echo '">'.$state.'</option>';
                              }
        
                              ?>
                         <!--<option value="Alabama">Alabama</option>
<option value="Alaska">Alaska</option>
<option value="Arizona">Arizona</option>
<option value="Arkansas">Arkansas</option>
<option value="California">California</option>
<option value="Colorado">Colorado</option>
<option value="Connecticut">Connecticut</option>
<option value="Delaware">Delaware</option>
<option value="District Of Columbia">District Of Columbia</option>
<option value="Florida">Florida</option>
<option value="Georgia">Georgia</option>
<option value="Hawaii">Hawaii</option>
<option value="Idaho">Idaho</option>
<option value="Illinois">Illinois</option>
<option value="Indiana">Indiana</option>
<option value="Iowa">Iowa</option>
<option value="Kansas">Kansas</option>
<option value="Kentucky">Kentucky</option>
<option value="Louisiana">Louisiana</option>
<option value="Maine">Maine</option>
<option value="Maryland">Maryland</option>
<option value="Massachusetts">Massachusetts</option>
<option value="Michigan">Michigan</option>
<option value="Minnesota">Minnesota</option>
<option value="Mississippi">Mississippi</option>
<option value="Missouri">Missouri</option>
<option value="Montana">Montana</option>
<option value="Nebraska">Nebraska</option>
<option value="Nevada">Nevada</option>
<option value="New Hampshire">New Hampshire</option>
<option value="New Jersey">New Jersey</option>
<option value="New Mexico">New Mexico</option>
<option value="New York">New York</option>
<option value="North Carolina">North Carolina</option>
<option value="North Dakota">North Dakota</option>
<option value="Ohio">Ohio</option>
<option value="Oklahoma">Oklahoma</option>
<option value="Oregon">Oregon</option>
<option value="Pennsylvania">Pennsylvania</option>
<option value="Rhode Island">Rhode Island</option>
<option value="South Carolina">South Carolina</option>
<option value="South Dakota">South Dakota</option>
<option value="Tennessee">Tennessee</option>
<option value="Texas">Texas</option>
<option value="Utah">Utah</option>
<option value="Vermont">Vermont</option>
<option value="Virginia">Virginia</option>
<option value="Washington">Washington</option>
<option value="West Virginia">West Virginia</option>
<option value="Wisconsin">Wisconsin</option>
<option value="Wyoming">Wyoming</option>-->
                          </select> </td>
                        <td class="textformb">Zip Code:
                          <input name="PropertyZipCode" type="text" class="textforms" id="PropertyZipCode" size="10"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Tax
                            Parcel ID #:</div></td>
                        <td colspan="2"><input name="TaxParcelID" type="text" class="textforms" id="TaxParcelID" size="23"></td>
                      </tr>
                      <tr>
                        <td><div align="right"></div></td>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="18" colspan="3"><div align="left" class="textformheaders">Borrower
                            Information</div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred"><font color="red">Borrower
                            1 Last Name:</font></div></td>
                        <td><input name="Borrower1LastName" type="text" class="textforms" size="23"></td>
                        <td class="textformb"><span class="textformbred"><font color="red">First
                          Name:</font></span> <input name="Borrower1FirstName" type="text" class="textforms" size="15"></td>
                      </tr>
                      <!--<tr>
                        <td height="26" bgcolor="#DDDDDD" class="textformb"><div align="right">Social
                            Security #: </div></td>
                        <td colspan="2"><input name="Borrower1Social" type="text" class="textforms" size="23">
                        </td>
                      </tr> -->
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right"><font color="red">Work
                            Phone:</font> </div></td>
                        <td><input name="BorrowerWorkPhone" type="text" class="textforms" id="BorrowerPhone2" size="23"></td>
                        <td class="textformb">Cell:
                          <input name="BorrowerCellPhone" type="text" class="textforms" id="BorrowerPhone4" size="15"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Home
                            Phone:</div></td>
                        <td><input name="BorrowerHomePhone" type="text" class="textforms" id="BorrowerPhone3" size="23"></td>
                        <td class="textformb">Fax:
                          <input name="BorrowerFax" type="text" class="textforms" id="BorrowerPhone5" size="15"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="textformb">&nbsp;</td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Borrower
                            2 Last Name:</div></td>
                        <td><input name="Borrower2LastName" type="text" class="textforms" size="23"></td>
                        <td class="textformb">First Name:
                          <input name="Borrower2FirstName" type="text" class="textforms" size="15"></td>
                      </tr>
                     <!-- <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Social
                            Security #: </div></td>
                        <td colspan="2"><input name="Borrower2Social" type="text" class="textforms" size="23">
                        </td>
                      </tr>-->
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Work
                            Phone:</div></td>
                        <td><input name="Borrower2WorkPhone" type="text" class="textforms" id="BorrowerPhone2" size="23"></td>
                        <td class="textformb">Cell:
                          <input name="Borrower2CellPhone" type="text" class="textforms" id="BorrowerPhone4" size="15"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Home
                            Phone:</div></td>
                        <td><input name="Borrower2HomePhone" type="text" class="textforms" id="BorrowerPhone3" size="23"></td>
                        <td class="textformb">Fax:
                          <input name="Borrower2Fax" type="text" class="textforms" id="BorrowerPhone5" size="15"></td>
                      </tr>
                      <tr>
                        <td colspan="3">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3"><div align="left" class="textformheaders">Loan
                            Information</div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right"><font color="red">Loan
                            Amount:</font></div></td>
                        <td><input name="LoanAmount" type="text" class="textforms" id="LoanAmount" value="<?= $_SESSION['loan_amount'] ?>" size="23"></td>
                        <td class="textformb"><font color="red">Loan ID No.:</font>
                          <input name="LoanIDNumber" type="text" class="textforms" id="LoanIDNumber" value="<?= $_SESSION['loanid'] ?>" size="15"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right"><font color="red">Lender
                            Name/Mortagagee:</font></div></td>
                        <td colspan="2"><input name="LenderNameMortgagee" type="text" class="textforms" size="23"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right"><font color="red">Address:</font></div></td>
                        <td colspan="2"><input name="LenderAddress" type="text" class="textforms" size="23"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right"><font color="red">Lender
                            Phone:</font></div></td>
                        <td colspan="2"><input name="LenderPhone" type="text" class="textforms" size="23"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Lender
                            Fax:</div></td>
                        <td colspan="2"><input name="LenderFax" type="text" class="textforms" size="23"></td>
                      </tr>
                      <tr>
                        <td rowspan="2" valign="top" bgcolor="#DDDDDD" class="textformb"><div align="right">Loan
                            Type<br>
                            (Check All That Apply):</div></td>
                        <td colspan="2"><input name="HomeEquityLine" type="checkbox" class="textforms" id="HomeEquityLine" value="checkbox">
                          <span class="textformb">Home Equity Line</span></td>
                      </tr>
                      <tr>
                        <td colspan="2"><input name="Refinance" type="checkbox" class="textforms" id="Refinance" value="checkbox">
                          <span class="textformb"> Refinance</span> </td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD">&nbsp;</td>
                        <td colspan="2"><input name="Purchase" type="checkbox" class="textforms" id="Purchase" value="checkbox">
                          <span class="textformb">Purchase</span></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD">&nbsp;</td>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD"><div align="right"><span class="textmainb">Check
                            all that apply</span>:</div></td>
                        <td colspan="2"><input name="TitleInsurancePolicy" type="checkbox" class="textforms" id="TitleInsurancePolicy" value="checkbox">
                          <span class="textformb">Title Insurance/Title Policy</span></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD"><div align="right"></div></td>
                        <td colspan="2"><input name="SurveyPlotPlanAffidavit" type="checkbox" class="textforms" id="SurveyPlotPlanAffidavit" value="checkbox">
                          <span class="textformb">Survey/Plot Plan/Affidavit</span></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD"><div align="right"></div></td>
                        <td colspan="2"><input name="Other" type="checkbox" class="textforms" id="Other" value="checkbox">
                          <span class="textformb">Other (Please Specify:)</span>
                          <input name="Other1" type="text" class="textforms" id="Other1"></td>
                      </tr>
                      <tr>
                        <td colspan="3">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3"><div align="left" class="textformheaders">Seller
                            Information</div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right"><font color="red">Seller
                            1 Last Name:</font></div></td>
                        <td><input name="Seller1LastName" type="text" class="textforms" size="23"></td>
                        <td class="textformb"><font color="red">First Name:</font>
                          <input name="Seller1FirstName" type="text" class="textforms" size="15"></td>
                      </tr>
                      <!--<tr>
                        <td height="26" bgcolor="#DDDDDD" class="textformb"><div align="right">Social
                            Security #: </div></td>
                        <td colspan="2"><input name="Seller1Social" type="text" class="textforms" size="23"></td>
                      </tr>-->
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right"><font color="red">Phone:</font></div></td>
                        <td><input name="Seller1Phone" type="text" class="textforms" size="23"></td>
                        <td class="textformb">Fax:
                          <input name="Seller1Fax" type="text" class="textforms" size="15"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Cell:</div></td>
                        <td colspan="2"><input name="Seller1Cell" type="text" class="textforms" id="Seller1Cell" size="23"></td>
                      </tr>
                      <tr>
                        <td class="textformb">&nbsp;</td>
                        <td>&nbsp;</td>
                        <td class="textformb">&nbsp;</td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Seller
                            2 Last Name:</div></td>
                        <td><input name="Seller2LastName" type="text" class="textforms" size="23"></td>
                        <td class="textformb">First Name:
                          <input name="Seller2FirstName" type="text" class="textforms" size="15"></td>
                      </tr>
                      <!--<tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Social
                            Security #: </div></td>
                        <td colspan="2"><input name="Seller2Social" type="text" class="textforms" size="23"></td>
                      </tr>-->
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Phone:</div></td>
                        <td><input name="Seller2Phone" type="text" class="textforms" id="Seller2Phone" size="23"></td>
                        <td class="textformb">Fax:
                          <input name="Seller2Fax" type="text" class="textforms" id="Seller2Fax" size="15"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Cell:</div></td>
                        <td colspan="2"><input name="Seller2Cell" type="text" class="textforms" id="Seller2Cell" size="23"></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3"><div align="left" class="textformheaders">Estimated
                            Closing Date</div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD"><div align="right" class="textformb">Estimated
                            Closing Date: </div></td>
                        <td colspan="2"><input name="EstimatedClosing" type="text" class="textforms" id="datepicker" class="datepicker"  size="23"></td>
                      </tr>
                      <tr>
                        <td colspan="3">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3"> <div align="left" class="textformheaders">Special
                            Instructions / Comments</div></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD"><div align="right"></div></td>
                        <td colspan="2"><textarea name="SpecialInstructionsComments" cols="50" rows="4" class="textforms" id="SpecialInstructionsComments"></textarea></td>
                      </tr>
		      <tr><td>&nbsp;</td></tr>
                       <tr>
			<td>
                          <input type="submit" value="Submit Form" class="btn btn-default" style="align:center;" />
			</td>
		</tr>
                    </table>

</form>

<!-- End  Form -->
</div>
</div>
</body>
</html>