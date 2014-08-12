<?php
header('P3P: CP="CAO PSA OUR"');
session_start();
ob_flush();
include('les_config.php');
?>

<html>
<!--#Implement-->
<head>
<title>LodeStar Home Purchase Calculator</title>

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
</head>

<!-- <body> -->
<!-- Begin get out of frame code -->
<!-- Begin Navigation Menu -->

<body style="background: #efeee9; ">

<div class="container">

  <?php
if(preg_match('/(?i)msie [7-8]/',$_SERVER['HTTP_USER_AGENT'])==1)
{
?>
<ul>
 <?php if($gfe=="1"){?><li><a href="GFE_main.php" class="navbutton">GFE</a></li><?php } ?>
 <?php if($ac=="1"){?><li><a href="AC_main.php" class="navbutton">Affordability</a></li><?php } ?>
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
    <?php if($gfe=="1"){?><li><a href="GFE_main.php">GFE</a></li><?php } ?>
    <?php if($ac=="1"){?><li><a href="AC_main.php" class="active">Affordability</a></li><?php } ?>
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

</div>

<div class='middle'>
  <div class="container">
<p STYLE= margin-left:15px;font-family:arial;color:grey;font-size:30px;text-align:center;">Home Purchase Calculator: Seller's Net Sheet
<br/><br/></p>
<?php
if(isset($_SESSION['HPCEmail'])){echo "<br/><p style=color:red;>Email sent to ".$_SESSION['Username']."</p><br/>";
$_SESSION['HPCEmail']=null;}
?>

<!-- Beginning of Rate calculator -->

<form name="HUD" action='processMonthly.php' method='post' onkeypress='keydown(window.event)'>
<table border="1" cellspacing="2" cellpadding="10" style="margin-left:auto;margin-right:auto;">
<tr><td><input type="submit" class="btn btn-default" name="EmailHUD" value="E-Mail Net Sheet" /></td>
<td><input type="submit" class="btn btn-default" name="ReviewHUD" value="Preview/Adjust HUD" /></td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>Selling Price</td><td><input type="text" size=20 name="purchase_price" value="$245,000"></td></tr>
<tr><td>Less: Existing Mortgage Pay-off</td><td><input type="text" size=20 name="mortgage_payoff"  value="$80,000"></td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td colspan="2" style='text-align: center'><b>Property Taxes</b></td></tr>
<tr><td>Less: Real Estate Taxes</td><td><input type="text" size=20 name="anntaxes"  value="$7,000"></td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td colspan='2' style='text-align: center'><b>Less: Broker Sales Commission</b></td></tr>
<tr><td>Less: Broker Sales Commission @ 6%</td><td><input type="text" size=20 name="anntaxes"  value="$14,700"></td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td colspan='2' style='text-align: center'><b>Fees</b></td></tr>
<tr><td>Less: Total Closing Fees</td><td><input type="text" size=20 name="anntaxes"  value="$1,320"></td></tr>
<tr><td>Less: Owner's Title Insurance</td><td><input type="text" size=20 name="ownerspol"  value="$976"></td></tr>
<tr><td><b>Net Seller Proceeds:</b></td><td><input type="text" size=20 name="seller_net"  value="$141,004"></td></tr>
</table>
<br/><br/>
<a href="AC_main.php"">Back to Home Purchase Calculator</a>



<!--
        <table STYLE= margin-left:15px >
          <tr><td><textarea name="tArea" id="tArea" rows='20' cols='70'></textarea></td></tr>

</table> -->


</form>
<br /><br /><br />
<!-- End of Rate calculator -->
</div>
</div>
</body>
</html>

<?php

function PrettyPrint($number){
   if(isset($number) && $number>=0){    return "$".number_format($number);}
   else {return;}
}//End PrettyPrint()

?>