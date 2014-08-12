<?php
header('P3P: CP="CAO PSA OUR"');
session_start();
include('les_config.php');
if(!empty($_SESSION['Username']) && $_SESSION['LoggedIn'] == 1)  
{
?>

<html>
<head>
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
if(isset($_SESSION['county'])){echo '<script>$("document").ready(function(){$("#county").val("'.$_SESSION['county'].'");})</script>';}
if(isset($_SESSION['township'])){echo '<script>$("document").ready(function(){$("#township").val("'.$_SESSION['township'].'");})</script>';}
?>
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script src="js/respond.js"></script>
<![endif]-->
<!-- <link rel="stylesheet" href="stylesheets/datepicker.css" />   -->
<script>$(function() {    $( "#datepicker" ).datepicker();  });  </script>
<!--<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.10.2.min.js"></script>-->


<script>

  $(function() {
    $( document ).tooltip();
  });
  
  
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
                 fetchtownships($('#county').val(),state);
                 
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

function ClearCEMA(){
  clearTownships();
  document.CALC.InsuranceType.value = "Fee Insurance";
  document.CALC.PropertyType.value = "1-2 Family";
  document.CALC.purchase_price.value = 0;
  document.CALC.county.value = "NA";
  document.CALC.loan_amount.value = 0;
  document.CALC.prior_insurance.value = 0;
  document.CALC.Principalbalance.value = 0;
  document.CALC.TitleOrderOnly.checked = false;
  document.CALC.PurchaserPays.checked = false;
  townSwitch();
  inputSwitch();
}


function ValidateCEMA(){
  
switch(document.CALC.InsuranceType.value){
  case "Refinance":
        //checks mortgage amount, must be greater than 0
    if(document.CALC.loan_amount.value >0 &&  document.CALC.loan_amount.value < 100000000){}
    else {alert("Please enter a valid loan amount greater than zero and containing no commas"); document.CALC.loan_amount.value=0; return false;}
    
        //checks Prior Insurance, must be greater than or equal to 0
    if(document.CALC.prior_insurance.value >=0 &&  document.CALC.prior_insurance.value < 100000000){}
    else {alert("Please enter a valid insurance amount containing only numbers"); document.CALC.prior_insurance.value=0; return false;}
  break;

 
  case "Refinance_CEMA":
        //checks mortgage amount, must be greater than 0
    if(document.CALC.loan_amount.value >0 &&  document.CALC.loan_amount.value < 100000000){}
    else {alert("Please enter a valid loan amount greater than zero and containing no commas"); document.CALC.loan_amount.value=0; return false;}
    
        //checks Prior Insurance, must be greater than or equal to 0
    if(document.CALC.prior_insurance.value >=0 &&  document.CALC.prior_insurance.value < 100000000){}
    else {alert("Please enter a valid insurance amount containing only numbers"); document.CALC.prior_insurance.value=0; return false;}
    
        //checks Principal Balance, must be greater than or equal to 0 and less than the loan amount
    if(document.CALC.Principalbalance.value >=0 &&  document.CALC.Principalbalance.value < 100000000 ){}
    else {alert("Please enter a valid principal balance amount containing only numbers and less than the mortgage amount"); document.CALC.Principalbalance.value=0; return false;}
  break;

    case "Fee Insurance":  
    //checks purchase price, must be greater than 0
    if(document.CALC.purchase_price.value >0 &&  document.CALC.purchase_price.value < 100000000){}
    else {alert("Please enter a valid purchase price greater than zero and containing no commas"); document.CALC.purchase_price.value=0; return false;}
  break;

  
  default: //for purchases
    //checks purchase price, must be greater than 0
    if(document.CALC.purchase_price.value >0 &&  document.CALC.purchase_price.value < 100000000){}
    else {alert("Please enter a valid purchase price greater than zero and containing no commas"); document.CALC.purchase_price.value=0; return false;}

    //checks mortgage amount, must be greater than 0
    if(document.CALC.loan_amount.value >0){}
    else {alert("Please enter a valid loan amount greater than zero and containing no commas"); document.CALC.loan_amount.value=0; return false;}

 }


}// end form validation funtion

function ClearGFE(){
  clearTownships();
  removeAllOptions();
  document.CALC.state.value = "NA";
  document.CALC.purchase_price.value = 0;
  document.CALC.exdebt.value = 0;
  document.CALC.loan_amount.value = 0;
  document.CALC.filename.value = "";
  document.CALC.loanid.value = "";
  
  document.CALC.TitleOrderOnly.checked = false;
  document.CALC.FirstTime.checked = false;
  document.CALC.loantype[0].checked = true;
}
</script>
</head>

<body style="background: #efeee9; ">
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
    <?php if($gfe=="1"){?><li><a href="GFE_main.php" class="navbutton">GFE</a></li><?php } ?>
 <?php if($ac=="1"){?><li><a href="AC_main.php" class="navbutton">Affordability</a></li><?php } ?>
 <?php if($nyc=="1"){?><li class="active"><a href="CEMA_main.php" class="navbutton">New York</a></li><?php } ?>
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
      <!--<li><a href="GFE_main.php">GFE</a></li>
      <li><a href="AC_main.php">Affordability</a></li>
      <li class="active"><a href="CEMA_main.php">New York</a></li>
      <li><a href="COMM_main.php">Commercial</a></li>-->
   <?php if($gfe=="1"){?><li><a href="GFE_main.php" class="navbutton">GFE</a></li><?php } ?>
 <?php if($ac=="1"){?><li><a href="AC_main.php" class="navbutton">Affordability</a></li><?php } ?>
 <?php if($nyc=="1"){?><li class="active"><a href="CEMA_main.php" class="navbutton">New York</a></li><?php } ?>
 <?php if($ctic=="1"){?><li><a href="COMM_main.php" class="navbutton">Commercial</a></li><?php } ?>
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

</div>
<div class='middle'>
<div class='container'> 
  <?php
  if(isset($_SESSION['CEMA_Email'])){
    echo "<br/><p style='color:red;font-weight:bold;'>Email sent to ".$_SESSION['CEMA_Email']."</p><br/>";
    $_SESSION['CEMA_Email']=null;
  }
  
  ?>
<p STYLE= margin-left:15px;font-family:arial;color:grey;font-size:30px;">New York Fee Calculator
<br/>
  <br/>
  <form name="CALC" method="post" action="CEMA_results.php" onsubmit="return ValidateCEMA()" >
  <table STYLE=margin-left:15px width="700" border="0" cellspacing="2" cellpadding="10" >
  <tr><td><b>County:</b></td>
  <td><select name="county" id="county" onchange= "fetchtownships(this.value,'NY')">
   <!-- <option value='albany' <?php if($_SESSION['county']=='albany'){echo 'SELECTED';}?>>Albany</option>
    <option value='allegheny' <?php if($_SESSION['county']=='allegheny'){echo 'SELECTED';}?>>Allegheny</option>
    <option value='bronx' <?php if($_SESSION['county']=='bronx'){echo 'SELECTED';}?>>Bronx</option>
    <option value='broome' <?php if($_SESSION['county']=='broome'){echo 'SELECTED';}?>>Broome</option>
    <option value='cattaraugus' <?php if($_SESSION['county']=='cattaraugus'){echo 'SELECTED';}?>>Cattaraugus</option>
    <option value='cayuga' <?php if($_SESSION['county']=='cayuga'){echo 'SELECTED';}?>>Cayuga</option>
    <option value='chautauqua' <?php if($_SESSION['county']=='chautauqua'){echo 'SELECTED';}?>>Chautauqua</option>
    <option value='chemung' <?php if($_SESSION['county']=='chemung'){echo 'SELECTED';}?>>Chemung</option>
    <option value='chenango' <?php if($_SESSION['county']=='chenango'){echo 'SELECTED';}?>>Chenango</option>
    <option value='clinton' <?php if($_SESSION['county']=='clinton'){echo 'SELECTED';}?>>Clinton</option>
    <option value='columbia' <?php if($_SESSION['county']=='columbia'){echo 'SELECTED';}?>>Columbia</option>
    <option value='cortland' <?php if($_SESSION['county']=='cortland'){echo 'SELECTED';}?>>Cortland</option>
    <option value='delaware' <?php if($_SESSION['county']=='delaware'){echo 'SELECTED';}?>>Delaware</option>
    <option value='dutchess' <?php if($_SESSION['county']=='dutchess'){echo 'SELECTED';}?>>Dutchess</option>
    <option value='erie' <?php if($_SESSION['county']=='erie'){echo 'SELECTED';}?>>Erie</option>
    <option value='essex' <?php if($_SESSION['county']=='essex'){echo 'SELECTED';}?>>Essex</option>
    <option value='franklin' <?php if($_SESSION['county']=='franklin'){echo 'SELECTED';}?>>Franklin</option>
    <option value='fulton' <?php if($_SESSION['county']=='fulton'){echo 'SELECTED';}?>>Fulton</option>
    <option value='genesee' <?php if($_SESSION['county']=='genesee'){echo 'SELECTED';}?>>Genesee</option>
    <option value='greene' <?php if($_SESSION['county']=='greene'){echo 'SELECTED';}?>>Greene</option>
    <option value='hamilton' <?php if($_SESSION['county']=='hamilton'){echo 'SELECTED';}?>>Hamilton</option>
    <option value='herkimer' <?php if($_SESSION['county']=='herkimer'){echo 'SELECTED';}?>>Herkimer</option>
    <option value='jefferson' <?php if($_SESSION['county']=='jefferson'){echo 'SELECTED';}?>>Jefferson</option>
    <option value='kings' <?php if($_SESSION['county']=='kings'){echo 'SELECTED';}?>>Kings</option>
    <option value='lewis' <?php if($_SESSION['county']=='lewis'){echo 'SELECTED';}?>>Lewis</option>
    <option value='livingston' <?php if($_SESSION['county']=='livingston'){echo 'SELECTED';}?>>Livingston</option>
    <option value='lowerwestchester' <?php if($_SESSION['county']=='lowerwestchester'){echo 'SELECTED';}?>>Lower Westchester</option>
    <option value='madison' <?php if($_SESSION['county']=='madison'){echo 'SELECTED';}?>>Madison</option>
    <option value='monroe' <?php if($_SESSION['county']=='monroe'){echo 'SELECTED';}?>>Monroe</option>
    <option value='montgomery' <?php if($_SESSION['county']=='montgomery'){echo 'SELECTED';}?>>Montgomery</option>
    <option value='nassau' <?php if($_SESSION['county']=='nassau'){echo 'SELECTED';}?>>Nassau</option>
    <option value='newyork' <?php if($_SESSION['county']=='newyork'){echo 'SELECTED';}?>>New York</option>
    <option value='niagara' <?php if($_SESSION['county']=='niagara'){echo 'SELECTED';}?>>Niagara</option>
    <option value='oneida' <?php if($_SESSION['county']=='oneida'){echo 'SELECTED';}?>>Oneida</option>
    <option value='onondaga' <?php if($_SESSION['county']=='onondaga'){echo 'SELECTED';}?>>Onondaga</option>
    <option value='ontario' <?php if($_SESSION['county']=='ontario'){echo 'SELECTED';}?>>Ontario</option>
    <option value='orange' <?php if($_SESSION['county']=='orange'){echo 'SELECTED';}?>>Orange</option>
    <option value='orleans' <?php if($_SESSION['county']=='orleans'){echo 'SELECTED';}?>>Orleans</option>
    <option value='oswego' <?php if($_SESSION['county']=='oswego'){echo 'SELECTED';}?>>Oswego</option>
    <option value='otsego' <?php if($_SESSION['county']=='otsego'){echo 'SELECTED';}?>>Otsego</option>
    <option value='putnam' <?php if($_SESSION['county']=='putnam'){echo 'SELECTED';}?>>Putnam</option>
    <option value='queens' <?php if($_SESSION['county']=='queens'){echo 'SELECTED';}?>>Queens</option>
    <option value='rensselaer' <?php if($_SESSION['county']=='rensselaer'){echo 'SELECTED';}?>>Rensselaer</option>
    <option value='richmond' <?php if($_SESSION['county']=='richmond'){echo 'SELECTED';}?>>Richmond</option>
    <option value='rockland' <?php if($_SESSION['county']=='rockland'){echo 'SELECTED';}?>>Rockland</option>
    <option value='stlawrence' <?php if($_SESSION['county']=='stlawrence'){echo 'SELECTED';}?>>St. Lawrence</option>
    <option value='saratoga' <?php if($_SESSION['county']=='saratoga'){echo 'SELECTED';}?>>Saratoga</option>
    <option value='schenectady' <?php if($_SESSION['county']=='schenectady'){echo 'SELECTED';}?>>Schenectady</option>
    <option value='schoharie' <?php if($_SESSION['county']=='schoharie'){echo 'SELECTED';}?>>Schoharie</option>
    <option value='schuyler' <?php if($_SESSION['county']=='schuyler'){echo 'SELECTED';}?>>Schuyler</option>
    <option value='seneca' <?php if($_SESSION['county']=='seneca'){echo 'SELECTED';}?>>Seneca</option>
    <option value='steuben' <?php if($_SESSION['county']=='steuben'){echo 'SELECTED';}?>>Steuben</option>
    <option value='suffolk' <?php if($_SESSION['county']=='suffolk'){echo 'SELECTED';}?>>Suffolk</option>
    <option value='sullivan' <?php if($_SESSION['county']=='sullivan'){echo 'SELECTED';}?>>Sullivan</option>
    <option value='tioga' <?php if($_SESSION['county']=='tioga'){echo 'SELECTED';}?>>Tioga</option>
    <option value='tompkins' <?php if($_SESSION['county']=='tompkins'){echo 'SELECTED';}?>>Tompkins</option>
    <option value='ulster' <?php if($_SESSION['county']=='ulster'){echo 'SELECTED';}?>>Ulster</option>
    <option value='warren' <?php if($_SESSION['county']=='warren'){echo 'SELECTED';}?>>Warren</option>
    <option value='washington' <?php if($_SESSION['county']=='washington'){echo 'SELECTED';}?>>Washington</option>
    <option value='wayne' <?php if($_SESSION['county']=='wayne'){echo 'SELECTED';}?>>Wayne</option>
    <option value='westchester' <?php if($_SESSION['county']=='westchester'){echo 'SELECTED';}?>>Westchester</option>
    <option value='wyoming' <?php if($_SESSION['county']=='wyoming'){echo 'SELECTED';}?>>Wyoming</option>
    <option value='yates' <?php if($_SESSION['county']=='yates'){echo 'SELECTED';}?>>Yates</option>-->
    </select></td>
	<td><b>Township:</b></td><td> <select name="township" id="township" >
	 <option value="NA">Please select a township</option> 
	</select></td></tr>
	<tr><td><b>Insurance Type:</b></td><td><select name="InsuranceType" id="InsuranceType" onchange= inputSwitch()>
        <option value="Refinance" <?php if($_SESSION['InsuranceType']=='Refinance'){echo "selected";}?>>Refinance (No CEMA)</option>
        <option value="Refinance_CEMA" <?php if($_SESSION['InsuranceType']=='Refinance_CEMA'){echo "selected";}?>>Refinance (CEMA)</option>
        <option value="Purchase" <?php if($_SESSION['InsuranceType']=='Purchase'){echo "selected";}?>>Mortgage and Fee (Purchase)</option>
        <option value="Fee Insurance" <?php if($_SESSION['InsuranceType']=='Fee Insurance'){echo "selected";}?>>Fee (Owner's) Insurance</option>
        </select></td>
          
        <td colspan='2'><input type="checkbox" id="TitleOrderOnly" name="TitleOrderOnly" >Title Order Only</td></tr>
        <tr><td colspan='4'>&nbsp;</td></tr>
        <tr><td>
        <input type="text" name="salespricetext" style="background-color:transparent;font-weight:bold;border: none;" size=20 value="Fee Amount:" readonly>
        </td>
          
          
        <td><input type="text" name="purchase_price" size=20 value="<?= max(0,$_SESSION['purchase_price']) ?>" />
        <img src='Images/info.jpg' name="salespriceimage" width='15' height='15' style="float:top;"  title="This is the purchase price" href='#' >
        </td>
        <td colspan='2'></td></tr>
        
        <tr><td><input type="text" name="mortgagetext" style="background-color:transparent;font-weight:bold;border: none;" size=20 value="Mortgage Amount" readonly seamless></td>
        <td><input type="text" name="loan_amount" size=20 value="<?= max(0,$_SESSION['loan_amount']) ?>" >
        <img src='Images/info.jpg' name="mortgageimage" width='15' height='15' style="float:top;"  title="This is the new loan amount" href='#' >  
        </td><td colspan='2'>
        </td></tr>
         
        <tr><td><input type="text" name="insurancetext" style="background-color:transparent;font-weight:bold;border: none;" size=20 value="Prior Insurance" readonly seamless></td>
        <td><input type="text" name="prior_insurance" size=20 value="<?= max(0,$_SESSION['PriorInsurance']) ?>" >
        <img src='Images/info.jpg' name="insuranceimage" width='15' height='15' style="float:top;"  title="This is the original purchase price or face value of current loan" href='#' >
        </td>
        <td colspan='2'></td></tr>
         
        <tr><td><input type="text" name="Principalbalancetext" style="background-color:transparent;font-weight:bold;border: none;" size=20 value="Principal Balance" readonly seamless>
        <td><input type="text" name="Principalbalance" size=20 value="<?= max(0,$_SESSION['PrincipalBalance']) ?>"  >
        <img src='Images/info.jpg' name="Principalbalanceimage" width='15' height='15' style="float:top;"  title="This is the current Principal Balance" href='#'>
        </td>
        <td colspan='2'></td></tr>
        
        <tr><td colspan='4'>&nbsp;</td></tr>
        <tr><td><b>Property Type:</b></td><td><select name="PropertyType" id="PropertyType">
	<option value="1-2 Family" <?php if($_SESSION['PropertyType']=="1-2 Family"){echo "selected";}?>>1-2 Family</option>
	<option value="3 Family" <?php if($_SESSION['PropertyType']=="3 Family"){echo "selected";}?>>3 Family</option>
	<option value="4 Family" <?php if($_SESSION['PropertyType']=="4 Family"){echo "selected";}?>>4 Family</option>
	<option value="Condo" <?php if($_SESSION['PropertyType']=="Condo"){echo "selected";}?>>Condo (Residential)</option>
	</select></td>
        <td colspan="2"></td></tr>
	<tr><td colspan="2"><input type="submit"  class="btn btn-default" name="CalculateRate" value= "Calculate Rate" /></td>
        <td colspan="2"><input type="button" name="Clear Values" value="Clear Values" onclick=ClearCEMA()  class="btn btn-default" /></td></tr>
	</table></form><br/>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</div>
        </div>

        <script>
      function inputSwitch(){
           switch(document.CALC.InsuranceType.value){
          case "Refinance":
            document.CALC.purchase_price.style.visibility='hidden';
            document.CALC.salespricetext.style.visibility='hidden';
            document.CALC.salespriceimage.style.visibility='hidden';            
            document.CALC.loan_amount.style.visibility='visible';
            document.CALC.mortgagetext.style.visibility='visible';
            document.CALC.mortgageimage.style.visibility='visible';
            document.CALC.prior_insurance.style.visibility='visible';
            document.CALC.insurancetext.style.visibility='visible';
            document.CALC.insuranceimage.style.visibility='visible';
            document.CALC.Principalbalance.style.visibility='hidden';
            document.CALC.Principalbalancetext.style.visibility='hidden';
            document.CALC.Principalbalanceimage.style.visibility='hidden';
            
            document.CALC.purchase_price.value = 0;
            document.CALC.Principalbalance.value = 0;
          break;


          case "Refinance_CEMA":
            document.CALC.purchase_price.style.visibility='hidden';
            document.CALC.salespricetext.style.visibility='hidden';
            document.CALC.salespriceimage.style.visibility='hidden';            
            document.CALC.loan_amount.style.visibility='visible';
            document.CALC.mortgagetext.style.visibility='visible';
            document.CALC.mortgageimage.style.visibility='visible';
            document.CALC.prior_insurance.style.visibility='visible';
            document.CALC.insurancetext.style.visibility='visible';
            document.CALC.insuranceimage.style.visibility='visible';
            document.CALC.Principalbalance.style.visibility='visible';
            document.CALC.Principalbalancetext.style.visibility='visible';
            document.CALC.Principalbalanceimage.style.visibility='visible';
            
            document.CALC.purchase_price.value = 0;
          break;
        
            case "Purchase":
            document.CALC.purchase_price.style.visibility='visible';
            document.CALC.salespricetext.style.visibility='visible';
            document.CALC.salespriceimage.style.visibility='visible';            
            document.CALC.loan_amount.style.visibility='visible';
            document.CALC.mortgagetext.style.visibility='visible';
            document.CALC.mortgageimage.style.visibility='visible';
            document.CALC.prior_insurance.style.visibility='hidden';
            document.CALC.insurancetext.style.visibility='hidden';
            document.CALC.insuranceimage.style.visibility='hidden';
            document.CALC.Principalbalance.style.visibility='hidden';
            document.CALC.Principalbalancetext.style.visibility='hidden';
            document.CALC.Principalbalanceimage.style.visibility='hidden';
            
            document.CALC.prior_insurance.value = 0;
            document.CALC.Principalbalance.value = 0;
            
          break;
        
            case "Fee Insurance":
            document.CALC.purchase_price.style.visibility='visible';
            document.CALC.salespricetext.style.visibility='visible';
            document.CALC.salespriceimage.style.visibility='visible';
            document.CALC.loan_amount.style.visibility='hidden';
            document.CALC.mortgagetext.style.visibility='hidden';
            document.CALC.mortgageimage.style.visibility='hidden';
            document.CALC.prior_insurance.style.visibility='hidden';
            document.CALC.insurancetext.style.visibility='hidden';
             document.CALC.insuranceimage.style.visibility='hidden';
            document.CALC.Principalbalance.style.visibility='hidden';
            document.CALC.Principalbalancetext.style.visibility='hidden';
            //document.CALC.Principalbalanceimage.style.visibility='hidden';
            
            document.CALC.prior_insurance.value = 0;
            document.CALC.Principalbalance.value = 0;
            document.CALC.loan_amount.value = 0;
          break;
        }
       }//end input switch
          window.onload=fetchcounties('NY');
          window.onload=inputSwitch();
        </script>
        
	<!-- End of Rate calculator -->

</body>
</html>
<?php
} else{
  
   #Implement
  $_SESSION['target']="CEMA";
  $_SESSION['lastref'] = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  
    #Implement
  if(!isset($_SESSION['lastref']))
  {
    $_SESSION['lastref']=$GLOBALS['path']."CEMA_main.php";
  }  
  
echo "<meta http-equiv='refresh' content='0;url=Login/index.php'>";
}
?>