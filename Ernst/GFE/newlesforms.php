<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="Stylesheets/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="Stylesheets/flat-ui.css" type="text/css" />
<link rel="stylesheet" href="Stylesheets/newlesforms.css" type="text/css" />
<script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery.easing.min.js"></script>
<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
	 <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
</head>
<body>
<script>
$(document).ready( function() {
    $('.datePicker').val(new Date().toJSON().slice(0,10));
	
    $('input.money').keyup(function(event) {

	// skip for arrow keys
	if(event.which >= 37 && event.which <= 40){
		event.preventDefault();
	}

	$(this).val(function(index, value) {
		return value
		.replace(/\D/g, "")
		.replace(/\B(?=(\d{3})+(?!\d))/g, ",")
		;
	});
	instantChange();
	});	
});
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
<div class="container">
<div class="top-inputs" id="top-inputs" style="background:white; padding-left:10px;">
 <form class="little-table">
 
                <div class="row">
                     <h1 class="fs-title">Summary Transaction Information</h1>
				</div>
				 <div class="row">
                    <div class="col-md-2 top-label">Purchase Price:</div>
                    <div class="col-md-2 les-input">
                        <input type="text" value="" placeholder="$100,000" class="form-control money" name="purchase_price" onChange="instantChange();"></input>
                    </div>
					<div class="col-md-2 top-label">Loan Amount:</div>
                    <div class="col-md-2 les-input">
                        <input type="text" value="" placeholder="$80,000" class="form-control money" name="loan_amount" onChange="instantChange();"></input>
                    </div>
					<div class="col-md-2 top-label">Loan Term:</div>
					<div class="col-md-2">
						<select name="loan_term" class="select-block" style="margin-top:17px;" onChange="instantChange();">
							<option value="30" selected="selected">30 years</option>
							<option value="15">15 years</option>
							<option value="5">5 years</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-2 top-label">Loan Purpose:</div>
					<div class="col-md-2">
						<select name="loan_purpose" class="select-block" style="margin-top:17px;" onChange="instantChange();">
							<option value="purchase" selected="selected">Purchase</option>
							<option value="refinance">Refinance</option>
						</select>
					</div>
					<div class="col-md-2 top-label">Zip Code:</div>
                    <div class="col-md-2 les-input">
                        <input type="text" value="" placeholder="Zipcode" class="form-control" name="zip_code" onChange="instantChange();"></input>
                    </div>
					<div class="col-md-2 top-label">Interest Rate:</div>
                    <div class="col-md-2 les-input">
                        <input type="text" value="" placeholder="4.5%" class="form-control" name="interest_rate" onChange="instantChange();"></input>
                    </div>
				</div>
				<div class="row">
				<a href="#fakelink" id="popupHUD-btn" class="btn btn-block btn-lg btn-info">View Full Loan Estimate Form</a>
				</div>

                </div>
                
           
            </div>
</form>
<div id="popupHUD" title="Popup HUD" style="display:none;">
  <iframe src="http://www.lssoftwaresolutions.com/jimboindustries/newles/index.php" width="1000" height="1000"></iframe>
</div>
    <form id="msform">
        <!-- progressbar -->
        <ul id="progressbar">
            <li id="0" class="active">Closing Information</li>
            <li id="1">Closing Information</li>
            <li id="2">Loan Information</li>
            <li id="3">Loan Terms</li>
            <li id="4">Projected Payment</li>
            <li id="5">Insurance Costs</li>
            <li id="6">Extra Costs</li>
        </ul>
        <!-- fieldsets -->
        <fieldset>
             <h2 class="fs-title">Closing Information</h2>

			<div class="row">
				<div class="col-md-3 table-head">Date Issued</div>
				<div class="col-md-3 les-input">
					<input class ="datePicker" type="date" name="Date Issued" placeholder="date-issued">
				</div>
				<div class="col-md-2 table-head">Product</div>
				<div class="col-md-2 les-select">
					<select name="product" class="les-select">
						<option>Fixed Rate</option>
						<option>Balloon</option>
					</select>
				</div>
			</div>
            <div class="row">
				<div class="col-md-3 table-head">Closing Date</div>
				<div class="col-md-3 les-input">
					<input class ="datePicker" type="date" name="Closing Date" placeholder="closing-date">
				</div>
				<div class="col-md-2 table-head">Purpose</div>
				<div class="col-md-2">
					<select name="loan-type" class="les-select">
						<option>Conventional</option>
						<option>FHA</option>
						<option>VA</option>
					</select>
				</div>
			</div>
            <div class="row">
				<div class="col-md-3 table-head">Disbursement Date</div>
				<div class="col-md-4 les-input">
					<input class ="datePicker" type="date" name="Disbursement Date" placeholder="disbursement-date">
				</div>
			</div>
            <input type="button" name="previous" class="previous action-button" value="Previous" />
            <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset class="big-table">
            <div class="big-table">
                <div class="row">
                    <div class="col-md-4 head-tab" style="margin-top:1px;">Loan Terms</div>
                    <div class="col-md-6 head-box"style="margin-top:25px;">Can This Amount Increase After Closing?</div>
                </div>
                <div class="row table-body">
                    <div class="col-md-4 table-head">Loan Amount</div>
                    <div class="col-md-3 les-input">
                        <input type="text" value="" placeholder="Loan Amount" class="form-control les-input"></input>
                    </div>
                    <div class="col-md-3 variable-amount">NO</div>
                </div>
                <div class="row table-body">
                    <div class="col-md-4 table-head">Interest Rate</div>
                    <div class="col-md-3 les-input">
                        <input type="text" value="" placeholder="Interest Rate" class="form-control les-input"></input>
                    </div>
                    <div class="col-md-3 variable-amount">NO</div>
                </div>
                <div class="row table-body">
                    <div class="col-md-4 table-head">Monthly Principle & Interest</div>
                    <div class="col-md-3 les-input">
                        <input type="text" value="" name="monthly" placeholder="Monthly Principle" class="form-control les-input"></input>
                    </div>
                    <div class="col-md-3 variable-monthly">NO</div>
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-6 head-box no-top-margin">Does The Loan Have These Features?</div>
                </div>
                <div class="row table-body">
                    <div class="col-md-4 table-head">Prepayment Penalty</div>
                    <div class="col-md-3 les-input">
                        <input type="text" value="" placeholder="Prepayment Penalty" class="form-control" />
                    </div>
                    <div class="col-md-3 variable-penalty">NO</div>
                </div>
                <div class="row table-body">
                    <div class="col-md-4 table-head">Balloon Payment</div>
                    <div class="col-md-3 les-input">
                        <input type="text" value="" placeholder="Balloon Payment" class="form-control" />
                    </div>
                    <div class="col-md-3 variable-penalty">NO</div>
                </div>
            </div>
            <input type="button" name="previous" class="previous action-button" value="Previous" />
            <input type="button" name="next" class="next action-button" value="Next" />
			<!--<input type="button" name="Email" class="Email action-button" value="Email" style="float:left;"/>-->
			<!--<input type="button" name="Download" class="Download action-button" value="Download Full Closing Report" style="float:right; width:auto;"/>-->
        </fieldset>
        <fieldset class="big-table">
            <div class="big-table">
                <div class="row">
                    <div class="col-md-4 head-tab">Projected Payments</div>
                </div>
                <div class="row table-body">
                    <div class="col-md-4 table-top-head">Payment Calculations</div>
                    <div class="col-md-4 table-top-head fleft">Years 1-7</div>
                    <div class="col-md-4 table-top-head fright">Years 8-30</div>
                </div>
                <div class="table-group">
                    <div class="row table-body">
                        <div class="col-md-4 table-head">Principal & Interest</div>
                        <div class="col-md-4 variable-years1-principal fleft">$761.78</div>
                        <div class="col-md-4 variable-years2-principal fright">$761.78</div>
                    </div>
                    <div class="row table-body">
                        <div class="col-md-4 table-head">Mortgage Insurance</div>
                        <div class="col-md-4 variable-years1-pmi fleft">+ 82</div>
                        <div class="col-md-4 variable-years2-pmi fright">+ 0</div>
                    </div>
                    <div class="row table-body">
                        <div class="col-md-4 table-head">Estimated Escrow</div>
                        <div class="col-md-4 variable-years1-pmi fleft">+ 206</div>
                        <div class="col-md-4 variable-years2-pmi fright">+ 60</div>
                    </div>
                </div>
                <div class="row table-body">
                    <div class="col-md-4 table-head">Estimated Total Monthly Payment</div>
                    <div class="col-md-4 variable-years1-pmi fleft">$1,050</div>
                    <div class="col-md-4 variable-years2-pmi fright">$968</div>
                </div>
            </div>
            <input type="button" name="previous" class="previous action-button" value="Previous" />
            <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset class="big-table">
            <div class="big-table">
                <div class="row">
                    <div class="col-md-4 head-tab" style="margin-top:11px;">Loan Costs</div>
                    <div class="col-md-4 table-top">Borrower-Paid</div>
                    <div class="col-md-4 table-top-head fleft">At Closing</div>
                    <div class="col-md-4 table-top-head fright">Before Closing</div>
                </div>
                <div class="row table-body">
                    <div class="col-md-4 table-top-head">A. Origination Charges</div>
                    <div class="col-md-4 table-top">$1,802.00</div>
                </div>
                <div class="table-group">
                    <div class="row table-body"></div>
                    <div class="row table-body">
                        <div class="col-md-4 table-head">0.25 % of Loan Amount (Points)</div>
                        <div class="col-md-4 variable-years1-principal fleft">$405.00</div>
                        <div class="col-md-4 variable-years1-principal  fright">$0.00</div>
                    </div>
                    <div class="row table-body">
                        <div class="col-md-4 table-head">Application Fee</div>
                        <div class="col-md-4 variable-years1-pmi fleft">$300.00</div>
                        <div class="col-md-4 variable-years1-pmi fright">$0.00</div>
                    </div>
                    <div class="row table-body">
                        <div class="col-md-4 table-head">Underwriting Fee</div>
                        <div class="col-md-4 variable-years1-pm fleft">$1,097.00</div>
                        <div class="col-md-4 variable-years1-pmi fright">$0.00</div>
                    </div>
                </div>
            </div>
            <input type="button" name="previous" class="previous action-button" value="Previous" />
            <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset class="big-table">
		<div class="big-table table-extras">
                <div class="row">
                    <div class="col-md-4 head-tab">Extra Costs</div>
                </div>
                <div class="row table-body">
                    <div class="col-md-4 table-top-head">Total</div>
                    <div class="col-md-4 table-top costs-total">$1,097.00</div>
                </div>
				<div class="row table-body">
						<div class="col-md-4 table-head" contenteditable="true">Appraisal Fee</div>
                        <!--<div class="col-md-4 variable-" contenteditable="true">$1,097.00</div>-->
						<div class="col-md-4">
						<input type="text" value="" placeholder="$1,097.00" class="form-control variable-extras les-input"></input>
						</div>
						<!--<div class="col-md-2 edit"><button class="edit-item-button" value="1"></button></div>-->
                        <div class="col-md-2 remove" style="float:right;"><button class="remove-item-button" value="1"></button></div>
                </div>
				<div class="row">          
					<a href="#fakelink" class="add-button btn btn-block btn-lg btn-info">Add Row</a>           
                </div>
				
         </div>
            <input type="button" name="previous" class="previous action-button" value="Previous" />
            <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset class="big-table">
            <input type="button" name="previous" class="previous action-button" value="Previous" />
            <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset class="big-table">
        <fieldset class="big-table">
            <input type="button" name="previous" class="previous action-button" value="Previous" />
            <input type="button" name="next" class="next action-button" value="Next" />
        </fieldset>
        <fieldset class="big-table">
            <input type="button" name="previous" class="previous action-button" value="Previous" />
            <input type="submit" name="submit" class="submit action-button" value="Submit" />
        </fieldset>
    </form>

	<script>
	
	//jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches
var cur_index, next_index;

//allow the progress bar to be clickable
$("li").click(function() {
if (animating) return false;
    animating = true;
	
	
	current_fs = $("fieldset").filter(':visible'); //get current fs
	cur_index = $("fieldset").index(next_fs);
	next_index = $(this).attr('id');
	next_fs = $("fieldset").eq(next_index); //get fs clicked on
    
	
	$("#progressbar li").eq(next_index).addClass("active");
		
    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({
        opacity: 0
    }, {
        step: function (now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
                       
            //2. bring next_fs from the right(50%)
            left = (now * 50) + "%";
            //3. increase opacity of next_fs to 1 as it moves in
            opacity = 1 - now;
			if(cur_index < next_index ){ //depends on if clicking forward or backward
			
			scale = 1 - (1 - now) * 0.2; 
            current_fs.css({
                'transform': 'scale(' + scale + ')'
            });
            next_fs.css({
                'left': left,
                    'opacity': opacity
            });
			}
			else{
			//1. scale current_fs down to 100%
			scale = 0.8 + (1 - now) * 0.2;
			current_fs.css({
                'left': left
            });
            next_fs.css({
			
			
                'transform': 'scale(' + scale + ')',
                    'opacity': opacity
            });
			}
        },
        duration: 800,
        complete: function () {
            current_fs.hide();
            animating = false;
        },
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
    });
});

$(".next").click(function () {
    if (animating) return false;
    animating = true;

    current_fs = $(this).parent();
    next_fs = $(this).parent().next();

    //activate next step on progressbar using the index of next_fs
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate({
        opacity: 0
    }, {
        step: function (now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale current_fs down to 80%
            scale = 1 - (1 - now) * 0.2;
            //2. bring next_fs from the right(50%)
            left = (now * 50) + "%";
            //3. increase opacity of next_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({
                'transform': 'scale(' + scale + ')'
            });
            next_fs.css({
                'left': left,
                    'opacity': opacity
            });
        },
        duration: 800,
        complete: function () {
            current_fs.hide();
            animating = false;
        },
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
    });
});

$(".previous").click(function () {
    if (animating) return false;
    animating = true;

    current_fs = $(this).parent();
    previous_fs = $(this).parent().prev();

    //de-activate current step on progressbar
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

    //show the previous fieldset
    previous_fs.show();
    //hide the current fieldset with style
    current_fs.animate({
        opacity: 0
    }, {
        step: function (now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale previous_fs from 80% to 100%
            scale = 0.8 + (1 - now) * 0.2;
            //2. take current_fs to the right(50%) - from 0%
            left = ((1 - now) * 50) + "%";
            //3. increase opacity of previous_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({
                'left': left
            });
            previous_fs.css({
                'transform': 'scale(' + scale + ')',
                    'opacity': opacity
            });
        },
        duration: 800,
        complete: function () {
            current_fs.hide();
            animating = false;
        },
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
    });
});

$(".submit").click(function () {
    return false;
})
	</script>
	<script>
function instantChange(){
	//this will do the instant updates
	//create variables for top inputs
	if($(this).hasClass("money")){
		this.value = accounting.formatMoney(this.value);
	}
	var loan_amount, purcahse_price, loan_term, interest_rate, zip_code;
	loan_amount = $('[name=loan_amount]');
	purchase_price = $('[name=purchase_price]');
	loan_term = $('[name=loan_term]');
	interest_rate = $('[name=interest_rate]');
	zip_code = $('[name=zip_code]');
	
	var variable_flag = "true";
	var top_variables = [loan_amount,purchase_price,loan_term,interest_rate,zip_code];
	//cycle through and check all top inputs have value
	for (var i = 0; i <top_variables.length; i++){
		if (top_variables[i].val() == null || top_variables[i].val() ==""){
		variable_flag = "false";
		}
	}
	
    //if all have value ajax call
	if ( variable_flag === "true"){
	var opts = {
		lines: 9, // The number of lines to draw
		length: 20, // The length of each line
		width: 10, // The line thickness
		radius: 30, // The radius of the inner circle
		corners: 1, // Corner roundness (0..1)
		rotate: 0, // The rotation offset
		direction: 1, // 1: clockwise, -1: counterclockwise
		color: '#27AE60', // #rgb or #rrggbb or array of colors
		speed: 0.8, // Rounds per second
		trail: 60, // Afterglow percentage
		shadow: false, // Whether to render a shadow
		hwaccel: false, // Whether to use hardware acceleration
		className: 'spinner', // The CSS class to assign to the spinner
		zIndex: 2e9, // The z-index (defaults to 2000000000)
		top: 'auto', // Top position relative to parent in px
		left: 'auto' // Left position relative to parent in px
	};
	var target = document.getElementById('top-inputs');
	var spinner = new Spinner(opts).spin(target);
				$.ajax({
										url: 'LES/les_engine.php',

										data: $('.little-table').serializeArray(),
							
										type: "POST",

										dataType: "json",

										success: function(data) {
											//var results = jQuery.parseJSON(data);
											if( data.hasOwnProperty('monthly')){
												$('[name=monthly]').val(data.monthly);
											}
											spinner.stop();
										}
									});
								}
}								
</script>
	
	<script>
	//editable list code
	//delete line
	$( "body" ).on( "click", ".remove-item-button", function() {
		var tableName = $(this).parent().parent().parent()
		$(this).closest("div.row").remove();
		tableName.find("input.variable-extras").trigger("change");
	});
	//add line item
	$(".add-button").click(function(){
		$(this).parent().parent().find("div.table-body:first").after("<div class='row table-body'> <div class='col-md-4 table-head' contenteditable='true'>Edit Fee Name</div> <div class='col-md-4'><input type='text' value='' placeholder='$1,097.00' class='form-control variable-extras les-input'></input></div><div class='col-md-2 remove' style='float:right;'><button class='remove-item-button' value='1'></button></div></div>");
	});
	//edit line item
	$( "body" ).on( "change", ".variable-extras", function() {
	//$(".variable-extras").change(function(){
		$(this).val(accounting.formatMoney($(this).val()));
		var totalRow = $(this).parent().parent().parent().find("div.costs-total");
		var totalValue = 0;
		var rowValues = $(this).parent().parent().parent().find("input");
		rowValues.each(function(i){
			totalValue += accounting.unformat(this.value);
		});
		totalRow[0].innerHTML = accounting.formatMoney(totalValue);
	});
	
	</script>
</div>
<script src="js/accounting.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-select.js"></script>
<script src="js/flatui-checkbox.js"></script>
<script src="js/jquery.tagsinput.js"></script>
<script src="js/jquery.placeholder.js"></script>
<script src="js/bootstrap-switch.js"></script>
<script src="js/application.js"></script>
<script src="js/spin.min.js"></script>
</body>
</html>