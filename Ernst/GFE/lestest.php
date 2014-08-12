<html>
<head>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<body>
<form class="little-table">
 
                <div class="row">
                     <h1 class="fs-title">Summary Transaction Information</h1>
				</div>
				 <div class="row">
		<div class="col-md-2 top-label">Search Type:</div>
		<div class="col-md-2">
		<select name="search_type" class="select-block" style="margin-top:17px;" onChange="instantChange();">
				<option value="GFE" selected="selected">GFE</option>
				<option value="AC">Affordability Calc</option>
				<option value="CFPB">New CFPB Forms</option>
		</select>
		</div>				
                    <div class="col-md-2 top-label">Purchase Price:</div>
                    <div class="col-md-2 les-input">
                        <input type="text" value="" placeholder="$100,000" class="form-control" name="purchase_price" onChange="instantChange();"></input>
                    </div>
		<div class="col-md-2 top-label">Loan Amount:</div>
                    <div class="col-md-2 les-input">
                        <input type="text" value="" placeholder="$80,000" class="form-control" name="loan_amount" onChange="instantChange();"></input>
                    </div>
		    <div class="col-md-2 top-label">Existing Debt:</div>
                    <div class="col-md-2 les-input">
                        <input type="text" value="" class="form-control" name="exdebt" onChange="instantChange();"></input>
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
						<input type="radio" name="purpose" value="1" /> Purchase &nbsp;
						<input type="radio" name="purpose" value="0"  /> Refinance
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
		    <div><input type="checkbox" id="TitleOrderOnly" name="TitleOrderOnly" >Title Order Only (NJ & NY)</div>
				</div>
</form>
<button type="button" onclick="test();">Click Me!</button>
<script>
function test(){
$.ajax({
										url: 'les_engine.php',

										data: $('.little-table').serializeArray(),
							
										type: "POST",

										dataType: "json",

										success: function(data) {
											//var results = jQuery.parseJSON(data);
											for (var key in data) {
											if (data.hasOwnProperty(key)) {
											$('body').append( "<p>" + key + " -> " + data[key] + " </p>" );
											
											}
											}
										}
									});
}
</script>
</body>
</html>