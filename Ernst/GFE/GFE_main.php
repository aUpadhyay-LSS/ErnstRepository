<?php
	header('P3P: CP="CAO PSA OUR"');
	session_start();
	include('les_config.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
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
		<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
		<?php
		if(isset($_SESSION['state'])){echo '<script>$("document").ready(function(){$("#state").val("'.$_SESSION['state'].'");})</script>';}
		if(isset($_SESSION['county'])){echo '<script>$("document").ready(function(){$("#county").val("'.$_SESSION['county'].'");})</script>';}
		if(isset($_SESSION['township'])){echo '<script>$("document").ready(function(){$("#township").val("'.$_SESSION['township'].'");})</script>';}
		?>

		<script>$(function() {    $( "#datepicker" ).datepicker();  });  </script>

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
			
			function OrderTitle()
			{
			if (document.CALC.state.value == "NJ" || document.CALC.state.value == "NY"){ window.location = "ordertitle_nj.php";}
			else {window.location = "ordertitle.php";}
			}

			function ValidateGFE(){
			  var result="";
				 //Sets default off for mansion tax inicator
				document.CALC.mansion.value = "";
				
			  if(document.CALC.purchase_price.value >1000000 && document.CALC.loantype[0].checked == true && document.CALC.state.value=="NJ")
			  {
				var mansion=confirm("Please click 'Ok' if Property is 1-3 Family home");
				  
				if(mansion==true){
				  document.CALC.mansion.value = "Yes";
				}
			  }
			  
			  //checks loan amount
			  if(document.CALC.loan_amount.value >=0 && document.CALC.loan_amount.value < 100000000){}
			  else {alert("Please enter a valid loan amount"); document.CALC.loan_amount.value=0; return false;}
			  
			  //checks purchase price
			  if(document.CALC.purchase_price.value >=0 &&  document.CALC.purchase_price.value < 100000000){}
			  else {alert("Please enter a valid purchase price"); document.CALC.purchase_price.value=0; return false;}
			  
			  //checks existing debt
			  if(document.CALC.exdebt.value >=0 && document.CALC.exdebt.value < 100000000){}
			  else {alert("Please enter a valid existing debt amount"); document.CALC.exdebt.value=0; return false;}
			}

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
			
			function call_ErnstEngine() //Added by Avanish
			{
			var ernst_state = $("#state").val();
			var ernst_county = $("#county").val();
			var ernst_township = $("#township").val();
			var EstimatedValue = $("#purchase_price").val();
			var MortgageAmount = $("#loan_amount").val();
					$.ajax({
						 url:"ErnstEngine.php",
						 type: "post",
						 data:{'state':ernst_state,'county':ernst_county, 'township':ernst_township, 'purchase_price':EstimatedValue, 'loan_amount':MortgageAmount},	             
					success: function(data) 
					{
						//alert("Success");
						alert(data);
						
					}}); 
					
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
				<li>
				<?php if($gfe=="1"){?><li class="active"><a href="GFE_main.php" class="navbutton">GFE</a></li><?php } ?>
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
			 <div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				  <span class="sr-only">Toggle navigation</span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="http://lssoftwaresolutions.com/" target="_blank"><img class="img-responsive" src="./Images/lode_star_logo.png" style="height:50px;width: 102px" alt="Responsive image"></a>
			 </div>

			 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav"> 
				 <?php if($gfe=="1"){?><li class="active"><a href="GFE_main.php" >GFE</a></li><?php } ?>
				 <?php if($ac=="1"){?><li><a href="AC_main.php" class="navbutton">Affordability</a></li><?php } ?>
				 <?php if($nyc=="1"){?><li><a href="CEMA_main.php" class="navbutton">New York</a></li><?php } ?>
				 <?php if($ctic=="1"){?><li><a href="COMM_main.php" class="navbutton">Commercial</a></li><?php } ?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
				  <li><a href="ordertitle.php">Order Title</a></li>
				  <li><a href="myprofile.php">My Profile</a></li>
				  <li><a href="history.php">My Searches</a></li>
				  <li><a href="logout.php">Log Out</a></li>
				</ul>
			  </div>
			</nav>

			<?php
			}
			?>
		</div>

		<div class='middle'>
		  <div class="container">
			<p STYLE= margin-left:15px;font-family:arial;color:grey;font-size:30px;">GFE Fee Calculator
			<br/>
			<!--Change URL path to direct to client file folder -->
			<form name="CALC" method="post" action="GFE_results.php" target="GFE_iframe" onsubmit="return ValidateGFE()">
			<table class="table table-hover" STYLE=margin-left:15px border="0" cellspacing="2" cellpadding="10">
				<tr>
					<td colspan="1"><b>Loan Type:</td>
					<td width="256"><input type="radio" name="purpose" value="1" <?php if($_SESSION['purpose']==1){echo "checked";}else{echo "checked";}?> /> Purchase &nbsp;
					<input type="radio" name="purpose" value="0" <?php if($_SESSION['purpose']==0){echo "checked";}?> /> Refinance
					</b></td> 
					<td><b>Purchase Price:</b>
					</td><td><input type="text" name="purchase_price" id="purchase_price" size=10 value="<?php if(isset($_SESSION['purchase_price'])){echo $_SESSION['purchase_price'];} else{echo"0";} ?>" ></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="checkbox" id="TitleOrderOnly" name="TitleOrderOnly" <?php if($_SESSION['TitleOrderOnly']=="on"){echo "CHECKED";}?>>Title Order Only (NJ & NY)</td>
					<td><b>Loan Amount:</b></td>
					<td><input type="text" name="loan_amount" id="loan_amount" size=10 value="<?php if(isset($_SESSION['loan_amount'])){echo $_SESSION['loan_amount'];} else{echo"0";} ?>" ></td>
				</tr>	
				<tr>
					<td><b>State:</b></td>
					<td>
						<select id="state" name="state" value="NA" onchange= "fetchcounties(this.value)">
						<option value="NA">Please Select a State</option>
						  <?php   
							 foreach($GLOBALS['states'] as $state)
							{
								echo '<option value="'.$state.'">'.$state.'</option>';
							}
							
							?>
						</select> 
					</td>
					<td> <b>Existing Debt:</b><br/>(Refis in FL,MD & NJ only)</td>
					<td><input type="text" name="exdebt" size=10 value=<?php if(isset($_SESSION['exdebt'])){echo $_SESSION['exdebt'];} else{echo"0";} ?>></td>
				</tr>
				<tr>
					<td><b>County: </b></td>
					<td>
					 <select name="county" id="county" onchange= "fetchtownships(this.value,state.value)">
					 <option value="NA">Please select a county</option> 
					 </select>
					</td>
					<td><b> LoanID: </b></td>
					<td><input type="text" name="loanid" size=20 value="<?= $_SESSION['loanid'] ?>"></td>
				</tr>
				<tr>
					<td><b>Township: </b></td>
					<td> 
						<select name="township" id="township"  >
						<option value="NA">Please select a township</option> 
						</select>
					</td>
					<td><b>File Name: </b></td>
					<td><input type="text" name="filename" size=20 value="<?= $_SESSION['filename'] ?>"></td>
				</tr>
				<tr>
					<td>
					<input type="checkbox" name="FirstTime" value="FirstTime" <?php if($_SESSION['FirstTime']=="FirstTime"){echo "CHECKED";}?>>First Time Home Buyer
					</td>
					<td><input type="checkbox" name="PrincipleResidence" value="PrincipleResidence" >Principle Residence</td>
				</tr>
				<tr>
					<td><input type="submit" class="btn btn-default"  name="CalculateRate" value= "Calculate Rate" onclick="call_ErnstEngine()" /></td>
					<td><input type="submit" class="btn btn-default"   name="ReissueRate" value= "Reissue Rate" />
						<input type="submit" class="btn btn-default"  name="EmailQuote" value= "Email Quote"/></td>
					<td><input type="submit" class="btn btn-default" name="PrintHUD" value= "Preview HUD"/></td>
					<td>
						<input type="button" class="btn btn-default"  name="command"  value= "Order Title" onclick=OrderTitle() />
						<input type="submit" class="btn btn-default" name="PrintQuote" value="Print"  />
						<input type="hidden" name="mansion" size=20 value="">
					</td>
				</tr>
			</table>
			</form><br/>
			
			<!--Change URL path to direct to client file folder -->
			<iframe name="GFE_iframe" src="GFE_results.php" width="700" height="550" seamless style="border:none"></iframe>
		  </div>
		</div>

		<?php?>
	</body>
</html>
