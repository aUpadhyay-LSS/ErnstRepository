<?php 
header('P3P: CP="CAO PSA OUR"');
session_start();
ob_flush();
?>
<html>
<head>
<script>
<?php 

//#Implement
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
      
function fillIn(){
//alert('It works');
document.PROFILE.LoanOfficer.value = document.PROFILE.RequestedBy.value;
document.PROFILE.LoanOfficerFax.value = document.PROFILE.Fax.value;
document.PROFILE.LoanOfficerPhone.value = document.PROFILE.Phone.value;
document.PROFILE.LoanOfficerEmail.value = document.PROFILE.Email.value;
}
</script>
<title>Title Insurance Closing Packages Title Escrow Services</title>
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
<?php if($gfe=="Yes"){?><li><a href="GFE_main.php">GFE</a></li><?php } ?>
<?php if($ac=="Yes"){?><li><a href="AC_main.php">Affordability</a></li><?php } ?>
<?php if($nyc=="Yes"){?><li><a href="CEMA_main.php">New York</a></li><?php } ?>
<?php if($ctic=="Yes"){?><li><a href="COMM_main.php">Commercial</a></li><?php } ?>
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
<p STYLE= margin-left:15px;font-family:arial;color:grey;font-size:30px;">My Profile</p>
<form name="PROFILE" method="post" action="save_profile.php" > 
  <table width="575" align="center" cellpadding="0" cellspacing="3">
    <tr> 
      <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred">Name/Requested 
          By:</div></td>
      <td colspan="2"><input name="RequestedBy" type="text" class="textforms" value="<?= $array[0] ?>" size="23"></td>
    </tr>
    <tr> 
      <td bgcolor="#DDDDDD" class="textformb"><div align="right" class="textformbred">Phone:</div></td>
      <td width="186"><input name="Phone" type="text" class="textforms" size="23" value="<?= $array[1] ?>" ></td>
      <td width="213" class="textformb"><span class="textformbred">Fax:</span> 
        <input name="Fax" type="text" class="textforms" size="15" value="<?= $array[2] ?>"></td>
    </tr>
    <tr> 
      <td bgcolor="#DDDDDD" class="textformb"><div align="right">Email</div></td>
      <td colspan="2"><input name="Email" type="text" class="textforms" size="23" value="<?= $array[3] ?>"></td>
    </tr>
    <tr> 
      <td bgcolor="#DDDDDD"><div align="right">&nbsp;</div></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr> 
      <td bgcolor="#DDDDDD" class="textformb"><div align="right">Processor:</div></td>
      <td colspan="2"><input name="Processor" type="text" class="textforms" size="23" value="<?= $array[4] ?>"></td>
    </tr>
    <tr> 
      <td bgcolor="#DDDDDD" class="textformb"><div align="right">Phone:</div></td>
      <td><input name="ProcessorPhone" type="text" class="textforms" size="23" value="<?= $array[5] ?>"> 
      </td>
      <td class="textformb">Fax: 
        <input name="ProcessorFax" type="text" class="textforms" size="15" value="<?= $array[6] ?>" ></td>
    </tr>
    <tr> 
      <td bgcolor="#DDDDDD" class="textformb"><div align="right">Email</div></td>
      <td colspan="2"><input name="ProcessorEmail" type="text" class="textforms" size="23" value="<?= $array[7] ?>"></td>
    </tr>
    <tr> 
      <td bgcolor="#DDDDDD"><div align="right"></div></td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr> 
      <td bgcolor="#DDDDDD"><div align="right"></div></td>
      <td colspan="2"><input type="button"  class="btn btn-default"  name="CopyInfo" value="Loan Officer Information same as Requested By" onClick=fillIn() ></td>
    </tr>
    <tr><td colspan='3'>&nbsp;</td></tr>
    <tr> 
      <td bgcolor="#DDDDDD" class="textformb"><div align="right">Loan 
          Officer's Name: </div></td>
      <td colspan="2"><input name="LoanOfficer" type="text" class="textforms" size="23" value="<?= $array[8] ?>"></td>
    </tr>
    <tr> 
      <td height="24" bgcolor="#DDDDDD" class="textformb"><div align="right">Phone:</div></td>
      <td><input name="LoanOfficerPhone" type="text" class="textforms" size="23" value="<?= $array[9] ?>"></td>
      <td class="textformb">Fax: 
        <input name="LoanOfficerFax" type="text" class="textforms" size="15" value="<?= $array[11] ?>"></td>
    </tr>
    <tr> 
      <td bgcolor="#DDDDDD" class="textformb"><div align="right">Email</div></td>
      <td colspan="2"><input name="LoanOfficerEmail" type="text" class="textforms" size="23" value="<?= $array[10] ?>"></td>
    </tr>
    <tr> 
      <td colspan="3">&nbsp;</td>
    </tr>
  </table>
       
    <table align= "center">
      <tr>
      <center><input type="submit" name="command" value= "Save Changes" class="btn btn-default"   /></center>
      </tr>
    </table>
    
</form>
</div>
</div>
</body>
</html>