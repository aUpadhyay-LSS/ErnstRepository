<html>
<head>
<script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
</head>
<body>
<form class="little-table" method="post" target="full_les" action="http://lssoftwaresolutions.com/jimboindustries/Form_test/full_les.php">
 
                <div class="row">
                     <h1 class="fs-title">Summary Transaction Information</h1>
				</div>
				 <div class="row">	
					<div class="col-md-2 top-label">Dated issued:</div>
                    <div class="col-md-2 les-input">
                        <input type="text" value="" placeholder="10/14/2013" class="form-control" name="date_issued" onChange="instantChange();"></input>
                    </div>
					<div class="col-md-2 top-label">Applicants:</div>
                    <div class="col-md-2 les-input">
                        <input type="text" value="" placeholder="David" class="form-control" name="applicants" onChange="instantChange();"></input>
                    </div>
					<div class="col-md-2 top-label">Address:</div>
                    <div class="col-md-2 les-input">
                        <input type="text" value="" placeholder="Yo momas place" class="form-control" name="address" onChange="instantChange();"></input>
                    </div>
					<div class="col-md-2 top-label">Loan ID:</div>
                    <div class="col-md-2 les-input">
                        <input type="text" value="" placeholder="12345" class="form-control" name="loanid" onChange="instantChange();"></input>
                    </div>
				</div>
					 <div class="row">	
                    <div class="col-md-2 top-label">Purchase Price:</div>
                    <div class="col-md-2 les-input">
                        <input type="text" value="" placeholder="$100,000" class="form-control" name="purchase_price" onChange="instantChange();"></input>
                    </div>
					<div class="col-md-2 top-label">Loan Amount:</div>
                    <div class="col-md-2 les-input">
                        <input type="text" value="" placeholder="$80,000" class="form-control" name="loan_amount" onChange="instantChange();"></input>
                    </div>
					<div class="col-md-2 top-label">Loan Term:</div>
					<div class="col-md-2">
						<select name="loan_term" class="select-block" style="margin-top:17px;" onChange="instantChange();">
							<option value="30" selected="selected">30 years</option>
							<option value="15">15 years</option>
							<option value="5">5 years</option>
						</select>
					</div>
					<div class="col-md-2 top-label">Purpose:</div>
					<div class="col-md-2">
						<select name="purpose" class="select-block" style="margin-top:17px;" onChange="instantChange();">
							<option value="purchase" selected="selected">Purchase</option>
							<option value="refinance">Refinance</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2 top-label">Interest Rate:</div>
                    <div class="col-md-2 les-input">
                        <input type="text" value="" placeholder="4.5%" class="form-control" name="interest_rate" onChange="instantChange();"></input>
                    </div>
					<div class="col-md-2 top-label">Zip Code:</div>
                    <div class="col-md-2 les-input">
                        <input type="text" value="" placeholder="Zipcode" class="form-control" name="zip_code" onChange="instantChange();"></input>
                    </div>
					<input type="hidden" value="CFPB" name="search_type"></input>
				</div>
				<div class="row">
				<input type="submit" class="" id="popupHUD-btn" name="CalculateRate" value= "Calculate Rate" /></td>
				</div>
</form>
<div class="row">
<!--<a href="#fakelink" id="popupHUD-btn2" class="btn btn-block btn-lg btn-info">View Full Loan Estimate Form</a>-->
</div>
<div id="popupHUD" title="Popup HUD">
  <iframe src="http://lssoftwaresolutions.com/jimboindustries/Form_test/full_les.php" width="1000" height="1000" name="full_les"></iframe>
</div>
<script>
$(function() {
    $( "#popupHUD" ).dialog({
	  autoOpen: false,
      height: 1000,
	  width: 1000,
      modal: true
    });
	$( "#popupHUD-btn" ).click(function() {
	  $( "#popupHUD" ).dialog( "open" );
    });
  });
</script>
</script>
</body>
</html>