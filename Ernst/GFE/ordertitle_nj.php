<?php
header('P3P: CP="CAO PSA OUR"');
session_start();
ob_flush();

//query to take in profile information

// #Implement
//$username="jimboind_demo";
//$password="Test123";
//$database="jimboind_Demo";

include ('les_config.php');

$db = mysql_connect('localhost',$username,$password);
@mysql_select_db($database) or die( "Unable to select database ". mysql_error());

error_reporting(E_ALL);

$query="SELECT `RequestedBy`,`Phone`,`Fax`,`Email`,`Processor`,`ProcessorPhone`,`ProcessorFax`,`ProcessorEmail`,`LO_Name`,`LO_Phone`,`LO_Email`,`LO_Fax` FROM `TitleOrderProfile` WHERE Username='".$_SESSION['Username']."'";
$array=mysql_fetch_array(mysql_query($query));

?>
<html>

<head>


<title>Title Insurance Closing Packages Title Escrow Services</title>

<meta name="Description" content="Title Insurance Closing Packages of Residential Title and Escrow Services which handles closings in Massachusetts, Rhode Island, Connecticut, and New Hampshire. Attorneys close in the Registry of Deeds, realtor's office and borrower's home.">
<meta name="Keywords" content="Title Insurance Packages Residential Title Services Escrow Closing Attorneys Real Estate Attorneys">
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
<!-- <link rel="stylesheet" href="stylesheets/datepicker.css" />   -->
<script>$(function() {    $( "#datepicker" ).datepicker();  });

function FormCheck(){
  if(!document.TitleOrder.OrderName.value)
  {
    alert("Please fill out the Name/Requested By field");
    return false;
  }
  if(!document.TitleOrder.OrderCompany.value)
  {
    alert("Please fill out the Order By Firm/Company field");
    return false;
  }
  if(!document.TitleOrder.OrderPhone.value)
  {
    alert("Please fill out the Ordered By Phone number field");
    return false;
  }
  if(!document.TitleOrder.OrderEmail.value)
  {
    alert("Please fill out the Order Email field");
    return false;
  }

  if(!document.TitleOrder.PropertyAddress.value)
  {
    alert("Please fill out the Property Address field");
    return false;
  }
  if(!document.TitleOrder.PropertyMunicipality.value)
  {
    alert("Please fill out the Property Municipality field");
    return false;
  }
  if(!document.TitleOrder.mortgagers.value)
  {
    alert("Please fill out the Buyers/Mortgagers field");
    return false;
  }


} //End Form Check

</script>
</head>
<body style="background: #efeee9;">
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
    <a class="navbar-brand" href="http://lssoftwaresolutions.com/" target="_blank"><img class="img-responsive" src="./Images/lode_star_logo.png" style="height:50px;widht:102px" alt="Responsive image"></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <!--<li ><a href="GFE_main.php">GFE</a></li>
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
                    fields</font>. If the areas in <font color="red">red</font>
                    are not completed, we will not receive your form.</p>
                  <p class="textmain">If you would prefer to complete it by hand
                    and FAX it, <a href="http://www.res-title.com/order-form-general.pdf" target="_blank">click
                    here for the Downloadable/Printable Version</a>. You will
                    need <a href="http://get.adobe.com/reader/" class="navtextmain">Adobe
                    Acrobat Reader</a> to view it.</p><br/><br/>

<!-- Begin  Form -->
<form enctype="multipart/form-data" name="TitleOrder" method="post" action="titleorder_email_nj.php" accept-charset="UTF-8" onsubmit="return FormCheck()">

                    <table width="575" align="center" cellpadding="0" cellspacing="3">
                      <tr>
			<td colspan="3"><b>General Information</b></td>
		      </tr>
		      <tr>
			<td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred">Type:</div></td>
			<td colspan="2">
				<input type="radio" name="Title_Type" value="purchase">Purchase &nbsp;
				<input type="radio" name="Title_Type" value="refinance">Refinance &nbsp;
			<font color="red">*</font></td>
		      </tr>
		      <tr>
			<td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred">Anticipated Closing Date:</div></td>
			<td colspan="2"><input name="ClosingDate" type="text" id="datepicker" class="datepicker"  value="" size="23"></td>
		      </tr>
		      <tr><td>&nbsp; </td></tr>
		      <tr>
			<td colspan="3"><b>Ordered By</b></td>
		      </tr>
		       <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred">Name/Requested
                            By:</div></td>
                        <td colspan="2"><input name="OrderName" type="text" class="textforms" size="23" value="<?= $array[0] ?>"><font color="red">*</font></td>
                      </tr>
		       <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred">Firm/Co:</div></td>
                        <td colspan="2"><input name="OrderCompany" type="text" class="textforms" value="" size="23"><font color="red">*</font></td>
                      </tr>
		        <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred">Address:</div></td>
                        <td colspan="2"><input name="OrderAddress" type="text" class="textforms" value="" size="23"></td>
                      </tr>
			 <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred">City:</div></td>
                        <td colspan="2"><input name="OrderCity" type="text" class="textforms" value="" size="23"></td>
                      </tr>
			 <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred">State:</div></td>
                        <td colspan="2"><input name="OrderState" type="text" class="textforms" value="" size="23"></td>
                      </tr>
			 <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred">Zip:</div></td>
                        <td colspan="2"><input name="OrderZip" type="text" class="textforms" value="" size="23"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred">Phone:</div></td>
                        <td colspan="2"><input name="OrderPhone" type="text" class="textforms" size="23"  value="<?= $array[1] ?>"><font color="red">*</font></td>
		      </tr>
			<tr>
                        <td bgcolor="#DDDDDD"  class="textformb"><div align="right" class="textformbred">Fax:</div></td>
                        <td colspan="2"><input name="OrderFax" type="text" class="textforms"  value="<?= $array[2] ?>" size="23"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Email:</div></td>
                        <td colspan="2"><input name="OrderEmail" type="text" class="textforms"  value="<?= $array[3] ?>" size="23"><font color="red">*</font></td>
                      </tr>
                      <tr>
                        <td colspan="3">&nbsp; </td>
                      </tr>

		<tr>
			<td colspan="3"><b>Property</b></td>
		</tr>
		      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred">Property
                            Address:</div></td>
                        <td colspan="2"><input name="PropertyAddress" type="text" class="textforms" id="PropertyAddress" size="23"><font color="red">*</font></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred">Municipality:</div></td>
                        <td colspan="2"><input name="PropertyMunicipality" type="text" class="textforms" id="PropertyMunicipality" size="23"><font color="red">*</font></td>
                      </tr>
                       <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred">County:</div></td>
                        <td colspan="2"><input name="PropertyCounty" type="text" class="textforms" id="PropertyCounty" size="23"></td>
                      </tr>
                       <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred">Lot:</div></td>
                        <td colspan="2"><input name="PropertyLot" type="text" class="textforms" id="PropertyLot" size="23"></td>
                      </tr>
		        <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred">Condo:</div></td>
                        <td colspan="2"><input name="PropertyCondo" type="text" class="textforms" id="PropertyCondo" size="23"></td>
                      </tr>
			 <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred">Unit Number:</div></td>
                        <td colspan="2"><input name="PropertyUnitNumber" type="text" class="textforms" id="PropertyUnitNumber" size="23"></td>
                      </tr>
		        </tr>
			 <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred">Building:</div></td>
                        <td colspan="2"><input name="PropertyBuilding" type="text" class="textforms" id="PropertyBuilding" size="23"></td>
                      </tr>
			    </tr>
			 <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred">Purchase Price</div></td>
                        <td colspan="2"><input name="PurchasePrice" type="text" class="textforms" id="PurchasePrice" size="23"></td>
                      </tr>
			    </tr>
			 <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred">Mortgage Amount</div></td>
                        <td colspan="2"><input name="LoanAmount" type="text" class="textforms" id="LoanAmount" value="<?= $_SESSION['loan_amount'] ?>" size="23"></td>
                      </tr>
		       <tr>
                        <td colspan="3">&nbsp; </td>
                      </tr>

		<tr>
			<td colspan="3"><b>Parties</b></td>
		</tr>

                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Buyers/Mortgagers:</div></td>
                        <td colspan="2"><input name="mortgagers" type="text" class="textforms" value="" size="23"><font color="red">*</font></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Marital Status:</div></td>
                        <td colspan="2"><input name="MaritalStatus" type="text" class="textforms" size="23"> </td>
		      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Maiden Name:</div></td>
                        <td colspan="2"><input name="MaidenName" type="text" class="textforms" size="23"></td>
                      </tr>
                      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Sellers: </div></td>
                        <td colspan="2"><input name="Sellers" type="text" class="textforms" size="23"></td>
                      </tr>
		      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Marital Status: </div></td>
                        <td colspan="2"><input name="MaritalStatusSellers" type="text" class="textforms" size="23"></td>
                      </tr>
		      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Sellers' Attorney: </div></td>
                        <td colspan="2"><input name="SellersAttorney" type="text" class="textforms" size="23"></td>
                      </tr>
		      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Phone: </div></td>
                        <td colspan="2"><input name="SellersPhone" type="text" class="textforms" size="23"></td>
                      </tr>
      		      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Fax: </div></td>
                        <td colspan="2"><input name="SellersFax" type="text" class="textforms" size="23"></td>
                      </tr>
      		      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Address: </div></td>
                        <td colspan="2"><input name="SellersAddress" type="text" class="textforms" size="23"></td>
                      </tr>
      		      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Email: </div></td>
                        <td colspan="2"><input name="SellersEmail" type="text" class="textforms" size="23"></td>
                      </tr>
		      <tr>
                       <td class="textformb" colspan="2"><div align="left">Send the above referenced attorney a copy of the commitment directly?
			</div></td>
                        <td ><input type="checkbox" name="SendCopy"> </td>
                      </tr>
		         <tr>
                        <td colspan="3">&nbsp; </td>
                      </tr>

			<tr>
			<td colspan="3"><b>Lender Information</b></td>
			</tr>
		       <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Lender: </div></td>
                        <td colspan="2"><input name="LenderName" type="text" class="textforms" size="23"></td>
                      </tr>
		      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Contact: </div></td>
                        <td colspan="2"><input name="LenderContact" type="text" class="textforms" size="23"></td>
                      </tr>
		      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Phone: </div></td>
                        <td colspan="2"><input name="LenderPhone" type="text" class="textforms" size="23"></td>
                      </tr>
		      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Address: </div></td>
                        <td colspan="2"><input name="LenderAddress" type="text" class="textforms" size="23"></td>
                      </tr>
      		      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">City: </div></td>
                        <td colspan="2"><input name="LenderCity" type="text" class="textforms" size="23"></td>
                      </tr>
      		      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">State: </div></td>
                        <td colspan="2"><input name="LenderState" type="text" class="textforms" size="23"></td>
                      </tr>
      		      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Zip: </div></td>
                        <td colspan="2"><input name="LenderZip" type="text" class="textforms" size="23"></td>
                      </tr>
		       <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Fax: </div></td>
                        <td colspan="2"><input name="LenderFax" type="text" class="textforms" size="23"></td>
                      </tr>
      		      <tr>
                        <td bgcolor="#DDDDDD" class="textformb"><div align="right">Mortgage Clause: </div></td>
                        <td colspan="2"><input name="MortgageClause" type="text" class="textforms" size="23"></td>
                      </tr>
		        <tr>
                        <td class="textformb" colspan="2"><div align="left">Would you like us to send the above referenced lender a copy of the Commitment? </div></td>
                        <td><input type="radio" name="Lender_Copy" value="Yes">Yes &nbsp;
			<input type="radio" name="Lender_Copy" value="No">No &nbsp;</td>
                      </tr>
      		      <tr>
                        <td class="textformb" colspan="2"><div align="left">Would you like us to order a Survey?</div></td>
                         <td><input type="radio" name="OrderSurvey" value="Yes">Yes &nbsp;
			<input type="radio" name="OrderSurvey" value="No">No &nbsp;</td>
                      </tr>
		       <tr>
                        <td class="textformb" colspan="2"><div align="left">Would you like us to order a Flood Search?</div></td>
                         <td><input type="radio" name="FloodSearch" value="Yes">Yes &nbsp;
			<input type="radio" name="FloodSearch" value="No">No &nbsp;</td>
                      </tr>
		       <tr>
                        <td class="textformb" colspan="2"><div align="left">Would you like us to file a Notice of Settlement?</div></td>
                         <td><input type="radio" name="NoticeOfSettlement" value="Yes">Yes &nbsp;
			<input type="radio" name="NoticeOfSettlement" value="No">No &nbsp;</td>
                      </tr>

                       <tr>
                        <td colspan="3">&nbsp; </td>
                      </tr>

			<tr>
			<td colspan="3"><b>Closing</b></td>
			</tr>
			 <tr>
                        <td class="textformb" bgcolor="#DDDDDD" ><div align="left">Who should close?</div></td>
                         <td colspan="2">
			<input type="radio" name="Closer" value="BankAttorney">Bank Review Attorney(please enter information below) <br />
			<input type="radio" name="Closer" value="Res-Title">Residential Title to Close <br />
			<input type="radio" name="Closer" value="ClosingAttorney">Closing Attorney (if different from applicant please enter information below)
                      </tr>
			<tr>
			<td colspan="2" class="textformb" bgcolor="#DDDDDD" >
			If the closing attorney address is different than entered above or if you are using a Bank Review Attorney, please enter the information below:
			</td><td colspan="3"> <textarea name="ClosingAttorney" cols="60" rows="4" class="textforms" id="ClosingAttorney"></textarea></td>
                      </tr>
			<tr>
                        <td colspan="3">&nbsp; </td>
                      </tr>
			<tr></tr>
			<td colspan="3"><b>Existing Mortgages - Pay Off Information</b></td>
			</tr>
			<tr>
			<td colspan="2" class="textformb" bgcolor="#DDDDDD" >
			If you require that we request pay off information on existing mortgages, please attach a list
			of the lenders with their addresses and the account numbers for each loan. </td>
			<td><textarea name="PayOff" cols="60" rows="4" class="textforms" id="PayOff"></textarea></td>
                      </tr>

			<tr>
			<td colspan="2" class="textformb" bgcolor="#DDDDDD" >
			Special Requirements/Comments </td>
			<td colspan="3"> <textarea name="Comments" cols="60" rows="4" class="textforms" id="Comments"></textarea></td>
                      </tr>
		      <tr><td>&nbsp;</td></tr>
                      <tr>
			<td colspan="3" align="center">
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