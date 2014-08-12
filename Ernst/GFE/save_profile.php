<?php
header('P3P: CP="CAO PSA OUR"');
session_start();
ob_flush();


// #Implement

//$username="jimboind_demo";
//$password="Test123";
//$database="jimboind_Demo";

include ('les_config.php');

$db = mysql_connect('localhost',$username,$password);
@mysql_select_db($database) or die( "Unable to select database ". mysql_error());

error_reporting(E_ALL);



$checkusername = mysql_query("SELECT * FROM TitleOrderProfile WHERE Username = '".$_SESSION['Username']."'");

if(mysql_num_rows($checkusername) == 1)
{

$query = "UPDATE `TitleOrderProfile` SET `RequestedBy`='".$_POST['RequestedBy']."',`Phone`='".$_POST['Phone']."',`Fax`='".$_POST['Fax']."',`Email`='".$_POST['Email'];
$query = $query."',`Processor`='".$_POST['Processor']."',`ProcessorPhone`='".$_POST['ProcessorPhone']."',`ProcessorEmail`='".$_POST['ProcessorEmail']."',`ProcessorFax`='".$_POST['ProcessorFax']."',`LO_Name`='".$_POST['LoanOfficer'];
$query = $query."',`LO_Phone`='".$_POST['LoanOfficerPhone']."',`LO_Email`='".$_POST['LoanOfficerEmail']."',`LO_Fax`='".$_POST['LoanOfficerFax']."' WHERE Username='".$_SESSION['Username']."'";

mysql_query($query);
}

else  {
$query="INSERT into `TitleOrderProfile` (`Username`,`RequestedBy`,`Phone`,`Fax`,`Email`,`Processor`,`ProcessorPhone`,`ProcessorFax`,`ProcessorEmail`,`LO_Name`,`LO_Phone`,`LO_Email`,`LO_Fax`) ";
$query= $query."VALUES('".$_SESSION['Username']."','".$_POST['RequestedBy']."','".$_POST['Phone']."','".$_POST['Fax']."','";
$query= $query.$_POST['Email']."','".$_POST['Processor']."','".$_POST['ProcessorPhone']."','".$_POST['ProcessorFax']."','";
$query = $query.$_POST['ProcessorEmail']."','".$_POST['LoanOfficer']."','".$_POST['LoanOfficerPhone']."','".$_POST['LoanOfficerEmail']."','".$_POST['LoanOfficerFax']."');";
mysql_query($query);
     }




?>
<html>
<head>

<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
<!-- <link rel="stylesheet" href="AC_main.css" type="text/css" /> -->
<meta charset="utf-8" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
</head>
<body>
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
      <li class="active"><a href="myprofile.php">My Profile</a></li>
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
  <br/><br/><br/>
    <p STYLE= margin-left:15px;font-family:arial;color:grey;font-size:20px;">Your profile information has been successfully saved</p>
</div>
</div>
</body>
</html>
