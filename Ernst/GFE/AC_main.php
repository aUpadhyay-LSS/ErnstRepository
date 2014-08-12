<?php
header('P3P: CP="CAO PSA OUR"');
session_start();
include('les_config.php');
if(!empty($_SESSION['Username']) && $_SESSION['LoggedIn'] == 1)  
{  
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<!--#Implement-->
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
<title>Company Affordability Calculator</title>	
<meta name="Description" content="Title Insurance Closing Packages of Residential Title and Escrow Services which handles closings in Massachusetts, Rhode Island, Connecticut, and New Hampshire. Attorneys close in the Registry of Deeds, realtor's office and borrower's home.">
<meta name="Keywords" content="Title Insurance Packages Residential Title Services Escrow Closing Attorneys Real Estate Attorneys">
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta charset="utf-8" />

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script src="js/respond.js"></script>
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script src="js/respond.js"></script>
<![endif]-->
<!-- <link rel="stylesheet" href="stylesheets/datepicker.css" />   -->
<script>$(function() {    $( "#datepicker" ).datepicker();  });  </script>
<?php
if(isset($_SESSION['state'])){echo '<script>$("document").ready(function(){$("#state").val("'.$_SESSION['state'].'");})</script>';}
if(isset($_SESSION['county'])){echo '<script>$("document").ready(function(){$("#county").val("'.$_SESSION['county'].'");})</script>';}
if(isset($_SESSION['township'])){echo '<script>$("document").ready(function(){$("#township").val("'.$_SESSION['township'].'");})</script>';}
?>

</head>

<body style="background: #efeee9;">

<div class="container">
 
  <?php
if(preg_match('/(?i)msie [7-8]/',$_SERVER['HTTP_USER_AGENT'])==1)
{
?>
<ul>
<!--<li><a href="GFE_main.php" class="navbutton">GFE</a></li>
<li class="active"><a href="AC_main.php" class="navbutton">Affordability</a></li>
<li><a href="COMM_main.php" class="navbutton">Commercial</a></li>
<li><a href="CEMA_main.php" class="navbutton">New York Calculator</a></li>-->
  <?php if($gfe=="1"){?><li><a href="GFE_main.php" class="navbutton">GFE</a></li><?php } ?>
 <?php if($ac=="1"){?><li class="active"><a href="AC_main.php" class="navbutton">Affordability</a></li><?php } ?>
 <?php if($nyc=="1"){?><li><a href="CEMA_main.php" class="navbutton">New York</a></li><?php } ?>
 <?php if($ctic=="1"){?><li><a href="COMM_main.php" class="navbutton">Commercial</a></li><?php } ?>
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
   <!--   <li><a href="GFE_main.php">GFE</a></li>
      <li class="active"><a href="AC_main.php">Affordability</a></li>
      <li><a href="CEMA_main.php">New York</a></li>
      <li><a href="COMM_main.php">Commercial</a></li>-->
  <?php if($gfe=="1"){?><li><a href="GFE_main.php">GFE</a></li><?php } ?>
 <?php if($ac=="1"){?><li class="active"><a href="AC_main.php" >Affordability</a></li><?php } ?>
 <?php if($nyc=="1"){?><li><a href="CEMA_main.php">New York</a></li><?php } ?>
 <?php if($ctic=="1"){?><li><a href="COMM_main.php">Commercial</a></li><?php } ?>
 
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="ordertitle.php">Order Title</a></li>
      <li><a href="myprofile.php">My Profile</a></li>
      <li><a href="history.php">My Searches</a></li>
      <li><a href="logout.php">Log Out</a></li>
    </ul>
  </div><!-- /.navbar-collapse -->

</nav>

<?php
}
?>

</nav>
</div>
<div id="popupHUD" title="Popup Blocked" style="display:none;">
  <p>The HUD preview opens in a different window. Please disable your popup blocker for this site.</p>
</div>

								 <!-- Beginning of Rate calculator -->
<script>

function fetchcounties(state){
        $.ajax({
                 url:"fetchcounty.php",
                 type: "post",
                 async:false,
                 data:{
                    'state':state
                    },
                 success: function(data) 
	        {
                 $("#county").html(data);
                 fetchtownships($('#county').val(),$('#state').val());
                 
	        }});
        
        
    }
    
    function fetchtownships(county,state){
        
        $.ajax({
                 url:"fetchtownship.php",
                 type: "post",
                 async:false,
                 data:{
                    'county':county,
                    'state': state
                    },
                 success: function(data) 
	        {
                 $("#township").html(data);
	        }});
        
        
    }
	

//
//function addOption(value, text ) {
//  var optn = document.createElement("OPTION");
//  optn.text = text;
//  optn.value = value;
//  document.CALC.county.options.add(optn);
//}
//
//function addTownship(value, text ) {
//  var optn = document.createElement("OPTION");
//  optn.text = text;
//  optn.value = value;
//  document.CALC.township.options.add(optn);
//}

function ClearHPC(){
// clearTownships();
//removeAllOptions();
  document.CALC.buyer.value = "";
  document.CALC.address.value = "";
  document.CALC.date.value = "";
  document.CALC.state.value = "NA";
  document.CALC.purchase_price.value = 0;
  document.CALC.deposit.value = 0;
  document.CALC.loan_amount.value = 0;
  document.CALC.InterestRate.value = 4;
  document.CALC.LoanTerm.value = 30;
  document.CALC.RealEstateTaxes.value = 6000;
  document.CALC.WhenPaid.value = 6;
  document.CALC.insurance.value = 1200;
   
}



function ValidateHPC(){
  var result="";
 
  //checks loan amount
  if(document.CALC.loan_amount.value >=0 && document.CALC.loan_amount.value < 100000000){}
  else {alert("Please enter a valid loan amount"); document.CALC.loan_amount.value=0; return false;}
  
  //checks purchase price
  if(document.CALC.purchase_price.value >=0 &&  document.CALC.purchase_price.value < 100000000){}
  else {alert("Please enter a valid purchase price"); document.CALC.purchase_price.value=0; return false;}
  
  //checks deposit
  if(document.CALC.deposit.value >=0 && document.CALC.deposit.value < 100000000){}
  else {alert("Please enter a valid deposit amount"); document.CALC.deposit.value=0; return false;}
  
    //checks interest rate
  if(document.CALC.interest_rate.value >=0 && document.CALC.interest_rate.value < 100000000){}
  else {alert("Please enter a valid interest rate"); document.CALC.InterestRate.value=0; return false;}
  
    //checks Real Estate Taxes
  if(document.CALC.RealEstateTaxes.value >=0 && document.CALC.RealEstateTaxes.value < 100000000){}
  else {alert("Please enter a valid deposit amount"); document.CALC.RealEstateTaxes.value=0; return false;}
  
    //checks annual insurance
  if(document.CALC.insurance.value >=0 && document.CALC.insurance.value < 100000000){}
  else {alert("Please enter a valid deposit amount"); document.CALC.insurance.value=0; return false;}
  
  
  //Select a State check
  if (document.CALC.state.value == "NA"){alert("Please select a state"); return false;}
  
      //Sets default off for mansion tax inicator
    document.CALC.mansion.value = "";
    
  if(document.CALC.purchase_price.value >1000000 && (document.CALC.state.value=="NJ" || document.CALC.state.value=="NY"))
  {
    var mansion=confirm("Please click 'Ok' if Property is 1-3 Family home");
      
    if(mansion==true){
      document.CALC.mansion.value = "Yes";
    }
  }
  
}// end form validation funtion

</script>
<div class="container">
<p></p><br/>
<form name="CALC" method="post" action="AC_results.php" onsubmit="return ValidateHPC()" target="_self" >
<table class="table table-hover" STYLE=margin-left:15px border="0" cellspacing="2" cellpadding="10">
<tr><td class="col-md-2">Buyer </td>
<td class="col-md-3"><input type="text" name="buyer" class="form-control" style="width:250px;height:60px;" value="<?= $_SESSION['buyer']?>"></td>
<td class="col-md-2 col-md-offset-1">Seller </td>
<td class="col-md-3"><input type="text" name="seller" class="form-control" style="width:250px;height:60px;" value="<?= $_SESSION['seller']?>"></td></tr>
<tr><td class="col-md-2">Lender </td>
<td class="col-md-3"><input type="text" name="lender" class="form-control" style="width:250px;height:60px;" value="<?= $_SESSION['lender']?>"></td>
<td class="col-md-2 col-md-offset-1">Address </td>
<td class="col-md-3"><input type="text" name="address" class="form-control" style="width:250px;height:60px;" value="<?= $_SESSION['address']?>"></td></tr>
<tr><td class="col-md-2">State*</td>
<td class="col-md-3">
<select name="state" id="state" onchange= "fetchcounties(this.value)">
  <option value="NA">Please Select a State</option>
   <?php   
         foreach($GLOBALS['states'] as $state)
        {
            
            echo '<option value="'.$state.'">'.$state.'</option>';
        }
        
        ?>
<!--<option value='AL' <?php if($_SESSION['state']=='AL'){echo 'selected';}?>>AL</option>
<option value='CO' <?php if($_SESSION['state']=='CO'){echo 'selected';}?>>CO</option>
<option value='CT' <?php if($_SESSION['state']=='CT'){echo 'selected';}?>>CT</option>
<option value='DC' <?php if($_SESSION['state']=='DC'){echo 'selected';}?>>DC</option>
<option value='DE' <?php if($_SESSION['state']=='DE'){echo 'selected';}?>>DE</option>
<option value='FL' <?php if($_SESSION['state']=='FL'){echo 'selected';}?>>FL</option>
<option value='GA' <?php if($_SESSION['state']=='GA'){echo 'selected';}?>>GA</option>
<option value='IL' <?php if($_SESSION['state']=='IL'){echo 'selected';}?>>IL</option>
<option value='IN' <?php if($_SESSION['state']=='IN'){echo 'selected';}?>>IN</option>
<option value='KS' <?php if($_SESSION['state']=='KS'){echo 'selected';}?>>KS</option>
<option value='KY' <?php if($_SESSION['state']=='KY'){echo 'selected';}?>>KY</option>
<option value='LA' <?php if($_SESSION['state']=='LA'){echo 'selected';}?>>LA</option>
<option value='MA' <?php if($_SESSION['state']=='MA'){echo 'selected';}?>>MA</option>
<option value='MD' <?php if($_SESSION['state']=='MD'){echo 'selected';}?>>MD</option>
<option value='ME' <?php if($_SESSION['state']=='ME'){echo 'selected';}?>>ME</option>
<option value='MI' <?php if($_SESSION['state']=='MI'){echo 'selected';}?>>MI</option>
<option value='MN' <?php if($_SESSION['state']=='MN'){echo 'selected';}?>>MN</option>
<option value='MO' <?php if($_SESSION['state']=='MO'){echo 'selected';}?>>MO</option>
<option value='MS' <?php if($_SESSION['state']=='MS'){echo 'selected';}?>>MS</option>
<option value='MT' <?php if($_SESSION['state']=='MT'){echo 'selected';}?>>MT</option>
<option value='NC' <?php if($_SESSION['state']=='NC'){echo 'selected';}?>>NC</option>
<option value='ND' <?php if($_SESSION['state']=='ND'){echo 'selected';}?>>ND</option>
<option value='NE' <?php if($_SESSION['state']=='NE'){echo 'selected';}?>>NE</option>
<option value='NH' <?php if($_SESSION['state']=='NH'){echo 'selected';}?>>NH</option>
<option value='NJ' <?php if($_SESSION['state']=='NJ'){echo 'selected';}?>>NJ</option>
<option value='NY' <?php if($_SESSION['state']=='NY'){echo 'selected';}?>>NY</option>
<option value='OH' <?php if($_SESSION['state']=='OH'){echo 'selected';}?>>OH</option>
<option value='PA' <?php if($_SESSION['state']=='PA'){echo 'selected';}?>>PA</option>
<option value='RI' <?php if($_SESSION['state']=='RI'){echo 'selected';}?>>RI</option>
<option value='SC' <?php if($_SESSION['state']=='SC'){echo 'selected';}?>>SC</option>
<option value='TN' <?php if($_SESSION['state']=='TN'){echo 'selected';}?>>TN</option>
<option value='VA' <?php if($_SESSION['state']=='VA'){echo 'selected';}?>>VA</option>
<option value='VT' <?php if($_SESSION['state']=='VT'){echo 'selected';}?>>VT</option>
<option value='WI' <?php if($_SESSION['state']=='WI'){echo 'selected';}?>>WI</option>
<option value='WV' <?php if($_SESSION['state']=='WV'){echo 'selected';}?>>WV</option>
-->
</select></td>
<td class="col-md-2 col-md-offset-1">Settlement Date</td>
<td class="col-md-3"><div class="input-group">
	<input  type="text" name="date" size=10 id="datepicker" class="form-control datepicker" value="<?php if(isset($_SESSION['SettlementDate'])){echo $_SESSION['SettlementDate'];}else{echo Date("m/d/Y");}?>">
	</div></td> </tr>
<tr>
 <td class="col-md-2">County </td>
<td class="col-md-3"><select name="county" id="county" onchange= "fetchtownships(this.value,state.value)">
<option value="NA">Please select a county</option>
 </select>
</td>
<td class="col-md-2 col-md-offset-1">Township</td>
<td class="col-md-3"><select name="township" id="township"><option value="NA">Please select a township</option></select></td></tr>
<tr><td class="col-md-2">Sales Price*</td>
<td class="col-md-3"><div class="input-group"><input type="text" name="purchase_price" class="form-control" size=10 value="<?= max(0,$_SESSION['purchase_price']) ?>"></div></td>
<td class="col-md-2 col-md-offset-1">Total Deposit/Down Payment </td>
<td class="col-md-3"><div class="input-group"><input type="text" name="deposit" class="form-control" size=10 value="<?= max(0,$_SESSION['deposit']) ?>"></div></td>
</tr>
<tr>
 <td class="col-md-3"> Loan Amount*</td>
 <td><div class="input-group"> <input type="text" class="form-control"  name="loan_amount" size=10 value="<?= max(0,$_SESSION['loan_amount']) ?>" ></div></td>	
<td class="col-md-2 col-md-offset-1"> Interest Rate*</td>
<td class="col-md-3"><div class="input-group"> <input type="text" class="form-control" name="interest_rate" size=10 value="<? if($_SESSION['InterestRate'] == NULL){echo "4.2";}else {echo $_SESSION['InterestRate'];} ?>"></div></td></tr>
<tr><td class="col-md-2"> Loan Term*</td>
 <td class="col-md-3"> 
 <select name="loan_term" value="30">
  <option value="30">30 yr term</option>
  <option value="25">25 yr term</option>
  <option value="20">20 yr term</option>
  <option value="15">15 yr term</option>
  <option value="10">10 yr term</option>
 
</select>
 </td>
<td class="col-md-2 col-md-offset-1">Annual Real Estate Taxes	</td><td class="col-md-3"> <div class="input-group"><input type="text" class="form-control" name="RealEstateTaxes" size=10 value="<? if($_SESSION['RealEstateTaxes'] == NULL){echo "6000";}else {echo $_SESSION['RealEstateTaxes'];} ?>"></div> </td>
</tr>
<tr><td class="col-md-2"> Taxes Paid: </td>
<td class="col-md-3"> 
<select name="TaxesPaid" value="6">
  <option value="4">Quarterly</option>
  <option value="4">Semi-Annually</option>
  <option value="4">Annually</option>
</select>
 </td>
<td class="col-md-2 col-md-offset-1">Annual Insurance </td>
<td class="col-md-3"><div class="input-group"><input type="text" name="insurance" class="form-control" size=10 value="<? if($_SESSION['insurance'] == NULL){echo "1200";}else {echo $_SESSION['insurance'];} ?>" ></div></td></tr>
<tr><td class="col-md-2"></td><td class="col-md-3"><input type="checkbox" id="TitleOrderOnly" name="TitleOrderOnly" >&nbsp;&nbsp;Title Order Only</td>
<td class="col-md-2"> Loan Type</td>
 <td class="col-md-3"> 
 <select name="LoanType" value="Conv">
  <option value="Conv">Conventional</option>
  <option value="FHA">FHA</option>
  <option value="VA">VA</option>
</select>
 </td></tr>
<tr><td></td><td><input type="checkbox" name="FirstTime" value="FirstTime" <?php if($_SESSION['FirstTime']=="FirstTime"){echo "CHECKED";}?>>&nbsp;&nbsp; First Time Home Buyer  </td>
	<td><input type="checkbox" name="PrincipleResidence" value="PrincipleResidence" >&nbsp;&nbsp; Principle Residence  </td><td></td></tr>
<tr><td colspan="4">&nbsp;</td></tr>
<tr><td class="col-md-2"><input class="btn btn-default" type="submit" value= "Preview HUD" name="CalculateHUD"  /></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<td class="col-md-3"><input  class="btn btn-default" type="submit" value= "Calculate Monthly Payment" name="CalculateMP" /></td>
 <td class="col-md-2 col-md-offset-1"><input type="submit" class="btn btn-default"  name="EmailQuote" value= "Email Quote"/></td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <td class="col-md-3">  <input type="button" class="btn btn-default" name="Clear Values" value="Clear Values" align="right" onclick=ClearHPC() />
  <input type="hidden" name="mansion" size=20 value=""></td></tr>
</table>
  <!--
         <table STYLE= margin-left:15px >
           <tr><td><textarea name="outputtext" rows='20' cols='90'></textarea></td></tr>

                        </table>
-->

 </form>
 </div>
<br/><br/>
<div class="container">
<p STYLE= margin-left:15px;font-family:arial;font-size:12px;"><b>Disclaimer: &nbsp;</b>
The closing costs presented are for informational purposes only, and cannot be relied upon as a good faith estimate of your actual closing costs.  Please check with your local lender for their specific rates and fees, as these will vary depending on loan program, money down and credit.
</p>
</div>
</div>
<script>
  //resets county and town fields when session variable is pulled in
  //window.onload=countyswitch();
  //window.onload=townSwitch();
</script>

 
<?php 
}
else{
#Implement
  $_SESSION['lastref'] = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  $_SESSION['target']="HPC";
  
   // #Implement
  if(!isset($_SESSION['lastref']))
  {
    $_SESSION['lastref']=$path."AC_main.php";
  }
  
echo "<meta http-equiv='refresh' content='0;url= Login/index.php'>";
}
?>
</body>
 
 </html>
