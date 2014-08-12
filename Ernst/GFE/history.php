<?php
header('P3P: CP="CAO PSA OUR"');
session_start();
ob_flush();
include('les_config.php');
?>
<html>
<head>
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
<!-- <link rel="stylesheet" href="AC_main.css" type="text/css" /> -->
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
     <!-- <li><a href="GFE_main.php">GFE</a></li>
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
      <li class="active"><a href="history.php">My Searches</a></li>
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
<div class='container'>
<p STYLE= margin-left:15px;font-family:arial;color:grey;font-size:30px;">My Search History</p>

<form name="CALC" method="post" action="history_results.php" >

<table class="table table-hover" >
<tr><td>Search Type:</td><td>
  <?php if($gfe=="1"){?><input type="radio" name="searchtype" value="GFE" CHECKED/> GFE &nbsp;&nbsp;<?php } ?>
  <?php if($ac=="1"){?><input type="radio" name="searchtype" value="AC" /> HPC &nbsp;&nbsp;<?php } ?>
  <?php if($nyc=="1"){?><input type="radio" name="searchtype" value="NY" /> New York &nbsp;&nbsp;<?php } ?>
  <?php if($ctic=="1"){?><input type="radio" name="searchtype" value="COMM" /> Commercial<?php } ?>
</td></tr>
<tr><td>Sort By:</td><td>
  <input type="radio" name="sorttype" value="DESC" CHECKED/> Newest &nbsp;
  <input type="radio" name="sorttype" value="ASC" /> Oldest &nbsp;
</td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr><td><input type="submit" class="btn btn-default"  value= "Search" name="Search"/></td></tr>
</table>
</form>
</div>
</div>
</body>
</html>