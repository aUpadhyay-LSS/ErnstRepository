<?php
header('P3P: CP="CAO PSA OUR"');
session_start();

error_reporting(E_ALL ^ E_NOTICE);
include('les_config.php');

?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>LodeStar Interactive HUD</title>

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />

    <!--   <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Loading Bootstrap -->
      <!-- load grid -->
      <link href="css/grid.css" rel="stylesheet">
      <!-- load lodestar.css -->
      <link href="css/lodestar.css" rel="stylesheet">
      <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .container-non-responsive
      {
        /* Margin/padding copied from Bootstrap */
        margin-left: auto;
        margin-right: auto;
        padding-left: 15px;
        padding-right: 15px;

        /* Set width to your desired site width */
        width: 950px;
      }
    </style>
  </head>
  <body>
<?php
if($_SESSION['Old_URL']=="HPC"){
?>
<div class="container">

  <?php
if(preg_match('/(?i)msie [7-8]/',$_SERVER['HTTP_USER_AGENT'])==1)
{
?>
<ul>
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
    <a class="navbar-brand" href="http://lssoftwaresolutions.com/" target="_blank"><img class="img-responsive" src="./Images/lode_star_logo.png" style="height:50px;widht:102px" alt="Responsive image"></a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
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

</div>
<?php
}
?>
    <div class="container-non-responsive">
    <?php
        if(isset($_SESSION['EmailHUD'])){
	  echo "<br/><p style=color:red;>Email sent to ".$_SESSION['Username']."</p><br/>";
	  $_SESSION['EmailHUD']=null;
	}
    ?>

       <h1 align="center">A. Settlement Statement (HUD-1)</h1>


    <br/>

    <form name="HUD" action='processHUD.php' method='post' onkeypress='keydown(window.event)'>
         	<div class='row'>
   	<div class="btn-group">
  		<input type="submit" class="btn btn-default" name="EmailHUD" value="E-Mail HUD" />
  		<input type="submit" class="btn btn-default" name="DownloadHUD" value="Download HUD" />
	</div>
	</div>

    <br/>
    <div class="row">
    		<div class='col-xs-12' id="black-background"><div id="white-font">B.Type of Loan</div></div>
    </div><br/>
    <!-- row 1-->
    <div class='row'>
    	<div class='col-xs-5' id='white-background' style='padding-bottom:2px'>
    	<div class='row'>
    	<div class='col-xs-4'><label>1.</label>
    	<label>
  		<input type="radio" name='row[1]'  value='FHA'>
  		FHA
			</label>
			</div>
			<div class='col-xs-3'><label>2.</label>
    	<label>
  		<input type="radio" name="row[1]" value='RHS'>
  		RHS
			</label>
			</div>
			<div class='col-xs-5'><label>3.</label>
    	<label>
  		<input type="radio" name="row[1]" value='CONVUNIN'>
  		Conv. Unins.
			</label>
			</div>
			</div>

			<div class='row'>
			<div class='col-xs-4'><label>4.</label>
    	<label>
  		<input type="radio" name="row[1]" value='VA'>
  		VA
			</label>
			</div>
			<div class='col-xs-4'><label>5.</label>
    	<label>
  		<input type="radio" name="row[1]" value='CONVINS'>
  		Conv. Ins.
			</label>
			</div>
			</div>
    	</div>
    <div class='col-xs-2' id='white-background'>
    <div class='row'>
    <div class='col-xs-12'><label>6.File Number:</label></div>
    </div>
    <div class='row'>
    <div class='col-xs-12' id='input-area'><input  style='' type="text" name='row[2]'class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][2] ?>" /></div>
    </div>
    </div>

    <div class='col-xs-2'id='white-background'>
    <div class='row'>
    <div class='col-xs-12'><label>7.Loan Number:</label></div>
    </div>
    <div class='row'>
    <div class='col-xs-12'id='input-area'><input type="text" name='row[3]'class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][3] ?>" /></div>
    </div>
    </div>
    <div class='col-xs-3' id='white-background' style=''>
    <div class='row'>
    <div class='col-xs-12'><label>8.Mortgage Insurance Case Number:</label></div>
    </div>
    <div class='row'>
    <div class='col-xs-12'id='input-area'><input type="text" name='row[4]' class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][4] ?>"/></div>
    </div>
    </div>
    </div>

    <!-- row 2 -->
    <div class='row'>
			<div id='white-background'class='col-xs-12'>
			<div class='row'>
			<div class='col-xs-1'><label><strong>C. Note:</strong></label></div>
			<div class='col-xs-11'><label>This form is furnished to give you a statement of actual settlement costs. Amounts paid to and by the settlement agent are shown. Items marked
“(p.o.c.)” were paid outside the closing; they are shown here for informational purposes and are not included in the totals.</label></div>
			</div>
			</div>
			</div>

			<!-- row 3 -->
			<div class='row'>
			<div class='col-xs-5' id='white-background'>
			<div class='col-xs-12'><label>D.Name & Address of Borrower:</label></div>
			<div class='col-xs-12' id='input-area'><input type="text" class="form-control"style="height:80px" name='row[5]'value="<?= $_SESSION['row'][5]?>"></div>
			</div>
			<div class='col-xs-4' id='white-background'>
			<div class='col-xs-12'><label>E. Name & Address of Seller: </label></div>
			<div class='col-xs-12' id='input-area'><input type="text" class="form-control"style="height:80px" name='row[6]'value="<?= $_SESSION['row'][6]?>"></div>
			</div>
			<div class='col-xs-3' id='white-background'>
			<div class='col-xs-12'><label>F. Name & Address of Lender:</label></div>
			<div class='col-xs-12' id='input-area'><input type="text" class="form-control"style="height:80px" name='row[7]'value="<?= $_SESSION['row'][7]?>"></div>
			</div>
    </div>

    <!-- row 4 -->
    <div class='row'>
			<div class='col-xs-5' id='white-background'>
			<div class='col-xs-12'><label>G. Property Location: </label></div>
			<div class='col-xs-12' id='input-area' style='padding-bottom:17px'><input type="text" class="form-control"style="height:76px" name='row[8]'value="<?= $_SESSION['row'][8]?>"></div>
			</div>
			<div class='col-xs-4' id='white-background'>
			<div class='col-xs-12'><label>H. Settlement Agent: </label></div>
			<div class='col-xs-12' id='input-area'><input type="text" class="form-control input-hug" name='row[9]' value="<?= $_SESSION['row'][9] ?>" placeholder="" /></div>
			<div class='col-xs-12'><label>Place of Settlement:</label></div>
			<div class='col-xs-12' id='input-area'><input type="text" class="form-control input-hug" name='row[10]' value="<?= $_SESSION['row'][10] ?>" placeholder="" /></div>
			</div>
			<div class='col-xs-3' id='white-background'>
			<div class='col-xs-12'><label>I. Settlement Date:</label></div>
			<div class='col-xs-12' id='input-area' style='padding-bottom:60px;'><input type="text" id="date11"name='row[11]' value="<?= $_SESSION['row'][11] ?>" class="form-control input-hug datepicker" placeholder="" /></div>
			</div>
  		</div>

  		<!-- row 5 -->
  		<br/>
  		<div class='row'>
  		<div class='col-xs-6' id='black-background'>
  		<div id="white-font">J. Summary of Borrower’s Transaction </div>
  		</div>
  		<div class='col-xs-6' id='black-background'>
  		<div id="white-font">K. Summary of Seller’s Transaction</div>
  		</div>
  		</div>

  		<!-- row 6 -->
  		<br/>
  		<div class='row'>
  		<div class='col-xs-6' id='gray-background'>
  		<div id="bigger-text">100. Gross Amount Due from Borrower  </div>
  		</div>
  		<div class='col-xs-6' id='gray-background'>
  		<div id="bigger-text">400. Gross Amount Due to Seller</div>
  		</div>
  		</div>

  		<!-- row 101 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='form-div'><div>101. Contract sales price </div></div>
  		<div class='col-xs-4' id='input-area'><input type="text" class="form-control input-hug" placeholder="" id='currency' name='row[12]' value="<?= $_SESSION['row'][12] ?>" /></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='form-div'><div>401. Contract sales price </div></div>
  		<div class='col-xs-4' id='input-area'><input type="text" class="form-control input-hug" name='row[13]'id='currency' value="<?= $_SESSION['row'][13] ?>" placeholder="" /></div>
  		</div>
  		</div>

  		<!-- row 102 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='form-div'><div>102. Personal property </div></div>
  		<div class='col-xs-4' id='input-area'><input type="text" class="form-control input-hug" name='row[14]' id='currency'value="<?= $_SESSION['row'][14] ?>" placeholder="" /></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='form-div'><div>402. Personal property </div></div>
  		<div class='col-xs-4' id='input-area'><input type="text" class="form-control input-hug" name='row[15]'id='currency'placeholder="" value="<?= $_SESSION['row'][15] ?>" /></div>
  		</div>
  		</div>

  		<!-- row 103 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='form-div'><div>103. Settlement charges to borrower (line 1400) </div></div>
  		<div class='col-xs-4' id='input-area'><input type="text" class="form-control input-hug" name='row[16]'id='currency'placeholder="" value="<?= $_SESSION['row'][16] ?>" /></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'><div class="input-group">
  		<span class="input-group-addon">403.</span>
  		<input type="text" class="form-control" placeholder=""name='row[430]'>
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text" class="form-control input-hug" name='row[17]'id='currency'placeholder="" value="<?= $_SESSION['row'][17] ?>" /></div>
  		</div>
  		</div>


  		<!-- row 104 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'><div class="input-group">
  		<span class="input-group-addon">104. </span>
  		<input type="text" class="form-control" placeholder=""name='row[431]'>
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text" class="form-control input-hug" name='row[18]' id='currency'placeholder="" value="<?= $_SESSION['row'][18] ?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'><div class="input-group">
  		<span class="input-group-addon">404.</span>
  		<input type="text" class="form-control" placeholder=""name='row[432]'>
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text" class="form-control input-hug" name='row[19]'id='currency'placeholder="" value="<?= $_SESSION['row'][19] ?>"/></div>
  		</div>
  		</div>

  		<!-- row 105 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'><div class="input-group">
  		<span class="input-group-addon">105. </span>
  		<input type="text" class="form-control" placeholder=""name='row[433]' value="<?= $_SESSION['row'][433] ?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text" class="form-control input-hug" name='row[20]'id='currency' placeholder="" value="<?= $_SESSION['row'][20] ?>" /></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'><div class="input-group">
  		<span class="input-group-addon">405.</span>
  		<input type="text" class="form-control" placeholder=""name='row[434]' value="<?= $_SESSION['row'][434] ?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text" class="form-control input-hug"name='row[21]' id='currency'value="<?= $_SESSION['row'][21]?>" placeholder="" /></div>
  		</div>
  		</div>

  		<!-- row adjust -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='form-div'><div><strong>Adjustment for items paid by seller in advance </strong></div></div>
  		<div class='col-xs-4' id='input-area'><input type="text" class="form-control input-hug" name='row[22]' readonly value="<?= $_SESSION['row'][22] ?>" placeholder="" /></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='form-div'><div><strong>Adjustment for items paid by seller in advance</strong> </div></div>
  		<div class='col-xs-4' id='input-area'><input type="text" class="form-control input-hug" name='row[23]' readonly value="<?= $_SESSION['row'][23] ?>" placeholder="" /></div>
  		</div>
  		</div>

  		<!-- row 106 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">106. City/town taxes </span>
  		<input type="text" class="form-control datepicker" placeholder="" name='row[24]'id='date24' value="<?= $_SESSION['row'][24]?>">
  		<span class="input-group-addon">to</span>
  		<input type="text" class="form-control datepicker" placeholder="" name='row[25]'id='date25' value="<?= $_SESSION['row'][25]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text" class="form-control input-hug"name='row[26]' id='currency'placeholder="" value="<?= $_SESSION['row'][26]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">406. City/town taxes </span>
  		<input type="text" class="form-control datepicker" placeholder="" name='row[27]' id='date27' value="<?= $_SESSION['row'][27]?>">
  		<span class="input-group-addon">to</span>
  		<input type="text" class="form-control datepicker" placeholder=""name='row[28]' id='date28' value="<?= $_SESSION['row'][28]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text" name='row[29]'id='currency'class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][29]?>"/></div>
  		</div>
  		</div>

  		<!-- row 107 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">107. County taxes &nbsp&nbsp</span>
  		<input type="text" class="form-control datepicker" placeholder="" name='row[30]' id='date30' value="<?= $_SESSION['row'][30]?>">
  		<span class="input-group-addon">to</span>
  		<input type="text" class="form-control datepicker" placeholder="" name='row[31]' id='date31' value="<?= $_SESSION['row'][31]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text" class="form-control input-hug" name='row[32]'id='currency' placeholder="" value="<?= $_SESSION['row'][32]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">407. County taxes &nbsp&nbsp</span>
  		<input type="text" class="form-control datepicker" placeholder="" name='row[33]' id='date33' value="<?= $_SESSION['row'][33]?>">
  		<span class="input-group-addon">to</span>
  		<input type="text" class="form-control datepicker" placeholder="" name='row[34]' id='date34' value="<?= $_SESSION['row'][34]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text" class="form-control input-hug" id='currency' name='row[35]'placeholder="" value="<?= $_SESSION['row'][35]?>" /></div>
  		</div>
  		</div>

  		<!-- row 108 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">108. Assessments  &nbsp&nbsp</span>
  		<input type="text" class="form-control datepicker" placeholder="" name='row[36]' id='date36' value="<?= $_SESSION['row'][36]?>">
  		<span class="input-group-addon">to</span>
  		<input type="text" class="form-control datepicker" placeholder="" name='row[37]' id='date37' value="<?= $_SESSION['row'][37]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text" class="form-control input-hug" id='currency' name='row[38]' placeholder="" value="<?= $_SESSION['row'][38]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">408. Assessments  &nbsp&nbsp</span>
  		<input type="text" class="form-control datepicker" placeholder="" name='row[39]' id='date39' value="<?= $_SESSION['row'][39]?>">
  		<span class="input-group-addon">to</span>
  		<input type="text" class="form-control datepicker" placeholder="" name='row[40]' id='date40' value="<?= $_SESSION['row'][40]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text" class="form-control input-hug" name='row[41]'id='currency' placeholder="" value="<?= $_SESSION['row'][41]?>"/></div>
  		</div>
  		</div>

  		<!-- row 109 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'><div class="input-group">
  		<span class="input-group-addon">109. </span>
  		<input type="text" class="form-control" placeholder="" name='row[42]' value="<?= $_SESSION['row'][42]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text" class="form-control input-hug" name='row[43]'id='currency' placeholder="" value="<?= $_SESSION['row'][43]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'><div class="input-group">
  		<span class="input-group-addon">409.</span>
  		<input type="text" class="form-control" placeholder="" name='row[44]' value="<?= $_SESSION['row'][44]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text" name='row[45]'id='currency' class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][45]?>"/></div>
  		</div>
  		</div>

  		<!-- row 110 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'><div class="input-group">
  		<span class="input-group-addon">110. </span>
  		<input type="text" class="form-control" placeholder="" name='row[46]' value="<?= $_SESSION['row'][46]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text"  name='row[47]'id='currency'class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][47]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'><div class="input-group">
  		<span class="input-group-addon">410.</span>
  		<input type="text" class="form-control" placeholder="" name='row[48]' value="<?= $_SESSION['row'][48]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text"  name='row[49]'id='currency'class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][49]?>"/></div>
  		</div>
  		</div>

  		<!-- row 111 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">111. </span>
  		<input type="text" class="form-control" placeholder="" name='row[50]' value="<?= $_SESSION['row'][50]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text" name='row[51]'id='currency'class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][51]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'><div class="input-group">
  		<span class="input-group-addon">411.</span>
  		<input type="text" class="form-control" placeholder="" name='row[52]' value="<?= $_SESSION['row'][52]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input name='row[53]'type="text" id='currency'class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][53]?>"/></div>
  		</div>
  		</div>

  		<!-- row 112 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">112. </span>
  		<input type="text" class="form-control" placeholder="" name='row[54]' value="<?= $_SESSION['row'][54]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text"  name='row[55]'id='currency'class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][55]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'><div class="input-group">
  		<span class="input-group-addon">412.</span>
  		<input type="text" class="form-control" placeholder="" name='row[56]' value="<?= $_SESSION['row'][56]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text"  name='row[57]'id='currency'class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][57]?>"/></div>
  		</div>
  		</div>


  		<!-- 120 Gross  -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='form-div'><div><strong>120. Gross Amount Due from Borrower  </strong></div></div>
  		<div class='col-xs-4' id='input-area'><input  name='row[58]'id='currency'type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][58]?>" /></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='form-div'><div><strong>420. Gross Amount Due to Seller </strong> </div></div>
  		<div class='col-xs-4' id='input-area'><input name='row[59]'id='currency'type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][59]?>"/></div>
  		</div>
  		</div>

  		<!--200 amount -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='form-div'><div><strong>200. Amount Paid by or in Behalf of Borrower </strong></div></div>
  		<div class='col-xs-4' id='input-area'><input type="text" name='row[60]' readonly class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][60]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='form-div'><div><strong>500. Reductions in Amount Due to Seller </strong> </div></div>
  		<div class='col-xs-4' id='input-area'><input type="text"name='row[61]' readonly class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][61]?>"/></div>
  		</div>
  		</div>

  		<!-- Deposit or earnest money  -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='form-div'><div>201. Deposit or earnest money </div></div>
  		<div class='col-xs-4' id='input-area'><input type="text"  name='row[62]'id='currency'class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][62]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='form-div'><div>501. Excess deposit (see instructions)</div></div>
  		<div class='col-xs-4' id='input-area'><input type="text" name='row[63]'id='currency'class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][63]?>"/></div>
  		</div>
  		</div>

  		<!-- 202. Principal amount of new loan(s)  -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='form-div'><div>202. Principal amount of new loan(s) </div></div>
  		<div class='col-xs-4' id='input-area'><input type="text"name='row[64]'id='currency' class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][64]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='form-div'><div>502. Settlement charges to seller (line 1400)</div></div>
  		<div class='col-xs-4' id='input-area'><input type="text"name='row[65]' id='currency'class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][65]?>"/></div>
  		</div>
  		</div>

  		<!--  203. Existing loan(s) taken subject to -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='form-div'><div>203. Existing loan(s) taken subject to </div></div>
  		<div class='col-xs-4' id='input-area'><input type="text"name='row[66]' id='currency'class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][66]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='form-div'><div>503. Existing loan(s) taken subject to</div></div>
  		<div class='col-xs-4' id='input-area'><input type="text" name='row[67]'id='currency'class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][67]?>"/></div>
  		</div>
  		</div>

  		<!-- row 204 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">204. </span>
  		<input type="text" class="form-control"name='row[68]' placeholder="" value="<?= $_SESSION['row'][68]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input name='row[69]'type="text" id='currency' class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][69]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='form-div'><div>504. Payoff of first mortgage loan</div></div>
  		<div class='col-xs-4' id='input-area'><input name='row[70]'type="text" id='currency' class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][70]?>"/></div>
  		</div>
  		</div>

  		<!-- row 205.  -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">205. </span>
  		<input type="text" class="form-control" placeholder=""name='row[71]' value="<?= $_SESSION['row'][71]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text" name='row[72]' id='currency'class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][72]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='form-div'><div>505. Payoff of second mortgage loan</div></div>
  		<div class='col-xs-4' id='input-area'><input type="text"name='row[73]' id='currency' class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][73]?>"/></div>
  		</div>
  		</div>

  		<!-- row 206 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">206. </span>
  		<input type="text" class="form-control" placeholder="" name='row[74]' value="<?= $_SESSION['row'][74]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input name='row[75]'type="text" id='currency' class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][75]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">506. </span>
  		<input type="text" class="form-control" placeholder=""name='row[76]' value="<?= $_SESSION['row'][76]?>">
			</div>
  		</div>
  		<div class='col-xs-4' id='input-area'><input  name='row[77]'type="text" id='currency' class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][77]?>"/></div>
  		</div>
  		</div>

  		<!-- row 207 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">207. </span>
  		<input type="text" class="form-control" placeholder="" name='row[78]' value="<?= $_SESSION['row'][78]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text" name='row[79]' id='currency'class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][79]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">507. </span>
  		<input type="text" class="form-control" placeholder="" name='row[80]' value="<?= $_SESSION['row'][80]?>">
			</div>
  		</div>
  		<div class='col-xs-4' id='input-area'><input name='row[81]' id='currency'type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][81]?>"/></div>
  		</div>
  		</div>

  		<!-- row 208 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">208. </span>
  		<input type="text" class="form-control" placeholder="" name='row[82]' value="<?= $_SESSION['row'][82]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text"name='row[83]' id='currency' class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][83]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">508. </span>
  		<input type="text" class="form-control" placeholder="" name='row[84]' value="<?= $_SESSION['row'][84]?>">
			</div>
  		</div>
  		<div class='col-xs-4' id='input-area'><input type="text" name='row[85]' id='currency' class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][85]?>"/></div>
  		</div>
  		</div>

  		<!-- row 209 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">209. </span>
  		<input type="text" class="form-control" placeholder="" name='row[86]' value="<?= $_SESSION['row'][86]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text"  name='row[87]' id='currency' class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][87]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">509. </span>
  		<input type="text" class="form-control" placeholder="" name='row[88]' value="<?= $_SESSION['row'][88]?>">
			</div>
  		</div>
  		<div class='col-xs-4' id='input-area'><input name='row[89]' id='currency' type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][89]?>"/></div>
  		</div>
  		</div>

  		<!-- Adjustments for items unpaid by seller -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='form-div'><div><strong>Adjustments for items unpaid by seller</strong></div></div>
  		<div class='col-xs-4' id='input-area'><input type="text" name='row[90]' readonly class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][90]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='form-div'><div><strong>Adjustments for items unpaid by seller</strong> </div></div>
  		<div class='col-xs-4' id='input-area'><input type="text" name='row[91]' readonly class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][91]?>"/></div>
  		</div>
  		</div>

  		<!-- row 210 -->
			<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">210. City/town taxes </span>
  		<input type="text" class="form-control datepicker" placeholder=""name='row[92]' id='date92' value="<?= $_SESSION['row'][92]?>">
  		<span class="input-group-addon">to</span>
  		<input type="text" class="form-control datepicker" placeholder=""name='row[93]' id='date93' value="<?= $_SESSION['row'][93]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text" name='row[94]' id='currency' class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][94]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">510. City/town taxes </span>
  		<input type="text" class="form-control datepicker" placeholder=""name='row[95]' id='date95' value="<?= $_SESSION['row'][95]?>">
  		<span class="input-group-addon">to</span>
  		<input type="text" class="form-control datepicker" placeholder=""name='row[96]' id='date96' value="<?= $_SESSION['row'][96]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input name='row[97]'type="text"  id='currency' class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][97]?>"/></div>
  		</div>
  		</div>

  		<!-- row 211 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">211. County taxes  </span>
  		<input type="text" class="form-control datepicker" placeholder=""name='row[98]' id='date98' value="<?= $_SESSION['row'][98]?>">
  		<span class="input-group-addon">to</span>
  		<input type="text" class="form-control datepicker" placeholder=""name='row[99]' id='date99' value="<?= $_SESSION['row'][99]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text" name='row[100]' id='currency' class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][100]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">511. County taxes  </span>
  		<input type="text" class="form-control datepicker" placeholder=""name='row[101]' id='date101' value="<?= $_SESSION['row'][101]?>">
  		<span class="input-group-addon">to</span>
  		<input type="text" class="form-control datepicker" placeholder=""name='row[102]' id='date102' value="<?= $_SESSION['row'][102]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input name='row[103]'type="text" id='currency' class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][103]?>"/></div>
  		</div>
  		</div>

  		<!-- row 212 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">212. Assessments  </span>
  		<input type="text" class="form-control datepicker" placeholder=""name='row[104]' id='date104' value="<?= $_SESSION['row'][104]?>">
  		<span class="input-group-addon">to</span>
  		<input type="text" class="form-control datepicker" placeholder=""name='row[105]' id='date105' value="<?= $_SESSION['row'][105]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text" name='row[106]' id='currency' class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][106]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">512. Assessments  </span>
  		<input type="text" class="form-control datepicker" placeholder=""name='row[107]' id='date107' value="<?= $_SESSION['row'][107]?>">
  		<span class="input-group-addon">to</span>
  		<input type="text" class="form-control datepicker" placeholder=""name='row[108]' id='date108' value="<?= $_SESSION['row'][108]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input name='row[109]' id='currency' type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][109]?>"/></div>
  		</div>
  		</div>

  		<!-- row 213 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">213. </span>
  		<input type="text" class="form-control" placeholder=""name='row[110]' value="<?= $_SESSION['row'][110]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text" name='row[111]' id='currency' class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][111]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">513. </span>
  		<input type="text" class="form-control" placeholder=""name='row[112]' value="<?= $_SESSION['row'][112]?>">
			</div>
  		</div>
  		<div class='col-xs-4' id='input-area'><input name='row[113]' id='currency' type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][113]?>"/></div>
  		</div>
  		</div>

  		<!-- row 214 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">214. </span>
  		<input type="text" class="form-control" placeholder=""name='row[114]' value="<?= $_SESSION['row'][114]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input name='row[115]'id='currency' type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][115]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">514. </span>
  		<input type="text" class="form-control" placeholder="" name='row[116]' value="<?= $_SESSION['row'][116]?>">
			</div>
  		</div>
  		<div class='col-xs-4' id='input-area'><input name='row[117]' id='currency' type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][117]?>"/></div>
  		</div>
  		</div>

  		<!-- row 215 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">215. </span>
  		<input type="text" class="form-control" placeholder=""name='row[118]' value="<?= $_SESSION['row'][118]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input name='row[119]' id='currency' type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][119]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">515. </span>
  		<input type="text" class="form-control" placeholder=""name='row[120]' value="<?= $_SESSION['row'][120]?>">
			</div>
  		</div>
  		<div class='col-xs-4' id='input-area'><input type="text" name='row[121]' id='currency' class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][121]?>"/></div>
  		</div>
  		</div>

  		<!-- row 216 -->
			<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">216. </span>
  		<input type="text" class="form-control" placeholder=""name='row[122]' value="<?= $_SESSION['row'][122]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input type="text"name='row[123]' id='currency' class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][123]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">516. </span>
  		<input type="text" class="form-control" placeholder=""name='row[124]' value="<?= $_SESSION['row'][124]?>">
			</div>
  		</div>
  		<div class='col-xs-4' id='input-area'><input name='row[125]' id='currency' type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][125]?>"/></div>
  		</div>
  		</div>

  		<!-- row 217 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">217. </span>
  		<input type="text" class="form-control" placeholder=""name='row[126]' value="<?= $_SESSION['row'][126]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input name='row[127]' id='currency' type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][127]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">517. </span>
  		<input type="text" class="form-control" placeholder=""name='row[128]' value="<?= $_SESSION['row'][128]?>">
			</div>
  		</div>
  		<div class='col-xs-4' id='input-area'><input name='row[129]' id='currency' type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][129]?>"/></div>
  		</div>
  		</div>

  		<!-- row 218 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">218. </span>
  		<input type="text" class="form-control" placeholder=""name='row[130]' value="<?= $_SESSION['row'][130]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input name='row[131]' id='currency' type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][131]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">518. </span>
  		<input type="text" class="form-control" placeholder=""name='row[132]' value="<?= $_SESSION['row'][132]?>">
			</div>
  		</div>
  		<div class='col-xs-4' id='input-area'><input name='row[133]' id='currency' type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][133]?>"/></div>
  		</div>
  		</div>


  		<!-- row 219 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">219. </span>
  		<input type="text" class="form-control" placeholder=""name='row[134]' value="<?= $_SESSION['row'][134]?>">
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input name='row[135]' id='currency' type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][135]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">519. </span>
  		<input type="text" class="form-control" placeholder=""name='row[136]'value="<?= $_SESSION['row'][136]?>">
			</div>
  		</div>
  		<div class='col-xs-4' id='input-area'><input name='row[137]' id='currency' type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][137]?>"/></div>
  		</div>
  		</div>

  		<!-- row 220 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='form-div'><div><strong>220. Total Paid by/for Borrower  </strong></div></div>
  		<div class='col-xs-4' id='input-area'><input name='row[138]' id='currency' type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][138]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='form-div'><div><strong>520. Total Reduction Amount Due Seller</strong> </div></div>
  		<div class='col-xs-4' id='input-area'><input name='row[139]' id='currency' type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][139]?>"/></div>
  		</div>
  		</div>

  		<!-- row 300 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='form-div'><div><strong>300. Cash at Settlement from/to Borrower  </strong></div></div>
  		<div class='col-xs-4' id='input-area'><input name='row[140]' readonly type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][140]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='form-div'><div><strong>600. Cash at Settlement to/from Seller</strong> </div></div>
  		<div class='col-xs-4' id='input-area'><input name='row[141]' readonly type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][141]?>"/></div>
  		</div>
  		</div>

  		<!-- row 301 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='form-div'><div>301. Gross amount due from borrower (line 120) </div></div>
  		<div class='col-xs-4' id='input-area'><input name='row[142]' id='currency' type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][142]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='form-div'><div>601. Gross amount due to seller (line 420)</div></div>
  		<div class='col-xs-4' id='input-area'><input name='row[143]' id='currency' type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][143]?>"/></div>
  		</div>
  		</div>

  		<!-- row 302 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='form-div'><div>302. Less amounts paid by/for borrower (line 220) </div></div>
  		<div class='col-xs-4' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">(</span>
  		<input type="text" class="form-control input-hug" placeholder="" name='row[144]' id='currency' value="<?= $_SESSION['row'][144]?>"/>
  		<span class="input-group-addon">)</span>
  		</div>
  		</div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='form-div'><div>602. Less reductions in amounts due seller (line 520)</div></div>
  		<div class='col-xs-4' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon">(</span>
  		<input type="text" class="form-control input-hug" placeholder="" name='row[145]' id='currency' value="<?= $_SESSION['row'][145]?>"/>
  		<span class="input-group-addon">)</span>
  		</div>
  		</div>
  		</div>
  		</div>

  		<!-- row 303 -->
  		<div class='row'>
  		<div class='col-xs-6' id='white-background'>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon" id='form-div'> 303. Cash &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
  		<input type="radio"name='row[146]' id="303_from" value="From">
  		<span class="input-group-addon" id='form-div'>From &nbsp&nbsp&nbsp&nbsp&nbsp</span>
  		<input type="radio"name='row[146]' id="303_to" value="To">
  		<span class="input-group-addon" id='form-div'>To Borrower &nbsp&nbsp&nbsp</span>
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input name='row[148]' id='currency' type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][148]?>"/></div>
  		</div>
  		<div class='col-xs-6' id='white-background' style=''>
  		<div class='col-xs-8' id='input-area'>
  		<div class="input-group">
  		<span class="input-group-addon" id='form-div'> 603. Cash &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
  		<input type="radio"name='row[149]' id="603_tos" value="ToS">
  		<span class="input-group-addon" id='form-div'>To &nbsp&nbsp&nbsp&nbsp&nbsp</span>
  		<input type="radio"name='row[149]' id="603_froms"value="FromS">
  		<span class="input-group-addon" id='form-div'>From Seller &nbsp&nbsp&nbsp</span>
			</div>
			</div>
  		<div class='col-xs-4' id='input-area'><input name='row[151]' id='currency' type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][151]?>"/></div>
  		</div>
  		</div>

  		<!-- Note -->
			<br/>
			<div class='row'>
			<div>The Public Reporting Burden for this collection of information is estimated at 35 minutes per response for collecting, reviewing, and reporting the data. This agency may not
collect this information, and you are not required to complete this form, unless it displays a currently valid OMB control number. No confidentiality is assured; this disclosure
is mandatory. This is designed to provide the parties to a RESPA covered transaction with information during the settlement process.</div>
			</div>

  		<!-- row L -->
  		<br/>
  		<div class='row'>
  		<div class='col-xs-12' id='black-background'>
  		<div id="white-font">L. Settlement Charges     </div>
  		</div>
  		</div>

  		<!-- row 700~704 -->
  		<br/>
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class='row' id='white-background'>
  		<div class='col-xs-7' style='padding-left:5px' id='form-div'><strong>700. Total Real Estate Broker Fees</strong> </div>
  		<div class='col-xs-5' id='input-area'><input name='row[152]'type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][152]?>"/></div>
  		</div>
  		<div class='row' id='white-background' style='padding-bottom:1px'>
  		<div class='col-xs-7' style='padding-left:5px' id='form-div'>Division of commission (line 700) as follows : </div>
  		<div class='col-xs-5' id='input-area'><input name='row[153]' readonly type="text" class="form-control input-hug" placeholder="" value="<?= $_SESSION['row'][153]?>"/></div>
  		</div>
  		<div class='row' id='white-background'>
  		<div class='col-xs-12'style='padding-left:5px' id='form-div'>
  		<div class="input-group">
  		<span class="input-group-addon">701. $</span>
  		<input type="text" class="form-control" placeholder=""name='row[154]' id='currency' value="<?= $_SESSION['row'][154]?>">
  		<span class="input-group-addon">to</span>
  		<input type="text" class="form-control" placeholder=""name='row[155]' id='' value="<?= $_SESSION['row'][155]?>">
			</div>
  		</div>
  		</div>
      <div class='row' id='white-background'>
      <div class='col-xs-12'style='padding-left:5px' id='form-div'>
      <div class="input-group">
      <span class="input-group-addon">702. $</span>
      <input type="text" class="form-control" placeholder=""name='row[435]' id='number' value="<?= $_SESSION['row'][435]?>">
      <span class="input-group-addon">to</span>
      <input type="text" class="form-control" placeholder=""name='row[436]' value="<?= $_SESSION['row'][436]?>">
      </div>
      </div>
      </div>
  		</div>
  		<div class='col-xs-2' id='gray-background' style='padding:56px 0px;'>
  		<div class='col-xs-12' id='form-div'style='padding-left:10px;'>
  		<div style='text-align:center'><strong>Paid From Borrower’s Funds at Settlement  </strong></div>
  		</div>
  		</div>
  		<div class='col-xs-2' id='gray-background' style='padding:56px 0px;'>
  		<div class='col-xs-12' id='form-div'style='padding-left:10px;'>
  		<div style='text-align:center'><strong>Paid From Seller’s Funds at Settlement  </strong></div>
  		</div>
  		</div>
  		</div>

  		<div class='row' id=''>
  		<div class='col-xs-8' id=''>
  		<div class='row' id='white-background'>
  		<div class='col-xs-12' style='padding-left:5px;margin-top:0px;margin-bottom:14px;' id='form-div'>703. Commission paid at settlement</div>
  		</div>
  		<div class='row' id='white-background'>
  		<div class='col-xs-12'style='padding-left:5px' id='form-div'>
  		<div class="input-group">
  		<span class="input-group-addon" style='margin-bottom:-10px;'>704.</span>
  		<input type="text" class="form-control" placeholder=""name='row[156]' value="<?= $_SESSION['row'][156]?>">
			</div>
  		</div>
  		</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<div class='col-xs-12' id='form-div'>
  		<div><input type="text" class="form-control" placeholder=""name='row[157]' id='currency' value="<?= $_SESSION['row'][157]?>"></div>
  		</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<div class='col-xs-12' id='form-div'>
  		<div ><input type="text" class="form-control" placeholder=""name='row[158]' id='currency' value="<?= $_SESSION['row'][158]?>"></div>
  		</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<div class='col-xs-12' id='form-div'>
  		<div><input type="text" style='margin-top:0px;'class="form-control" name='row[159]' id='currency' placeholder="" value="<?= $_SESSION['row'][159]?>"></div>
  		</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<div class='col-xs-12' id='form-div'>
  		<div ><input type="text" style='margin-top:0px;'class="form-control" name='row[160]' id='currency' placeholder="" value="<?= $_SESSION['row'][160]?>"></div>
  		</div>
  		</div>
  		</div>


			<!-- row 800 -->
			<br/>
			<div class='row'>
			<div class='col-xs-12'id='gray-background' style='padding:5px 15px'><div><strong>800. Items Payable in Connection with Loan</strong></div>
			</div>
			</div>

			<!-- row 801 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>

  		<div class="input-group">
  		<span class="input-group-addon">801. Our origination charge</span>
  		<input type="text" class="form-control" placeholder=""name='row[161]' value="<?= $_SESSION['row'][161]?>">
  		<span class="input-group-addon">$</span>
  		<input type="text" class="form-control" placeholder=""name='row[162]' id='currency' value="<?= $_SESSION['row'][162]?>">
  		<span class="input-group-addon">(from GFE #1)</span>
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[163]' id='currency' value="<?= $_SESSION['row'][163]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[164]' id='currency' value="<?= $_SESSION['row'][164]?>">
  		</div>
  		</div>

  		<!-- row 802 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>

  		<div class="input-group">
  		<span class="input-group-addon">802. Your credit or charge (points) for the specific interest rate chosen</span>
  		<input type="text" class="form-control" placeholder=""name='row[165]' value="<?= $_SESSION['row'][165]?>">
  		<span class="input-group-addon">$</span>
  		<input type="text" class="form-control" placeholder=""name='row[166]' id='currency' value="<?= $_SESSION['row'][166]?>">
  		<span class="input-group-addon">(from GFE #2)</span>
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[167]' id='currency' value="<?= $_SESSION['row'][167]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[168]' id='currency' value="<?= $_SESSION['row'][168]?>">
  		</div>
  		</div>

  		<!-- row 803 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>

  		<div class="input-group">
  		<span class="input-group-addon">803. Your adjusted origination charges </span>
  		<input type="text" class="form-control" placeholder=""name='row[169]' value="<?= $_SESSION['row'][169]?>">
  		<span class="input-group-addon">$</span>
  		<input type="text" class="form-control" placeholder=""name='row[170]' value="<?= $_SESSION['row'][170]?>">
  		<span class="input-group-addon">(from GFE #A)</span>
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[171]' id='currency' value="<?= $_SESSION['row'][171]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[172]' id='currency' value="<?= $_SESSION['row'][172]?>">
  		</div>
  		</div>

  		<!-- row 804 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>

  		<div class="input-group">
  		<span class="input-group-addon">804. Appraisal fee to </span>
  		<input type="text" class="form-control" placeholder=""name='row[173]' value="<?= $_SESSION['row'][173]?>">
  		<span class="input-group-addon">$</span>
  		<input type="text" class="form-control" placeholder=""name='row[174]' id='currency' value="<?= $_SESSION['row'][174]?>">
  		<span class="input-group-addon">(from GFE #3)</span>
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[175]' id='currency' value="<?= $_SESSION['row'][175]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[176]' id='currency' value="<?= $_SESSION['row'][176]?>">
  		</div>
  		</div>

  		<!-- row 805 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>

  		<div class="input-group">
  		<span class="input-group-addon">805. Credit report to </span>
  		<input type="text" class="form-control" placeholder=""name='row[177]' value="<?= $_SESSION['row'][177]?>">
  		<span class="input-group-addon">$</span>
  		<input type="text" class="form-control" placeholder=""name='row[178]' id='currency' value="<?= $_SESSION['row'][178]?>">
  		<span class="input-group-addon">(from GFE #3)</span>
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[179]' id='currency' value="<?= $_SESSION['row'][179]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[180]' id='currency' value="<?= $_SESSION['row'][180]?>">
  		</div>
  		</div>

  		<!-- row 806 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>

  		<div class="input-group">
  		<span class="input-group-addon">806. Tax service to </span>
  		<input type="text" class="form-control" placeholder=""name='row[181]' value="<?= $_SESSION['row'][181]?>">
  		<span class="input-group-addon">$</span>
  		<input type="text" class="form-control" placeholder=""name='row[182]' id='currency' value="<?= $_SESSION['row'][182]?>">
  		<span class="input-group-addon">(from GFE #3)</span>
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[183]' id='currency' value="<?= $_SESSION['row'][183]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[184]' id='currency' value="<?= $_SESSION['row'][184]?>">
  		</div>
  		</div>

  		<!-- row 807 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>

  		<div class="input-group">
  		<span class="input-group-addon">807. Flood certification to </span>
  		<input type="text" class="form-control" placeholder=""name='row[185]' value="<?= $_SESSION['row'][185]?>">
  		<span class="input-group-addon">$</span>
  		<input type="text" class="form-control" placeholder=""name='row[186]' id='currency' value="<?= $_SESSION['row'][186]?>">
  		<span class="input-group-addon">(from GFE #3)</span>
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[187]' id='currency' value="<?= $_SESSION['row'][187]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[188]' id='currency' value="<?= $_SESSION['row'][188]?>">
  		</div>
  		</div>


  		<!-- row 808 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">808.</span>
  		<input type="text" class="form-control" placeholder=""name='row[189]' value="<?= $_SESSION['row'][189]?>">
  		</div>
			</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[190]' id='currency' value="<?= $_SESSION['row'][190]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[191]' id='currency' value="<?= $_SESSION['row'][191]?>">
  		</div>
  		</div>

  		<!-- row 809 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">809.</span>
  		<input type="text" class="form-control" placeholder=""name='row[192]' value="<?= $_SESSION['row'][192]?>">
  		</div>
			</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[193]' id='currency' value="<?= $_SESSION['row'][193]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[194]' id='currency' value="<?= $_SESSION['row'][194]?>">
  		</div>
  		</div>

  		<!-- row 810 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">810.</span>
  		<input type="text" class="form-control" placeholder=""name='row[195]' value="<?= $_SESSION['row'][195]?>">
  		</div>
			</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[196]' id='currency' value="<?= $_SESSION['row'][196]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[197]' id='currency' value="<?= $_SESSION['row'][197]?>">
  		</div>
  		</div>

  		<!-- row 811 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">811.</span>
  		<input type="text" class="form-control" placeholder=""name='row[198]' value="<?= $_SESSION['row'][198]?>">
  		</div>
			</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[199]' id='currency' value="<?= $_SESSION['row'][199]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[200]' id='currency' value="<?= $_SESSION['row'][200]?>">
  		</div>
  		</div>

  		<!-- row 900 -->
			<br/>
			<div class='row'>
			<div class='col-xs-12'id='gray-background' style='padding:5px 15px'><div><strong>900. Items Required by Lender to be Paid in Advance</strong></div>
			</div>
			</div>

			<!-- row 901 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">901. Daily interest charges from</span>
  		<input type="text" class="form-control datepicker" placeholder=""name='row[201]' id='date201' value="<?= $_SESSION['row'][201]?>">
  		<span class="input-group-addon">to</span>
  		<input type="text" class="form-control datepicker" placeholder=""name='row[202]' id='date202' value="<?= $_SESSION['row'][202]?>">
  		<span class="input-group-addon">@ $</span>
  		<input type="text" class="form-control" placeholder=""name='row[203]' id='number' value="<?= $_SESSION['row'][203]?>">
  		<span class="input-group-addon">/day</span>
  		<input type="text" class="form-control" placeholder=""name='row[204]' value="<?= $_SESSION['row'][204]?>">
  		<span class="input-group-addon">(from GFE #10)</span>
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[205]' id='currency' value="<?= $_SESSION['row'][205]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[206]' id='currency' value="<?= $_SESSION['row'][206]?>">
  		</div>
  		</div>

  		<!-- row 902 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">902. Mortgage insurance premium	for</span>
  		<input type="text" class="form-control" placeholder=""name='row[207]' id='integer' value="<?= $_SESSION['row'][207]?>">
  		<span class="input-group-addon">months to</span>
  		<input type="text" class="form-control" placeholder=""name='row[208]' value="<?= $_SESSION['row'][208]?>">
  		<span class="input-group-addon">(from GFE #3)</span>
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[209]' id='currency' value="<?= $_SESSION['row'][209]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[210]' id='currency' value="<?= $_SESSION['row'][210]?>">
  		</div>
  		</div>

  		<!-- row 903 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">903. Homeowner’s insurance for</span>
  		<input type="text" class="form-control" placeholder=""name='row[211]' id='integer' value="<?= $_SESSION['row'][211]?>">
  		<span class="input-group-addon">years to</span>
  		<input type="text" class="form-control datepicker" placeholder=""name='row[212]' id='date212' value="<?= $_SESSION['row'][212]?>">
  		<span class="input-group-addon">(from GFE #11)</span>
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[213]' id='currency' value="<?= $_SESSION['row'][213]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[214]' id='currency' value="<?= $_SESSION['row'][214]?>">
  		</div>
  		</div>

  		<!-- row 904 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">904</span>
  		<input type="text" class="form-control" placeholder=""name='row[215]' value="<?= $_SESSION['row'][215]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[216]' id='currency' value="<?= $_SESSION['row'][216]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[217]' id='currency' value="<?= $_SESSION['row'][217]?>">
  		</div>
  		</div>

  		<!-- row 1000 -->
  		<br/>
			<div class='row'>
			<div class='col-xs-12'id='gray-background' style='padding:5px 15px'><div><strong>1000. Reserves Deposited with Lender</strong></div>
			</div>
			</div>

			<!-- row 1001 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1001. Initial deposit for your escrow account</span>
  		<input type="text" class="form-control" placeholder=""name='row[218]' value="<?= $_SESSION['row'][218]?>">
  		<span class="input-group-addon">(from GFE #9)</span>
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[219]' id='currency' value="<?= $_SESSION['row'][219]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[220]' id='currency' value="<?= $_SESSION['row'][220]?>">
  		</div>
  		</div>

  		<!-- row 1002 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1002. Homeowner’s insurance  </span>
  		<input type="text" class="form-control" placeholder=""name='row[221]' id='integer' value="<?= $_SESSION['row'][221]?>">
  		<span class="input-group-addon">months @ $	 </span>
  		<input type="text" class="form-control" placeholder=""name='row[222]' id='number' value="<?= $_SESSION['row'][222]?>">
  		<span class="input-group-addon">per month $</span>
  		<input type="text" class="form-control" placeholder=""name='row[223]' id='number' value="<?= $_SESSION['row'][223]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[224]' id='currency' value="<?= $_SESSION['row'][224]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[225]' id='currency' value="<?= $_SESSION['row'][225]?>">
  		</div>
  		</div>

  		<!-- row 1003 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1003. Mortgage insurance  </span>
  		<input type="text" class="form-control" placeholder=""name='row[226]' id='integer' value="<?= $_SESSION['row'][226]?>">
  		<span class="input-group-addon">months @ $	 </span>
  		<input type="text" class="form-control" placeholder=""name='row[227]' id='number' value="<?= $_SESSION['row'][227]?>">
  		<span class="input-group-addon">per month $</span>
  		<input type="text" class="form-control" placeholder=""name='row[228]' id='number' value="<?= $_SESSION['row'][228]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[229]' id='currency' value="<?= $_SESSION['row'][229]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[230]' id='currency' value="<?= $_SESSION['row'][230]?>">
  		</div>
  		</div>

  		<!-- row 1004 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1004. Property Taxes   </span>
  		<input type="text" class="form-control" placeholder=""name='row[231]' id='integer' value="<?= $_SESSION['row'][231]?>">
  		<span class="input-group-addon">months @ $	 </span>
  		<input type="text" class="form-control" placeholder=""name='row[232]' id='number' value="<?= $_SESSION['row'][232]?>">
  		<span class="input-group-addon">per month $</span>
  		<input type="text" class="form-control" placeholder=""name='row[233]' id='number' value="<?= $_SESSION['row'][233]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[234]' id='currency' value="<?= $_SESSION['row'][234]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[235]' id='currency' value="<?= $_SESSION['row'][235]?>">
  		</div>
  		</div>

  		<!-- row 1005 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1005. </span>
  		<input type="text" class="form-control" placeholder=""name='row[236]' id='integer' value="<?= $_SESSION['row'][236]?>">
  		<span class="input-group-addon">months @ $	 </span>
  		<input type="text" class="form-control" placeholder=""name='row[237]' id='number' value="<?= $_SESSION['row'][237]?>">
  		<span class="input-group-addon">per month $</span>
  		<input type="text" class="form-control" placeholder=""name='row[238]' id='number' value="<?= $_SESSION['row'][238]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[239]' id='currency' value="<?= $_SESSION['row'][239]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[240]' id='currency' value="<?= $_SESSION['row'][240]?>">
  		</div>
  		</div>

  		<!-- row 1006 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1006. </span>
  		<input type="text" class="form-control" placeholder=""name='row[241]' id='integer' value="<?= $_SESSION['row'][241]?>">
  		<span class="input-group-addon">months @ $	 </span>
  		<input type="text" class="form-control" placeholder=""name='row[242]' id='number' value="<?= $_SESSION['row'][242]?>">
  		<span class="input-group-addon">per month $</span>
  		<input type="text" class="form-control" placeholder=""name='row[243]' id='number' value="<?= $_SESSION['row'][243]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[244]' id='currency' value="<?= $_SESSION['row'][244]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[245]' id='currency' value="<?= $_SESSION['row'][245]?>">
  		</div>
  		</div>

  		<!-- row 1007 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1007. Aggregate Adjustment </span>
  		<input type="text" class="form-control" placeholder=""name='row[246]' id='currency' value="<?= $_SESSION['row'][246]?>">
  		<span class="input-group-addon">-$	 </span>
  		<input type="text" class="form-control" placeholder=""name='row[247]' id='number' value="<?= $_SESSION['row'][247]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[248]' id='currency' value="<?= $_SESSION['row'][248]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[249]' id='currency' value="<?= $_SESSION['row'][249]?>">
  		</div>
  		</div>

  		<!-- row 1100 -->
  		<br/>
			<div class='row'>
			<div class='col-xs-12'id='gray-background' style='padding:5px 15px'><div><strong>1100. Title Charges</strong></div>
			</div>
			</div>

			<!-- row 1101 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1101. Title services and lender’s title insurance </span>
  		<input type="text" class="form-control" placeholder=""name='row[250]' value="<?= $_SESSION['row'][250]?>">
  		<span class="input-group-addon">(from GFE #4) </span>
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[251]' id='currency' value="<?= $_SESSION['row'][251]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[252]' id='currency' value="<?= $_SESSION['row'][252]?>">
  		</div>
  		</div>

			<!-- row 1102 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1102. Settlement or closing fee </span>
  		<input type="text" class="form-control" placeholder=""name='row[253]' value="<?= $_SESSION['row'][253]?>">
  		<span class="input-group-addon">$ </span>
  		<input type="text" class="form-control" placeholder=""name='row[254]' id='number' value="<?= $_SESSION['row'][254]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[255]' id='currency' value="<?= $_SESSION['row'][255]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[256]' id='currency' value="<?= $_SESSION['row'][256]?>">
  		</div>
  		</div>

			<!-- row 1103 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1103. Owner’s title insurance </span>
  		<input type="text" class="form-control" placeholder=""name='row[257]' value="<?= $_SESSION['row'][257]?>">
  		<span class="input-group-addon">(from GFE #5) </span>
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[258]' id='currency' value="<?= $_SESSION['row'][258]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[259]' id='currency' value="<?= $_SESSION['row'][259]?>">
  		</div>
  		</div>

			<!-- row 1104 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1104. Lender’s title insurance</span>
  		<input type="text" class="form-control" placeholder=""name='row[260]' value="<?= $_SESSION['row'][260]?>">
  		<span class="input-group-addon">$ </span>
  		<input type="text" class="form-control" placeholder=""name='row[261]' id='number' value="<?= $_SESSION['row'][261]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[262]' id='currency' value="<?= $_SESSION['row'][262]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[263]' id='currency' value="<?= $_SESSION['row'][263]?>">
  		</div>
  		</div>

			<!-- row 1105 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1105. Lender’s title policy limit $</span>
  		<input type="text" class="form-control" placeholder=""name='row[264]' id='number' value="<?= $_SESSION['row'][264]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[265]' id='currency'value="<?= $_SESSION['row'][265]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[266]' id='currency' value="<?= $_SESSION['row'][266]?>">
  		</div>
  		</div>

			<!-- row 1106 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1106. Owner’s title policy limit $</span>
  		<input type="text" class="form-control" placeholder=""name='row[267]' id='number' value="<?= $_SESSION['row'][267]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[268]' id='currency' value="<?= $_SESSION['row'][268]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[269]' id='currency' value="<?= $_SESSION['row'][269]?>">
  		</div>
  		</div>

			<!-- row 1107 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1107. Agent’s portion of the total title insurance premium to </span>
  		<input type="text" class="form-control" placeholder=""name='row[270]' value="<?= $_SESSION['row'][270]?>">
  		<span class="input-group-addon">$ </span>
  		<input type="text" class="form-control" placeholder=""name='row[271]' id='number' value="<?= $_SESSION['row'][271]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[272]' id='currency' value="<?= $_SESSION['row'][272]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[273]' id='currency' value="<?= $_SESSION['row'][273]?>">
  		</div>
  		</div>

			<!-- row 1108 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1108. Underwriter’s portion of the total title insurance premium to </span>
  		<input type="text" class="form-control" placeholder=""name='row[274]' value="<?= $_SESSION['row'][274]?>">
  		<span class="input-group-addon">$ </span>
  		<input type="text" class="form-control" placeholder=""name='row[275]' id='number' value="<?= $_SESSION['row'][275]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[276]' id='currency' value="<?= $_SESSION['row'][276]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[277]' id='currency' value="<?= $_SESSION['row'][277]?>">
  		</div>
  		</div>

			<!-- row 1109 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1109.</span>
  		<input type="text" class="form-control" placeholder=""name='row[278]'  value="<?= $_SESSION['row'][278]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[279]' id='currency' value="<?= $_SESSION['row'][279]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[280]' id='currency' value="<?= $_SESSION['row'][280]?>">
  		</div>
  		</div>

			<!-- row 1110 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1110.</span>
  		<input type="text" class="form-control" placeholder=""name='row[281]'  value="<?= $_SESSION['row'][281]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[282]' id='currency' value="<?= $_SESSION['row'][282]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[283]' id='currency' value="<?= $_SESSION['row'][283]?>">
  		</div>
  		</div>

			<!-- row 1111 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1111.</span>
  		<input type="text" class="form-control" placeholder=""name='row[284]'  value="<?= $_SESSION['row'][284]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[285]' id='currency' value="<?= $_SESSION['row'][285]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[286]' id='currency' value="<?= $_SESSION['row'][286]?>">
  		</div>
  		</div>

			<!-- row 1200 -->
  		<br/>
			<div class='row'>
			<div class='col-xs-12'id='gray-background' style='padding:5px 15px'><div><strong>1200. Government Recording and Transfer Charges</strong></div>
			</div>
			</div>

			<!-- row 1201 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1201. Government recording charges</span>
  		<input type="text" class="form-control" placeholder=""name='row[287]' value="<?= $_SESSION['row'][287]?>">
  		<span class="input-group-addon">(from GFE #7)</span>
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[288]' id='currency' value="<?= $_SESSION['row'][288]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[289]' id='currency' value="<?= $_SESSION['row'][289]?>">
  		</div>
  		</div>

			<!-- row 1202 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1202. Deed $	</span>
  		<input type="text" class="form-control" placeholder=""name='row[290]' id='number' value="<?= $_SESSION['row'][290]?>">
  		<span class="input-group-addon">Mortgage $	</span>
  		<input type="text" class="form-control" placeholder=""name='row[291]' id='number' value="<?= $_SESSION['row'][291]?>">
  		<span class="input-group-addon">Release $	</span>
  		<input type="text" class="form-control" placeholder=""name='row[292]' id='number' value="<?= $_SESSION['row'][292]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[293]' id='currency' value="<?= $_SESSION['row'][293]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[294]' id='currency' value="<?= $_SESSION['row'][294]?>">
  		</div>
  		</div>

			<!-- row 1203 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1203. Transfer taxes	</span>
  		<input type="text" class="form-control" placeholder=""name='row[295]' value="<?= $_SESSION['row'][295]?>">
  		<span class="input-group-addon">(from GFE #8)	</span>
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[296]' id='currency' value="<?= $_SESSION['row'][296]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[297]' id='currency' value="<?= $_SESSION['row'][297]?>">
  		</div>
  		</div>

			<!-- row 1204 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1204. City/County tax/stamps	 </span>
  		<input type="text" class="form-control" placeholder=""name='row[298]' value="<?= $_SESSION['row'][298]?>">
  		<span class="input-group-addon">Deed $	 	</span>
  		<input type="text" class="form-control" placeholder=""name='row[299]' id='number' value="<?= $_SESSION['row'][299]?>">
  		<span class="input-group-addon">Mortgage $		</span>
  		<input type="text" class="form-control" placeholder=""name='row[300]' id='number' value="<?= $_SESSION['row'][300]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[301]' id='currency' value="<?= $_SESSION['row'][301]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[302]' id='currency' value="<?= $_SESSION['row'][302]?>">
  		</div>
  		</div>

			<!-- row 1205 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1205. State tax/stamps		 	 </span>
  		<input type="text" class="form-control" placeholder=""name='row[303]' value="<?= $_SESSION['row'][303]?>">
  		<span class="input-group-addon">Deed $	 	</span>
  		<input type="text" class="form-control" placeholder=""name='row[304]' id='number' value="<?= $_SESSION['row'][304]?>">
  		<span class="input-group-addon">Mortgage $		</span>
  		<input type="text" class="form-control" placeholder=""name='row[305]' id='number' value="<?= $_SESSION['row'][305]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[306]' id='currency' value="<?= $_SESSION['row'][306]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[307]' id='currency' value="<?= $_SESSION['row'][307]?>">
  		</div>
  		</div>

			<!-- row 1206 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1206.	 	 </span>
  		<input type="text" class="form-control" placeholder=""name='row[308]' value="<?= $_SESSION['row'][308]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[309]' id='currency' value="<?= $_SESSION['row'][309]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[310]' id='currency' value="<?= $_SESSION['row'][310]?>">
  		</div>
  		</div>

  		<!-- row 1300 -->
  		<br/>
			<div class='row'>
			<div class='col-xs-12'id='gray-background' style='padding:5px 15px'><div><strong>1300. Additional Settlement Charges</strong></div>
			</div>
			</div>

			<!-- row 1301 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1301. Required services that you can shop for </span>
  		<input type="text" class="form-control" placeholder=""name='row[311]'  value="<?= $_SESSION['row'][311]?>" >
  		<span class="input-group-addon">(from GFE #6) </span>
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[312]' id='currency' value="<?= $_SESSION['row'][312]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[313]' id='currency' value="<?= $_SESSION['row'][313]?>">
  		</div>
  		</div>

			<!-- row 1302 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1302. </span>
  		<input type="text" class="form-control" placeholder=""name='row[314]' value="<?= $_SESSION['row'][314]?>">
  		<span class="input-group-addon">$</span>
  		<input type="text" class="form-control" placeholder=""name='row[315]' id='number' value="<?= $_SESSION['row'][315]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[316]' id='currency' value="<?= $_SESSION['row'][316]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[317]' id='currency' value="<?= $_SESSION['row'][317]?>">
  		</div>
  		</div>

			<!-- row 1303 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1303. </span>
  		<input type="text" class="form-control" placeholder=""name='row[318]' value="<?= $_SESSION['row'][318]?>">
  		<span class="input-group-addon">$</span>
  		<input type="text" class="form-control" placeholder=""name='row[319]' id='number' value="<?= $_SESSION['row'][319]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[320]' id='currency' value="<?= $_SESSION['row'][320]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[321]' id='currency' value="<?= $_SESSION['row'][321]?>">
  		</div>
  		</div>

			<!-- row 1304 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1304. </span>
  		<input type="text" class="form-control" placeholder=""name='row[322]' value="<?= $_SESSION['row'][322]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[323]' id='currency' value="<?= $_SESSION['row'][323]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[324]' id='currency' value="<?= $_SESSION['row'][324]?>">
  		</div>
  		</div>

			<!-- row 1305 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<span class="input-group-addon">1305. </span>
  		<input type="text" class="form-control" placeholder=""name='row[325]' value="<?= $_SESSION['row'][325]?>">
			</div>
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[326]' id='currency' value="<?= $_SESSION['row'][326]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[327]' id='currency' value="<?= $_SESSION['row'][327]?>">
  		</div>
  		</div>

			<!-- row 1400 -->
			<br/>
			<div class='row'>
			<div class='col-xs-8'id='black-background' style='padding:8px 15px'><div id='white-font'><strong>1400. Total Settlement Charges (enter on lines 103, Section J and 502, Section K)</strong></div>
			</div>
			<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[328]' id='currency' value="<?= $_SESSION['row'][328]?>">
  		</div>
  		<div class='col-xs-2' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[329]' id='currency' value="<?= $_SESSION['row'][329]?>">
  		</div>
			</div>


  		<!--comparison of good faith  -->
  		<br/>
  		<div class='row'>
  		<div class='col-xs-8' id='gray-background' style='padding:8px 15px'>
  		<div><strong>Comparison of Good Faith Estimate (GFE) and HUD-1 Charrges</strong></div>
  		</div>
  		<div class='col-xs-2' style=';padding:8px 15px;' id='gray-background'>
  		<div ><strong>Good Faith Estimate</strong></div>
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;padding:8px 15px' id='gray-background'>
  		<div><strong>HUD-1</strong></div>
  		</div>
  		</div>

			<!-- Charges That Cannot Increase  -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background' style='padding:8px 15px'>
  		<div class='row'>
  		<div class='col-xs-8'>
  		<div><strong>Charges That Cannot Increase </strong></div>
  		</div>
  		<div class='col-xs-4'>
  		<div><strong>HUD-1 Line Number</strong></div>
  		</div>
  		</div>
  		</div>
  		<div class='col-xs-2' style=';padding:8px 15px' id='white-background'>
  		<div style='height:20px'></div>
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;padding:8px 15px' id='white-background'>
  		<div style='height:20px'></div>
  		</div>
  		</div>

			<!-- Our origination charge  -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background' style='padding:8px 15px'>
  		<div class='row'>
  		<div class='col-xs-8'>
  		<div>Our origination charge </div>
  		</div>
  		<div class='col-xs-4'>
  		<div># 801</div>
  		</div>
  		</div>
  		</div>
  		<div class='col-xs-2' style=';' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[330]' id='currency' value="<?= $_SESSION['row'][330]?>">
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[331]' id='currency' value="<?= $_SESSION['row'][331]?>">
  		</div>
  		</div>

  		<!-- Your credit or charge (points) for the specific interest rate chosen  -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background' style='padding:8px 15px'>
  		<div class='row'>
  		<div class='col-xs-8'>
  		<div>Your credit or charge (points) for the specific interest rate chosen</div>
  		</div>
  		<div class='col-xs-4'>
  		<div># 802</div>
  		</div>
  		</div>
  		</div>
  		<div class='col-xs-2' style=';' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[332]' id='currency' value="<?= $_SESSION['row'][332]?>">
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[333]' id='currency' value="<?= $_SESSION['row'][333]?>">
  		</div>
  		</div>

  		<!-- Your adjusted origination charges  -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background' style='padding:8px 15px'>
  		<div class='row'>
  		<div class='col-xs-8'>
  		<div>Your adjusted origination charges</div>
  		</div>
  		<div class='col-xs-4'>
  		<div># 803</div>
  		</div>
  		</div>
  		</div>
  		<div class='col-xs-2' style=';' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[334]' id='currency' value="<?= $_SESSION['row'][334]?>">
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[335]' id='currency' value="<?= $_SESSION['row'][335]?>">
  		</div>
  		</div>

  		<!-- Transfer taxes  -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background' style='padding:8px 15px'>
  		<div class='row'>
  		<div class='col-xs-8'>
  		<div>Transfer taxes</div>
  		</div>
  		<div class='col-xs-4'>
  		<div># 1203</div>
  		</div>
  		</div>
  		</div>
  		<div class='col-xs-2' style=';' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[336]' id='currency' value="<?= $_SESSION['row'][336]?>">
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[337]' id='currency' value="<?= $_SESSION['row'][337]?>">
  		</div>
  		</div>

  		<!-- Charges That In Total Cannot Increase More Than 10% -->
  		<br/>
  		<div class='row'>
  		<div class='col-xs-8' id='gray-background' style='padding:8px 15px'>
  		<div><strong>Charges That In Total Cannot Increase More Than 10%</strong></div>
  		</div>
  		<div class='col-xs-2' style=';padding:8px 15px;' id='gray-background'>
  		<div ><strong>Good Faith Estimate</strong></div>
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;padding:8px 15px' id='gray-background'>
  		<div><strong>HUD-1</strong></div>
  		</div>
  		</div>

  		<!-- Government recording charges -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background' style='padding:8px 15px'>
  		<div class='row'>
  		<div class='col-xs-8'>
  		<div>Government recording charges</div>
  		</div>
  		<div class='col-xs-4'>
  		<div># 1201</div>
  		</div>
  		</div>
  		</div>
  		<div class='col-xs-2' style=';' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[338]' id='currency' value="<?= $_SESSION['row'][338]?>">
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[339]' id='currency' value="<?= $_SESSION['row'][339]?>">
  		</div>
  		</div>

  		<!-- 7 rows blank -->
  		<!-- row1 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<input type="text" class="form-control" placeholder=""name='row[340]' value="<?= $_SESSION['row'][340]?>">
  		<span class="input-group-addon"># </span>
  		<input type="text" class="form-control" style='width:77px' placeholder=""name='row[341]' id='integer' value="<?= $_SESSION['row'][341]?>">
			</div>
  		</div>
  		<div class='col-xs-2' style=';' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[342]' id='currency' value="<?= $_SESSION['row'][342]?>">
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[343]' id='currency' value="<?= $_SESSION['row'][343]?>">
  		</div>
  		</div>

  		<!-- row2 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<input type="text" class="form-control" placeholder=""name='row[344]' value="<?= $_SESSION['row'][344]?>">
  		<span class="input-group-addon"># </span>
  		<input type="text" class="form-control" style='width:77px'placeholder=""name='row[345]' id='integer' value="<?= $_SESSION['row'][345]?>">
			</div>
  		</div>
  		<div class='col-xs-2' style=';' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[346]' id='currency' value="<?= $_SESSION['row'][346]?>">
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[347]' id='currency' value="<?= $_SESSION['row'][347]?>">
  		</div>
  		</div>

  		<!-- row3 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<input type="text" class="form-control" placeholder=""name='row[348]' value="<?= $_SESSION['row'][348]?>">
  		<span class="input-group-addon"># </span>
  		<input type="text" class="form-control" style='width:77px'placeholder=""name='row[349]' id='integer' value="<?= $_SESSION['row'][349]?>">
			</div>
  		</div>
  		<div class='col-xs-2' style=';' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[350]' id='currency' value="<?= $_SESSION['row'][350]?>">
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[351]' id='currency' value="<?= $_SESSION['row'][351]?>">
  		</div>
  		</div>

  		<!-- row4 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<input type="text" class="form-control" placeholder=""name='row[352]' value="<?= $_SESSION['row'][352]?>">
  		<span class="input-group-addon"># </span>
  		<input type="text" class="form-control"style='width:77px' placeholder=""name='row[353]' id='integer' value="<?= $_SESSION['row'][353]?>">
			</div>
  		</div>
  		<div class='col-xs-2' style=';' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[354]' id='currency' value="<?= $_SESSION['row'][354]?>">
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[355]' id='currency' value="<?= $_SESSION['row'][355]?>">
  		</div>
  		</div>

  		<!-- row5 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<input type="text" class="form-control" placeholder=""name='row[356]' value="<?= $_SESSION['row'][356]?>">
  		<span class="input-group-addon"># </span>
  		<input type="text" class="form-control" style='width:77px'placeholder=""name='row[357]' id='integer' value="<?= $_SESSION['row'][357]?>">
			</div>
  		</div>
  		<div class='col-xs-2' style=';' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[358]' id='currency' value="<?= $_SESSION['row'][358]?>">
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[359]' id='currency' value="<?= $_SESSION['row'][359]?>">
  		</div>
  		</div>

  		<!-- row6 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<input type="text" class="form-control" placeholder=""name='row[360]' value="<?= $_SESSION['row'][360]?>">
  		<span class="input-group-addon"># </span>
  		<input type="text" class="form-control" style='width:77px'placeholder=""name='row[361]' id='integer' value="<?= $_SESSION['row'][361]?>">
			</div>
  		</div>
  		<div class='col-xs-2' style=';' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[362]' id='currency' value="<?= $_SESSION['row'][362]?>">
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[363]' id='currency' value="<?= $_SESSION['row'][363]?>">
  		</div>
  		</div>

  		<!-- row 7 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<input type="text" class="form-control" placeholder=""name='row[364]' value="<?= $_SESSION['row'][364]?>">
  		<span class="input-group-addon"># </span>
  		<input type="text" style='width:77px'class="form-control" placeholder=""name='row[365]' id='integer' value="<?= $_SESSION['row'][365]?>">
			</div>
  		</div>
  		<div class='col-xs-2' style=';' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[366]' id='currency' value="<?= $_SESSION['row'][366]?>">
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[367]' id='currency' value="<?= $_SESSION['row'][367]?>">
  		</div>
  		</div>

  		<!-- total -->
			<div class='row'>
  		<div class='col-xs-8' id='gray-background'>
  		<div style='float:right;padding:7px;'>Total</div>
  		</div>
  		<div class='col-xs-2' style=';' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[368]' id='currency' value="<?= $_SESSION['row'][368]?>">
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[369]' id='currency' value="<?= $_SESSION['row'][369]?>">
  		</div>
  		</div>

  		<!-- Increase between GFE and HUD-1 Charges -->
  		<div class='row'>
  		<div class='col-xs-8' id='gray-background'>
  		<div style='float:right;padding:7px;'>Increase between GFE and HUD-1 Charges</div>
  		</div>
  		<div class='col-xs-2' style=';' id='nonright-border'>
  		<div class="input-group">
  		<span class="input-group-addon">$ </span>
  		<input type="text" class="form-control"placeholder=""name='row[370]' id='number' value="<?= $_SESSION['row'][370]?>">
  		</div>
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;' id='nonleft-border'>
  		<div class="input-group">
  		<span class="input-group-addon">or </span>
  		<input type="text" class="form-control" placeholder=""name='row[371]' id='number' value="<?= $_SESSION['row'][371]?>">
  		</div>
  		</div>
  		</div>

  		<!-- Charges That Can Change -->
  		<br/>
  		<div class='row'>
  		<div class='col-xs-8' id='gray-background' style='padding:8px 15px'>
  		<div><strong>Charges That Can Change</strong></div>
  		</div>
  		<div class='col-xs-2' style=';padding:8px 15px;' id='gray-background'>
  		<div ><strong>Good Faith Estimate</strong></div>
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;padding:8px 15px' id='gray-background'>
  		<div><strong>HUD-1</strong></div>
  		</div>
  		</div>

  		<!-- Initial deposit for your escrow account -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background' style='padding:8px 15px'>
  		<div class='row'>
  		<div class='col-xs-8'>
  		<div>Initial deposit for your escrow account</div>
  		</div>
  		<div class='col-xs-4'>
  		<div># 1001</div>
  		</div>
  		</div>
  		</div>
  		<div class='col-xs-2' style=';' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[372]' id='currency' value="<?= $_SESSION['row'][372]?>">
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[373]' id='currency' value="<?= $_SESSION['row'][373]?>">
  		</div>
  		</div>

  		<!-- Daily interest charges -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class='row'>
  		<div class='col-xs-8'>
  		<div class="input-group">
  		<span class="input-group-addon">&nbsp Daily interest charges &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp $</span>
  		<input type="text" class="form-control" placeholder=""name='row[374]' id='number' value="<?= $_SESSION['row'][374]?>">
  		<span class="input-group-addon">/day</span>
			</div>
  		</div>
  		<div class='col-xs-4'>
  		<div style='padding-top:6px;margin-left:-8px;'># 901</div>
  		</div>
  		</div>
  		</div>
  		<div class='col-xs-2' style=';' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[375]' id='currency' value="<?= $_SESSION['row'][375]?>">
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[376]' id='currency' value="<?= $_SESSION['row'][376]?>">
  		</div>
  		</div>

  		<!-- Homeowner’s insurance -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background' style='padding:8px 15px'>
  		<div class='row'>
  		<div class='col-xs-8'>
  		<div>Homeowner’s insurance</div>
  		</div>
  		<div class='col-xs-4'>
  		<div># 903</div>
  		</div>
  		</div>
  		</div>
  		<div class='col-xs-2' style='; padding-bottom:2px;' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[377]' id='currency' value="<?= $_SESSION['row'][377]?>">
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;padding-bottom:2px;' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[378]' id='currency' value="<?= $_SESSION['row'][378]?>">
  		</div>
  		</div>

  		<!-- 3 rows blank -->
  		<!-- row1 -->
			<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<input type="text" class="form-control" placeholder=""name='row[379]' value="<?= $_SESSION['row'][379]?>">
  		<span class="input-group-addon"># </span>
  		<input type="text" style='width:77px'class="form-control" placeholder=""name='row[380]' id='integer' value="<?= $_SESSION['row'][380]?>">
			</div>
  		</div>
  		<div class='col-xs-2' style=';' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[381]' id='currency' value="<?= $_SESSION['row'][381]?>">
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[382]' id='currency' value="<?= $_SESSION['row'][382]?>">
  		</div>
  		</div>

  		<!-- row2 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<input type="text" class="form-control" placeholder=""name='row[383]' value="<?= $_SESSION['row'][383]?>">
  		<span class="input-group-addon"># </span>
  		<input type="text" style='width:77px'class="form-control" placeholder=""name='row[384]' id='integer' value="<?= $_SESSION['row'][384]?>">
			</div>
  		</div>
  		<div class='col-xs-2' style=';' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[385]' id='currency' value="<?= $_SESSION['row'][385]?>">
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[386]' id='currency' value="<?= $_SESSION['row'][386]?>">
  		</div>
  		</div>

  		<!-- row3 -->
  		<div class='row'>
  		<div class='col-xs-8' id='white-background'>
  		<div class="input-group">
  		<input type="text" class="form-control" placeholder=""name='row[387]' value="<?= $_SESSION['row'][387]?>">
  		<span class="input-group-addon"># </span>
  		<input type="text" style='width:77px'class="form-control" placeholder=""name='row[388]' id='integer' value="<?= $_SESSION['row'][388]?>">
			</div>
  		</div>
  		<div class='col-xs-2' style=';' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[389]' id='currency' value="<?= $_SESSION['row'][389]?>">
  		</div>
  		<div class='col-xs-2' style='margin-left:0px;' id='white-background'>
  		<input type="text" class="form-control" placeholder=""name='row[390]' id='currency' value="<?= $_SESSION['row'][390]?>">
  		</div>
  		</div>


  		<!-- Loan Terms -->
  		<br/>
  		<div class='row'>
      <div class='col-xs-12'id='black-background' style='padding:8px 15px'><div id='white-font'><strong>Loan Terms</strong></div>
      </div>
      </div>

      <!-- Your initial loan amount is -->
      <div class='row'>
      <div class='col-xs-5' id='white-background1'>
      <div style='padding:7px;margin-left:-7px;'>Your initial loan amount is</div>
      </div>
      <div class='col-xs-7' id='white-background1'>
      <div class="input-group">
      <span class="input-group-addon">$</span>
      <input type="text" style='width:100px'class="form-control" placeholder=""name='row[391]' id='number' value="<?= $_SESSION['row'][391]?>">
      </div>
      </div>
      </div>

      <!-- Your loan term is  -->
      <div class='row'>
      <div class='col-xs-5' id='white-background1'>
      <div style='padding:7px;margin-left:-7px;'>Your loan term is</div>
      </div>
      <div class='col-xs-7' id='white-background1'>
      <div class="input-group" style='width:110px;margin-left:8px'>
      <input type="text" style='width:100px;'class="form-control" placeholder=""name='row[392]' id='integer' value="<?= $_SESSION['row'][392]?>">
      <span class="input-group-addon">years</span>
      </div>
      </div>
      </div>



      <!-- Your initial monthly amount -->
      <div class='row'>
      <div class='col-xs-5' id='white-background1'>
      <div style='padding:7px;margin-left:-7px;'>Your initial interest rate is</div>
      </div>
      <div class='col-xs-7' id='white-background1'>
      <div class="input-group" style='width:110px;margin-left:8px'>
      <input type="text" style='width:100px;'class="form-control" placeholder=""name='row[393]' id='number' value="<?= $_SESSION['row'][393]?>">
      <span class="input-group-addon">%</span>
      </div>
      </div>
      </div>


      <!-- Your initial monthly amount owed for principal, interest, and any -->
      <div class='row'>
      <div class='col-xs-5' id='white-background1'>
      <div>Your initial monthly amount owed for principal, interest, and any mortgage insurance is</div>
      </div>
      <div class='col-xs-7' id='white-background1'>
      <div class="input-group">
      <span class="input-group-addon">$</span>
      <input type="text" style='width:100px'class="form-control" placeholder=""name='row[394]' id='number' value="<?= $_SESSION['row'][394]?>">
      <span>includes</span>
      </div>
      <br/>
      <div class="input-group">
      <input type="checkbox" class="" checked placeholder="" name='row[395]' value="<?=$_SESSION['row'][395]?>"><span>Principal</span>
      </div>
      <br/>
      <div class="input-group">
      <input type="checkbox" class="" checked placeholder=""name='row[396]' value="<?= $_SESSION['row'][396]?>"><span>Interest</span>
      </div>
      <br/>
      <div class="input-group">
      <input type="checkbox" class="" placeholder=""name='row[397]' value="<?= $_SESSION['row'][397]?>"><span>Mortgage Insurance</span>
      </div>
      </div>
      </div>

      <!-- Can your interest rate rise? -->
      <div class='row'>
      <div class='col-xs-5' id='white-background1'>
      <div>Can your interest rate rise?</div>
      </div>
      <div class='col-xs-7' id='white-background1'>
      <div class='row'>
      <div class="input-group">
      <input type="radio" style=''class="" name='row[398]'placeholder="" value="No">
      <span class="input-group-addon">No</span>
      <input type="radio" style=''class="" name='row[398]'placeholder="" value="Yes">
      <span class="input-group-addon">Yes, it can rise to a maximum of</span>
      <input type="text" style=''class="form-control" placeholder=""name='row[399]' id='number' value="<?= $_SESSION['row'][399]?>">
      <span class="input-group-addon">%. The first change will be on</span>
      <input type="text" style=''class="form-control datepicker" placeholder=""name='row[400]' id='date400' value="<?= $_SESSION['row'][400]?>">
      </div>
      </div>
      <div class='row'>
      <div class="input-group">
      <span class="input-group-addon">and can change again every</span>
      <input type="text"  style=''class="form-control" placeholder=""name='row[401]' value="<?= $_SESSION['row'][401]?>">
      <span class="input-group-addon">after</span>
      <input type="text" style=''class="form-control datepicker" placeholder=""name='row[402]' id='date402' value="<?= $_SESSION['row'][402]?>">
      <span class="input-group-addon">. Every change date, your</span>
      </div>
      </div>
      <div class='row'>
      <div class="input-group">
      <span class="input-group-addon">interest rate can increase or decrease by</span>
      <input type="text" name='row[403]' style=''class="form-control" placeholder="" id='number' value="<?= $_SESSION['row'][403]?>">
      <span class="input-group-addon">%. Over the life of the loan, your interest rate is</span>
      </div>
      </div>
      <div class='row'>
      <div class="input-group">
      <span class="input-group-addon">guaranteed to never be <strong>lower</strong> than  </span>
      <input type="text" name='row[404]' style=''class="form-control" placeholder="" id='number' value="<?= $_SESSION['row'][404]?>">
      <span class="input-group-addon">% or <strong>higher</strong> than </span>
      <input type="text" name='row[405]'style=''class="form-control" placeholder="" id='number' value="<?= $_SESSION['row'][405]?>">
      <span class="input-group-addon">%.</span>
      </div>
      </div>
      </div>
      </div>

      <!-- Even if you make payments on time, can your loan balance rise? -->
      <div class='row'>
      <div class='col-xs-5' id='white-background1'>
      <div>Even if you make payments on time, can your loan balance rise?</div>
      </div>
      <div class='col-xs-7' id='white-background1'>
      <div class='row'>
      <div class="input-group">
      <input type="radio" name='row[406]'style=''class="" placeholder="" value="No">
      <span class="input-group-addon">No</span>
      <input type="radio"name='row[406]' style=''class="" placeholder="" value="Yes">
      <span class="input-group-addon">Yes, it can rise to a maximum of $</span>
      <input type="text" name='row[407]'style=''class="form-control" placeholder="" id='number' value="<?= $_SESSION['row'][407]?>">
      </div>
      </div>
      </div>
      </div>

      <!-- Even if you make payments on time, can your monthly -->
      <div class='row'>
      <div class='col-xs-5' id='white-background1' style=''>
      <div>Even if you make payments on time, can your monthly amount owed for principal, interest, and mortgage insurance rise?</div>
      </div>
      <div class='col-xs-7' id='white-background1'>
      <div class='row'>
      <div class="input-group">
      <input type="radio" name='row[408]'style=''class="" placeholder="" value="No">
      <span class="input-group-addon">No</span>
      <input type="radio"name='row[408]' style=''class="" placeholder="" value="Yes">
      <span class="input-group-addon">Yes, the first increase can be on</span>
      <input type="text" name='row[409]'style=''class="form-control datepicker" placeholder="" id='date409' value="<?= $_SESSION['row'][409]?>">
      <span class="input-group-addon">and the monthly amount</span>
      </div>
      </div>
      <div class='row'>
      <div class="input-group">
      <span class="input-group-addon">owed can rise to $</span>
      <input type="text" name='row[410]' style=''class="form-control" placeholder="" id='number' value="<?= $_SESSION['row'][410]?>">
      <span class="input-group-addon">. The maximum it can ever rise to is $</span>
      <input type="text" name='row[411]'style=''class="form-control" placeholder="" id='number' value="<?= $_SESSION['row'][411]?>">
      </div>
      </div>
      </div>
      </div>

      <!-- Does your loan have a prepayment penalty? -->
      <div class='row'>
      <div class='col-xs-5' id='white-background1' style=''>
      <div>Does your loan have a prepayment penalty?</div>
      </div>
      <div class='col-xs-7' id='white-background1'>
      <div class='row'>
      <div class="input-group">
      <input type="radio" name='row[412]'style=''class="" placeholder="" value="No">
      <span class="input-group-addon">No</span>
      <input type="radio"name='row[412]' style=''class="" placeholder="" value="Yes">
      <span class="input-group-addon">Yes, your maximum prepayment penalty is $</span>
      <input type="text" name='row[413]'style=''class="form-control"  placeholder=""  id='number' value="<?= $_SESSION['row'][413]?>">
      </div>
      </div>
      </div>
      </div>

      <!-- Does your loan have a balloon payment? -->
      <div class='row'>
      <div class='col-xs-5' id='white-background1' style=''>
      <div>Does your loan have a balloon payment?</div>
      </div>
      <div class='col-xs-7' id='white-background1'>
      <div class='row'>
      <div class="input-group">
      <input type="radio" name='row[414]'style=''class="" placeholder="" value="No">
      <span class="input-group-addon">No</span>
      <input type="radio"name='row[414]' style=''class="" placeholder="" value="Yes">
      <span class="input-group-addon">Yes, you have a balloon payment of $  </span>
      <input type="text" name='row[415]'style=''class="form-control" placeholder="" id='number' value="<?= $_SESSION['row'][415]?>">
      <span class="input-group-addon">due in</span>
      <input type="text" name='row[416]'style=''class="form-control" placeholder="" id='integer' value="<?= $_SESSION['row'][416]?>">
      <span class="input-group-addon">years</span>
      </div>
      </div>
      <div class='row'>
      <div class="input-group">
      <span class="input-group-addon">on</span>
      <input type="text" name='row[417]'style=''class="form-control datepicker" id='date417' placeholder="" value="<?= $_SESSION['row'][417]?>">
      </div>
      </div>
      </div>
      </div>

      <!-- Total monthly amount owed including escrow account payments -->
      <div class='row'>
      <div class='col-xs-5' id='white-background' style=''>
      <div>Total monthly amount owed including escrow account payments</div>
      </div>
      <div class='col-xs-7' id='white-background'>
      <div class='row'>
      <div class="input-group">
      <input type="radio" name='row[418]'style=''class="" placeholder="" value="No">
      <span style='margin-left:10px'>You do not have a monthly escrow payment for items, such as property taxes and</span>
      </div>
      </div>
      <div class='row'>
      <span style='margin-left:26px'>homeowner’s insurance. You must pay these items directly yourself.</span>
      </div>
      <div class='row'>
      <div class="input-group">
      <input type="radio" name='row[418]'style=''class="" placeholder="" value="Yes">
      <span class="input-group-addon">You have an additional monthly escrow payment of $</span>
      <input type="text" name='row[419]'style=''class="form-control" id='currency' placeholder="" value="<?= $_SESSION['row'][419]?>">
      </div>
      </div>
      <div class='row'>
      <div class="input-group"style=''>
      <span class="input-group-addon">that results in a total initial monthly amount owed of $</span>
      <input type="text" name='row[420]'style=''class="form-control" id='currency' placeholder="" value="<?= $_SESSION['row'][420]?>">
      <span class="input-group-addon">. This includes</span>
      </div>
      </div>
      <div class='row'>
      <span style='margin-left:26px'>principal, interest, any mortagage insurance and any items checked below:</span>
      </div>
      <br/>
      <div class='row'>
      <div class='col-xs-6' style='padding-left:25px'>
      <div class="input-group">
      <input type="checkbox" name='row[421]'style=''class="" placeholder="" value="<?= $_SESSION['row'][421]?>">
      <span style='margin-left:10px'>Property taxes</span>
      </div>
      </div>
      <div class='col-xs-6'>
      <div class="input-group">
      <input type="checkbox" name='row[422]'style=''class="" placeholder="" value="<?= $_SESSION['row'][422]?>">
      <span style='margin-left:10px'>Homeowner’s insurance</span>
      </div>
      </div>
      </div>
      <br/>
      <div class='row'>
      <div class='col-xs-6' style='padding-left:25px'>
      <div class="input-group">
      <input type="checkbox" name='row[423]'style=''class="" placeholder="" value="<?= $_SESSION['row'][423]?>">
      <span style='margin-left:10px'>Flood insurance</span>
      </div>
      </div>
      <div class='col-xs-6'>
      <div class="input-group">
      <input type="checkbox" name='row[424]'style=''class="" placeholder="" value="<?= $_SESSION['row'][424]?>">
      <span class="input-group-addon"></span>
      <input type="text" name='row[425]'style=''class="form-control" id='currency' placeholder="" value="<?= $_SESSION['row'][425]?>">
      </div>
      </div>
      </div>
      <br/>
      <div class='row'>
      <div class='col-xs-6' style='padding-left:25px'>
      <div class="input-group">
      <input type="checkbox" name='row[426]'style=''class="" placeholder="" value="<?= $_SESSION['row'][426]?>">
      <span class="input-group-addon"></span>
      <input type="text" name='row[427]'style=''class="form-control" id='currency' placeholder="" value="<?= $_SESSION['row'][427]?>">
      </div>
      </div>
      <div class='col-xs-6'>
      <div class="input-group">
      <input type="checkbox" name='row[428]'style=''class="" placeholder="" value="<?= $_SESSION['row'][428]?>">
      <span class="input-group-addon"></span>
      <input type="text" name='row[429]'style=''class="form-control" id='currency' placeholder="" value="<?= $_SESSION['row'][429]?>">
      </div>
      </div>
      </div>
      </div>
      </div>
            <div class='row'>
    <div class="btn-group">
      <input type="submit" class="btn btn-default" name="EmailHUD" value="E-Mail HUD" />
      <input type="submit" class="btn btn-default" name="DownloadHUD" value="Download HUD" />
      </div>
      </div>
    </form>
      <!-- Note -->
      <br/>
      <input type="hidden" id="loanamount" value="<?=$_SESSION['loanamount']?>">
      <input type="hidden" id="salesprice" value="<?=$_SESSION['salesprice']?>">
      <input type="hidden" id="loantype" value="<?=$_SESSION['loantype']?>">
      <input type="hidden" id="Old_URL" value="<?=$_SESSION['Old_URL']?>">
      <input type="hidden" id="insurance" value="<?=$_SESSION['insurance']?>">
      <div class='row'>
      <div><strong>Note: </strong>If you have any questions about the Settlement Charges and Loan Terms listed on this form, please contact your lender.</div>
      </div>
  </div>

    <!-- /.container -->


    <!-- Load JS here for greater good =============================-->
<script type="text/javascript" src="jquery-1.9.0.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript" src="jquery.formatCurrency-1.4.0.js"></script>
<script type="text/javascript"src="HUD.js"></script>
<script type="text/javascript">
  function equalHeight(group)
    {
        group.each(function()
        {
          $(this).height($(this).siblings(".col-xs-7").height());
        });
    }
    equalHeight($('.col-xs-5'));

</script>
  </body>
</html>
