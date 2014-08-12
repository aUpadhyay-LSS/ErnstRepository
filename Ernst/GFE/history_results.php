<?php
header('P3P: CP="CAO PSA OUR"');
session_start();
ob_flush();
include('les_config.php');
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
<script>
    function BackToHistory(){
        window.location = "history.php";
    }

</script>
</head>
<body style="background: #efeee9;">
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
      <li><a href="ordertitle.php">Order Title</a></li>
      <li><a href="myprofile.php">My Profile</a></li>
      <li class=active"><a href="history.php">My Searches</a></li>
      <li><a href="logout.php">Log Out</a></li>
    </ul>
  </div><!-- /.navbar-collapse -->

</nav>

<?php
}
?>

</nav>
</div>

<div class='middle'>
<div class="container">
<?php

//#Implement
//Database connection
//$username="jimboind_demo";
//$password="Test123";
//$database="jimboind_Demo";

include 'les_config.php';

$db = mysql_connect('localhost',$username,$password);
@mysql_select_db($database) or die( "Unable to select database ". mysql_error());

error_reporting(E_ALL);

if(isset($_POST['Search'])){
$_SESSION['searchtype']=$_POST['searchtype'];

switch($_POST['searchtype']){

    case 'AC':
//HPC History Search

$columns= 5;
$result = mysql_query("SELECT `Index`,`DateOfOrder`,`State`, `Buyer`, `Address` FROM `Search_History` Where SearchType='AC' AND Username='".$_SESSION['Username']."'ORDER BY DateOfOrder ".$_POST['sorttype']); // Takes in array of HPC Searches

$HeaderRow = "<form name='CALC' method='post' action='rerun_search.php'>".
"<table><tr><input type='submit' class='btn btn-default'  value= 'Re-run Quote' name='Rerun'/>&nbsp;&nbsp;&nbsp;&nbsp;</td>".
"<input type='button'  class='btn btn-default'  value= 'Back to History Search' name='Search' onClick=BackToHistory() /></td></tr></table><br/><br/>".
"<form><table border='1'><tr><td><b>Re-run Search</b></td><td><b>Date</b></td><td><b>State</b></td><td><b>Buyer</b></td><td><b>Address</b></td></tr>";

break; //End HPC re-run

case "GFE":
//GFE History Search
$columns=4;
$result = mysql_query("SELECT `Index`,`DateOfOrder`, `State`, `LoanType` FROM `Search_History` Where SearchType='GFE' AND Username='".$_SESSION['Username']."'ORDER BY DateOfOrder ".$_POST['sorttype']); // Takes in array of GFE Searches

$HeaderRow="<form name='CALC' method='post' action='rerun_search.php'>".
"<table><tr><input type='submit'  class='btn btn-default' value= 'Re-run Quote' name='Rerun'/>&nbsp;&nbsp;&nbsp;&nbsp;</td>".
"<input type='button'  class='btn btn-default'  value= 'Back to History Search' name='Search' onClick=BackToHistory() /></td></tr></table><br/><br/>".
"<table border='1'><tr><td><b>Re-run Search</b></td><td><b>Date</b></td><td><b>State</b></td><td><b>LoanType</b></td></tr>";
break;

case "NY":
//NY History Search
$columns=5;
$result = mysql_query("SELECT `Index`,`DateOfOrder`, `State`, `County`, `InsuranceType` FROM `Search_History` Where (SearchType='NY' OR SearchType='CEMA') AND Username='".$_SESSION['Username']."'ORDER BY DateOfOrder ".$_POST['sorttype']); // Takes in array of CEMA Searches

$HeaderRow="<form name='CALC' method='post' action='rerun_search.php'>".
"<table><tr><input type='submit'  class='btn btn-default'  value= 'Re-run Quote' name='Rerun'/>&nbsp;&nbsp;&nbsp;&nbsp;</td>".
"<input type='button'  class='btn btn-default'  value= 'Back to History Search' name='Search' onClick=BackToHistory() /></td></tr></table><br/><br/>".
"<table border='1'><tr><td><b>Re-run Search</b></td><td><b>Date</b></td><td><b>State</b></td><td><b>County</b></td><td><b>LoanType</b></td></tr>";
break;

case "COMM":
//GFE History Search
$columns=4;
$result = mysql_query("SELECT `Index`,`DateOfOrder`, `State`, `LoanType` FROM `Search_History` Where SearchType='COMM' AND Username='".$_SESSION['Username']."'ORDER BY DateOfOrder ".$_POST['sorttype']); // Takes in array of GFE Searches

$HeaderRow="<form name='CALC' method='post' action='rerun_search.php'>".
"<table><tr><input type='submit'  class='btn btn-default' value= 'Re-run Quote' name='Rerun'/>&nbsp;&nbsp;&nbsp;&nbsp;</td>".
"<input type='button'  class='btn btn-default'  value= 'Back to History Search' name='Search' onClick=BackToHistory() /></td></tr></table><br/><br/>".
"<table border='1'><tr><td><b>Re-run Search</b></td><td><b>Date</b></td><td><b>State</b></td><td><b>LoanType</b></td></tr>";
break;

} //end queries

$count=0;

echo $HeaderRow;

while ($row = mysql_fetch_array($result)) {
$count+=1;

echo "<tr><td><input type='checkbox' name='ReRunGFE' value= '".$row[0]."' /></td>";

//for loop starts at 1 to skip Index
for ($j=1; $j < $columns; $j++){
echo "<td>".$row[$j]."</td>";
}
echo "</tr>";
}


echo "</table></form>";

}//end History code

?>
</div></div>
</body>
</html>