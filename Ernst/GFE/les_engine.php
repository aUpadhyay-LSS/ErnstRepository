<?php
//#Implement
//Database connection
//$username="jimboind_demo";
//$password="Test123";
//$database="jimboind_Demo";

include ('les_config.php');

$db = mysql_connect('localhost',$username,$password);
@mysql_select_db($database) or die( "Unable to select database ". mysql_error());

error_reporting(E_ALL);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
	// Initialize Results array with defaults
	$results = array(
		"Username" => null,		//Username, where applicable, input form website, used for user specific fees
		"search_type" => null,		//Source calculator, ie GFE, AC, NY, CFPB
		"monthly" => null,		//Monthly Mortgage Pyment
		"pmi" => 0,			//Monthly PMI Payment
		"pmi_n" => 0,			//PMI stuff
		"balance" => 0,			//Remaining mortgage balance, used for PMI calulations
		"purchase_price" => 0,		//Purchase price (consideration)
		"loan_amount" => 0,		//Loan amount 
		"deposit" =>0,			//Deposit
		"loanterm" => null,		//Loan Term
		"interest_rate" =>0,		//Annual Interest Rate
		"interest_daily" => 0,		//Daily Interest Payment
		"interest_monthly"=> 0,		//Monthly Interest Payment
		"interest_remaining"=>0,	//Interest payment remaining in current month
		"purpose" => null,		//Type of Loan, Binary variable, 1 for purchase, 0 for Refi
		"state" => null,		//State where property is located
		"county" => null,		//County where property is located
		"town" => null,			//Town where property is located
		"zip_code" =>null,		//Zip code of property
		"closingfee" =>0,		//Closing fee, component of Line 1101
		"abstractfee" =>0,		//Abstract Fee, component of Line 1101
		"notaryfee" =>0,		//Notary Fee, component of Line 1101
		"endorsements" =>0,		//Endorsements on Title policy, component of Line 1101 
		"taxresearchfee" =>0,		//Tax Research Fee, component of Line 1101
		"courierfee" =>0,		//Courier Fee, component of Line 1101
		"wirefee" =>0,			//Wire fee, component of Line 1101
		"dischargetracking" =>0,	//Discharge tracking fee, component of Line 1101
		"miscstatefees" =>0,		//Catch-all for miscellaneous state fees, component of line 1101
		"deedfee" =>0,			//Deed Fee, purchase only, component of Line 1201
		"mortgagerecording" =>0,	//Mortgage Recording Fee,  component of Line 1201
		"recordingprocessing" =>0,	//Recording Processing Fee, component of Line 1201
		"dischargemortgage" =>0,	//Mortgage Release Fee, refinance only,  component of Line 1201
		"subordination" =>0,		//Subordination fee, component of Line 1201 (not in use currently)
		"settlementfee" =>0,		//Attorney Settlement Fee, component of Line 1102
		"simissue" =>0,			//Simultaneous issue fee, added to owner's policy for purchases only
		"insurance" =>0,		//Annual Homeowner's insurance, user input
		"RealEstateTaxes" =>0,		//Annual Real Estate Taxes, user input
		"TaxesPaid" =>null,		//Frequency of taxes paid, can be quarterly, semi-annual or annual
		"TaxCert" => 0,			//Tax Certification fee, component of Line 1101 for PA
		"UtilSearch" => 0,		//Utility Search fee, component of Line 1101 for PA
		"TitleOrderOnly" => null,	//Checkbox for Title Order Only searches
		"lender_cost" =>0,		//Summation of Lender costs (Line 803 to 810)
		"line803" =>0,			//Line 803 on HUD, Origination charges, component of lender costs
		"line804" =>0,			//Line 804 on HUD, Appraisal Fee, component of lender costs
		"line805" =>0,			//Line 805 on HUD, Credit Report, component of lender costs	
		"line806" =>0,			//Line 806 on HUD, Tax service, component of lender costs
		"line807" =>0,			//Line 807 on HUD, Flood certification, component of lender costs
		"line808" =>0,			//Line 808 on HUD, customizable output, component of lender costs
		"line808_header" => null,	//Header for Line 808 on HUD, customizable output
		"line809" =>0,			//Line 809 on HUD, customizable output, component of lender costs
		"line809_header" => null,	//Header for Line 809 on HUD, customizable output
		"line810" =>0, 			//Line 810 on HUD, customizable output, component of lender costs
		"line810_header" => null,	//Header for Line 810 on HUD, customizable output	
		"loanpol" =>0,			//Lender's Title Insurance Policy Premium, component of line 1101
		"ownerspol" => 0,		//Owner's Title Insurance Policy Premium, component of line 1101
		"line1001" => 0,		//Line 1001 on HUD, initial escrow deposit
		"line1101" => 0,		//Line 1101 on HUD, Title fees and lender's title insurance
		"line1103" => 0,		//Line 1103 on HUD, Owner's Title Insurance
		"line1201" => 0,		//Line 1201 on HUD, Government recording charges
		"line1203" => 0,		//Line 1203 on HUD, Total of state and county transfer taxes
		"line1205" => 0,		//Line 1205 on HUD, state taxes paid by seller
		"line1301" => 0,		//Line 1301 on HUD, 'Required services you can shop for', miscellaneous state fees
		"tax_adjustment" => 0,		//Component of Line 1001, real estate taxes pro-rated for remainder of current year
		"mortgagetax" => 0,		//Component of Line 1203, state, town specific Mortgage taxes based on loan amount
		"transfertax" => 0,		//Component of Line 1203, state, town specific Deed taxes based on purchase price
		"recordationtax" => 0,		//Component of Line 1203, county specific recordation tax, based on purchase price, only applies for MD
		"statetax" => 0,		//Component of Line 1203, state recordation tax, based on purchase price, only applies for MD
		"monthly_taxes" => 0,		//Monthly real estate taxes
		"monthly_homeowners" => 0,	//Monthly Homeowner's insurance payment
		"monthly_total" =>0,		//Total monthly payment, made up of mortgage payment, homeowner's, real estate taxes and PMI
		"closing_costs" => 0,		//Total closing costs
		"cash_to_close" => 0,		//Cash needed by Buyerat closing, closing costs plus deposit
		"TIP" => 0,			//Total Interest Percent, interest payments as a percentage of loan amount
		"APR" => 0,			//Annual Percentage Rate
		"5YR_total" => 0,		//Total paid in 5 years in principal, interest, PMI and loan costs
		"5YR_principal" => 0,		//Amount of principal paid off in 5 years
		"loan_points_25" =>0,		//Loan points, origination charge
		"residential_mortgage" =>0,	//Residential Mortgage fee, NY specific
		"tirsa81" =>0,			//TIRSA-8.1 Environmental Lien, NY specific
		"waiver_of_arbitration" =>0,	//Waiver of arbitration, NY specific
		"TBP_search" =>0,		//Tax, Bankruptcy, & Patriot Searches, NY specific
		"muni_searches" =>0,		//Municipal Searches, NY specific
		"CEMA_Assignment"  =>0,		//CEMA Assignment Fee, NY specific
		"Satisfaction" =>0,		//Satisfaction, NY Specific
		"DeedRecording"  =>0,		//Deed Recording, NY specific
		"MansionTax" =>0,		//Mansion Tax
		"buyer_total" =>0,		//Total paid by buyer in NY calculation
                "seller_total" =>0,		//Total paid by seller in NY calculation
                "lender_total" =>0,		//Total paid by lender in NY calculation
                "total_estimate" =>0,		//Total paid in NY calculation

                "Product"=>null,              	//Loan Rate Structure (Fixed, Step, Adjustable)
		"Features"=>null,              	//Additional Loan Features
		"DateIssued"=>null,             //Date Loan is Issued
		"LoanType"=>null,              	//Type of Loan (Convention, FHA, VA, other)
		"LoanID"=>null,              	//Loan Identifer, set by client
		"Applicants"=>null,             //Loan Applicants
		"Property"=>null,              	//Address of Property
		"RateLock"=>null,              	//Can the interest rate change?
		"RateLockDate"=>null,           //When rate change is in effect
		
		"Adjustable_Interest"=> array(
			"IndexMargin"=>0,              	//?
			"Initial_Interest_Rate"=>null,  //Initial Interest Rate on Adjustable Rate Loan
			"Min_Interest_Rate"=>null,      //Minimum Interest Rate on Adjustable Rate Loan
			"Max_Interest_Rate"=>null,      //Maximum Interest Rate on Adjustable Rate Loan
			"FirstChange"=>null,            //Date of First Interest Rate Change
			"SubsequentChanges"=>null,      //Date of subsequent interest rate changes
			"FirstChange_Limit"=>null,      //Limit on first interest rate change
			"SubsequentChanges_Limit"=>null), //Limit on subsequent interest rate changes

		"Projected_Payments"=> array(
			"Num_Columns"=>1,                       //Number of Columns in Projected Payments Table, default is 1
                        "PP_Header"=>null,                      //Column 1 Header for Projected Payments table
                        "PP_Header_2"=>null,                    //Column 2 Header for Projected Payments table
                        "PP_Header_3"=>null,                    //Column 3 Header for Projected Payments table
                        "PP_Header_4"=>null,                    //Column 4 Header for Projected Payments table
                        "monthly"=>0,                           //Column 1 Principal & Interest for Projected Payments table
                        "monthly_2"=>0,                         //Column 2 Principal & Interest for Projected Payments table
                        "monthly_3"=>0,                         //Column 3 Principal & Interest for Projected Payments table
                        "monthly_4"=>0,                         //Column 4 Principal & Interest for Projected Payments table
                        "pmi"=>0,                               //Column 1 Mortgage Insurance for Projected Payments table
                        "pmi_2"=>0,                             //Column 2 Mortgage Insurance for Projected Payments table
                        "pmi_3"=>0,                             //Column 3 Mortgage Insurance for Projected Payments table
                        "pmi_4"=>0,                             //Column 4 Mortgage Insurance for Projected Payments table
                        "monthly_escrow"=>0,                    //Column 1 Estimated Escrow for Projected Payments table
                        "monthly_escrow_2"=>0,                  //Column 2 Estimated Escrow for Projected Payments table
                        "monthly_escrow_3"=>0,                  //Column 3 Estimated Escrow for Projected Payments table
                        "monthly_escrow_4"=>0,                  //Column 4 Estimated Escrow for Projected Payments table
                        "monthly_total"=>0,                     //Column 1 Estimated Monthly Payment Total for Projected Payments table
                        "monthly_total_2"=>0,                   //Column 2 Estimated Monthly Payment Total for Projected Payments table
                        "monthly_total_3"=>0,                   //Column 3 Estimated Monthly Payment Total for Projected Payments table
                        "monthly_total_4"=>0,                   //Column 4 Estimated Monthly Payment Total for Projected Payments table
                        "Real_Estate_Tax_Checkbox"=>"checked",  //Projected Payments checkbox to include Real Estate Taxes
                        "Homeowners_Checkbox"=>"checked",       //Projected Payments checkbox to include Home Owner's Insurance
                        "Other_Checkbox"=>"unchecked"),         //Projected Payments checkbox to include Other Costs
                
		"loan_amount_increase"=>null,   //Whether or not loan amount can increase
		"interest_rate_increase"=>null, //Whether or not interest rate can increase
		"monthly_increase"=>null,       //Whether or not monthly payment can increase
		"PrepaymentPenalty"=>0,         //Prepayment Penalty
		"BalloonPayment"=>0,              //Balloon Payment
		"PrepaymentPenalty_Increase"=>null, //Whether or not prepayment can increase
		"BalloonPayment_Increase"=>null, //Whether or not balloon payment can increase
		
		"Adjustable_Payments"=> array(
			"InterestOnlyPayments"=>null,   //Adjustable Payments Table: Interest Only Payments
			"OptionalPayment"=>null,        //Adjustable Payments Table: Optional Payments
			"StepPayment"=>null,            //Adjustable Payments Table: Step Payments
			"SeasonalPayments"=>null,       //Adjustable Payments Table: Seasonal Payments
			"PaymentFirstChange"=>0,        //Adjustable Payments Table: amount of first change to monthly payment
			"PaymentSubsequentChange"=>null,//Adjustable Payments Table: amount of subsequent changes to monthly payment
			"PaymentMaximum"=>0),            //Adjustable Payments Table: maximum monthly payment
		
		"PaidFromLoan"=>null,           //Check yes if closing costs are paid from loan amount
		"DownPayment"=>0,              	//Down payment from borrower
		"BorrowerFunds"=>0,             //Funds for borrower
		"SellerCredits"=>0,             //Seller credits
		
		"Other_Considerations"=> array(
			"Assumption"=>null,             //Assumptions for transfer of property
			"LatePaymentPeriod"=>null,      //Period when late fee is charged
			"LatePaymentFee"=>0,            //Amount of late fee
			"Servicing"=>null,              //Checkbox for who services loan
			"SelectConsiderations"=>null),   //Other considerations
		
		"Additional_Loan_Info" => array(
			"Lender_Name"=>null,            //Lender Name
			"Lender_License"=>null,         //Lender NMLS/_License ID
			"LO_Name"=>null,                //Loan Officer #1 Name
			"LO_License"=>null,             //Loan Officer #1  NMLS/_License ID
			"LO_Email"=>null,               //Loan Officer #1 Email
			"LO_Phone"=>null,               //Loan Officer #1 Phone Number
			"Broker_Name"=>null,            //Mortgage Broker Name
			"Broker_License"=>null,         //Mortgage Broker  NMLS/_License ID
			"LO_Name2"=>null,               //Loan Officer #2 Name
			"LO_License2"=>null,            //Loan Officer #2  NMLS/_License ID
			"LO_Email2"=>null,              //Loan Officer #2 Email
			"LO_Phone2"=>null),              //Loan Officer #2 Phone Number
		
		"PropertyType" => null,		//Property Type, NY only
		"InsuranceType" =>null,		//InsuranceType, NY only

		"Loan_Costs" => array(
		    "ApplicationFee" => 0,
                    "AppraisalFee" => 0,
                    "AppraisalFieldReviewFee" => 0,
                    "AssumptionFee" => 0,
                    "AutomatedUnderwritingFee" => 0,
                    "AVMFee" => 0,
                    "CopyOrFaxFee" => 0,
                    "CourierFee" => 0,
                    "CreditReportFee" => 0,
                    "DocumentPreparationFee" => 0,
                    "ElectronicDocumentDeliveryFee" => 0,
                    "EscrowWaiverFee" => 0,
                    "FilingFee" => 0,
                    "LoanLevelPriceAdjustment" => 0,
                    "LoanOriginationFee" => 0,
                    "LoanOriginatorCompensation" => 0,
                    "ManualUnderwritingFee" => 0,
                    "Other" => 0,
                    "PreclosingVerificationControlFee" => 0,
                    "ProcessingFee" => 0,
                    "RateLockFee" => 0,
                    "ReinspectionFee" => 0,
                    "SubordinationFee" => 0,
                    "TemporaryBuydownAdministrationFee" => 0,
                    "TemporaryBuydownPoints" => 0,
                    "VerificationOfAssetsFee" => 0,
                    "VerificationOfEmploymentFee" => 0,
                    "VerificationOfIncomeFee" => 0,
                    "VerificationOfResidencyStatusFee" => 0,
                    "VerificationOfTaxpayerIdentificationFee" => 0,
                    "VerificationOfTaxReturnFee" => 0,
                    "WireTransferFee" => 0,
                    "ApplicationFee" => 0,
                    "AppraisalDeskReviewFee" => 0,
                    "AppraisalFieldReviewFee" => 0,
                    "AppraisalManagementCompanyFee" => 0,
                    "AsbestosInspectionFee" => 0,
                    "AssumptionFee" => 0,
                    "AutomatedUnderwritingFee" => 0,
                    "AVMFee" => 0,
                    "CopyOrFaxFee" => 0,
                    "CourierFee" => 0,
                    "CreditReportFee" => 0,
                    "DisasterInspectionFee" => 0,
                    "DocumentPreparationFee" => 0,
                    "DryWallInspectionFee" => 0,
                    "ElectricalInspectionFee" => 0,
                    "ElectronicDocumentDeliveryFee" => 0,
                    "EnvironmentalInspectionFee" => 0,
                    "EscrowWaiverFee" => 0,
                    "FilingFee" => 0,
                    "FloodCertification" => 0,
                    "FoundationInspectionFee" => 0,
                    "HomeInspectionFee" => 0,
                    "LeadInspectionFee" => 0,
                    "LendersAttorneyFee" => 0,
                    "ManualUnderwritingFee" => 0,
                    "MoldInspectionFee" => 0,
                    "Other" => 0,
                    "PlumbingInspectionFee" => 0,
                    "PreclosingVerificationControlFee" => 0,
                    "ProcessingFee" => 0,
                    "PropertyInspectionWaiverFee" => 0,
                    "PropertyTaxStatusResearchFee" => 0,
                    "RadonInspectionFee" => 0,
                    "ReinspectionFee" => 0,
                    "RoofInspectionFee" => 0,
                    "SepticInspectionFee" => 0,
                    "SettlementFee" => 0,
                    "SmokeDetectorInspectionFee" => 0,
                    "SubordinationFee" => 0,
                    "TemporaryBuydownAdministrationFee" => 0,
                    "TitleClosingFee" => 0,
                    "TitleClosingProtectionLetterFee" => 0,
                    "TitleDocumentPreparationFee" => 0,
                    "TitleEndorsementFee" => 0,
                    "TitleExaminationFee" => 0,
                    "TitleInsuranceBinderFee" => 0,
                    "TitleLendersCoveragePremium" => 0,
                    "TitleNotaryFee" => 0,
                    "TitleUnderwritingIssueResolutionFee" => 0,
                    "VerificationOfAssetsFee" => 0,
                    "VerificationOfEmploymentFee" => 0,
                    "VerificationOfIncomeFee" => 0,
                    "VerificationOfResidencyStatusFee" => 0,
                    "VerificationOfTaxpayerIdentificationFee" => 0,
                    "VerificationOfTaxReturnFee" => 0,
                    "WaterTestingFee" => 0,
                    "WellInspectionFee" => 0,
                    "WireTransferFee" => 0,
                    "AsbestosInspectionFee" => 0,
                    "AssumptionFee" => 0,
                    "DisasterInspectionFee" => 0,
                    "DryWallInspectionFee" => 0,
                    "ElectricalInspectionFee" => 0,
                    "EnvironmentalInspectionFee" => 0,
                    "FoundationInspectionFee" => 0,
                    "HomeInspectionFee" => 0,
                    "LeadInspectionFee" => 0,
                    "MoldInspectionFee" => 0,
                    "Other" => 0,
                    "PestInspectionFee" => 0,
                    "PlumbingInspectionFee" => 0,
                    "RadonInspectionFee" => 0,
                    "RoofInspectionFee" => 0,
                    "SepticInspectionFee" => 0,
                    "SmokeDetectorInspectionFee" => 0,
                    "SurveyFee" => 0,
                    "TitleClosingProtectionLetterFee" => 0,
                    "TitleDocumentPreparationFee" => 0,
                    "TitleEndorsementFee" => 0,
                    "TitleExaminationFee" => 0,
                    "TitleInsuranceBinderFee" => 0,
                    "TitleLendersCoveragePremium" => 0,
                    "TitleNotaryFee" => 0,
                    "TitleUnderwritingIssueResolutionFee" => 0,
                    "WaterTestingFee" => 0,
                    "WellInspectionFee" => 0,
                    "AsbestosInspectionFee" => 0,
                    "CondominiumAssociationDues" => 0,
                    "CondominiumAssociationSpecialAssessment" => 0,
                    "CooperativeAssociationDues" => 0,
                    "CooperativeAssociationSpecialAssessment" => 0,
                    "CreditDisabilityInsurancePremium" => 0,
                    "CreditLifeInsurancePremium" => 0,
                    "CreditPropertyInsurancePremium" => 0,
                    "CreditUnemploymentInsurancePremium" => 0,
                    "DebtCancellationInsurancePremium" => 0,
                    "DisasterInspectionFee" => 0,
                    "DryWallInspectionFee" => 0,
                    "ElectricalInspectionFee" => 0,
                    "EnvironmentalInspectionFee" => 0,
                    "FoundationInspectionFee" => 0,
                    "HomeInspectionFee" => 0,
                    "HomeownersAssociationDues" => 0,
                    "HomeownersAssociationSpecialAssessment" => 0,
                    "HomeWarrantyFee" => 0,
                    "LeadInspectionFee" => 0,
                    "MoldInspectionFee" => 0,
                    "MunicipalLienCertificateFee" => 0,
                    "Other" => 0,
                    "PestInspectionFee" => 0,
                    "PlumbingInspectionFee" => 0,
                    "RadonInspectionFee" => 0,
                    "RealEstateCommissionBuyersBroker" => 0,
                    "RealEstateCommissionSellersBroker" => 0,
                    "ReconveyanceFee" => 0,
                    "RoofInspectionFee" => 0,
                    "SepticInspectionFee" => 0,
                    "SmokeDetectorInspectionFee" => 0,
                    "TitleOwnersCoveragePremium" => 0,
                    "WaterTestingFee" => 0,
                    "WellInspectionFee" => 0)
	);

	//Initialize these so errors aren't thrown

	$TitleOnly=0;
	$TaxesPaid = 3;
	$Search_Type = null;

	
    //declare variables that are going to be returned
	
	//User name
	if(isset($_POST['Username']))
	{
	$results['Username'] = $_POST['Username'];
	}
	
	//Settlement Date
	if(isset($_POST['date']))
	{
		$SettlementDate = $_POST['date'];
	}
	//Search Type
	if(isset($_POST['search_type']))
	{
	$Search_Type = $_POST['search_type'];
	$results['search_type'] = $_POST['search_type'];
	}
	else {$Search_Type="CFPB";}
        
	if(isset($_POST['loan_amount']))
	{
	$Loan_Amount = intval($_POST['loan_amount']);
	$results['loan_amount']= intval($_POST['loan_amount']);
	}
	else { $Loan_Amount=null;}
	
	if(isset($_POST['purchase_price']))
	{
	$Purchase_Price = intval($_POST['purchase_price']);
	$results['purchase_price']= intval($_POST['purchase_price']);
	}
	else {$Purchase_Price = null;}
	
	if(isset($_POST['zip_code'])){ $results['zip_code'] = $_POST['zip_code'];}
	
        // Fix
	if(isset($_POST['loanterm'])){	$results['loanterm']=$_POST['loanterm'];}
	if(isset($_POST['loan_term'])){	$results['loanterm']=$_POST['loan_term'];}
        
	//Interest Rate on Loan	
	if(isset($_POST['interest_rate'])){ $results['interest_rate']=$_POST['interest_rate'];} 
	
	//Existing Debt
	if(isset( $_POST['exdebt'])){ $results['exdebt'] = $_POST['exdebt'];
	$ExDebt = $_POST['exdebt'];}
	else{$ExDebt = 0;}
	
	//Down Payment
	if(isset( $_POST['deposit'])){ $results['deposit'] =  $_POST['deposit'];}

	//Annual Insurance
	if(isset( $_POST['insurance'])){ $results['insurance'] =  $_POST['insurance'];}

	//Annual Real Estate Taxes
	if(isset( $_POST['RealEstateTaxes'])){ $results['RealEstateTaxes']  =  $_POST['RealEstateTaxes'];}

	//Taxes Paid
	if(isset( $_POST['TaxesPaid'])){ $results['TaxesPaid']  =  $_POST['TaxesPaid'];}

	//Title Order Only
	if(isset( $_POST['TitleOrderOnly'])){ $results['TitleOrderOnly']  =  $_POST['TitleOrderOnly'];
	$TitleOnly=1;}
	else {$TitleOnly=0;}
	
	//Mansion Tax Indicator
	if(isset( $_POST['mansion']))
	{ 
	$Mansion = $_POST['mansion'];
	}
	else {$Mansion="";}

	//First Time Home Buyer
	if(isset( $_POST['FirstTime'])){ $FirstTime  =  1;}
	else {$FirstTime = 0;}

	//Principle Residence
	if(isset( $_POST['PrincipleResidence'])){ $PrincipleResidence  =  1;}
	else {$PrincipleResidence = 0;}
	
	//ReIssue Rate
	if(isset($_POST['ReissueRate'])){ $ReissueRate = $_POST['ReissueRate'];}
	else {$ReissueRate = null;}
	
	if(isset($_POST['purpose'])){
	$results['purpose']=$_POST['purpose'];
	$purchase = $_POST['purpose'];
	}
	
	if(isset( $_POST['Product'])){ $results['Product'] = $_POST['Product'];}
	if(isset( $_POST['Features'])){ $results['Features'] = $_POST['Features'];}
	if(isset( $_POST['DateIssued'])){ $results['DateIssued'] = $_POST['DateIssued'];}
	if(isset( $_POST['LoanType'])){ $results['LoanType'] = $_POST['LoanType'];}
	if(isset( $_POST['LoanID'])){ $results['LoanID'] = $_POST['LoanID'];}
	if(isset( $_POST['Applicants'])){ $results['Applicants'] = $_POST['Applicants'];}
	if(isset( $_POST['Property'])){ $results['Property'] = $_POST['Property'];}
	if(isset( $_POST['RateLock'])){ $results['RateLock'] = $_POST['RateLock'];}
	if(isset( $_POST['RateLockDate'])){ $results['RateLockDate'] = $_POST['RateLockDate'];}
	if(isset( $_POST['IndexMargin'])){ $results['IndexMargin'] = $_POST['IndexMargin'];}
	if(isset( $_POST['Initial_Interest_Rate'])){ $results['Initial_Interest_Rate'] = $_POST['Initial_Interest_Rate'];}
	if(isset( $_POST['Min_Interest_Rate'])){ $results['Min_Interest_Rate'] = $_POST['Min_Interest_Rate'];}
	if(isset( $_POST['Max_Interest_Rate'])){ $results['Max_Interest_Rate'] = $_POST['Max_Interest_Rate'];}
	if(isset( $_POST['FirstChange'])){ $results['FirstChange'] = $_POST['FirstChange'];}
	if(isset( $_POST['SubsequentChanges'])){ $results['SubsequentChanges'] = $_POST['SubsequentChanges'];}
	if(isset( $_POST['FirstChange_Limit'])){ $results['FirstChange_Limit'] = $_POST['FirstChange_Limit'];}
	if(isset( $_POST['SubsequentChanges_Limit'])){ $results['SubsequentChanges_Limit'] = $_POST['SubsequentChanges_Limit'];}
	if(isset( $_POST['loan_amount_increase'])){ $results['loan_amount_increase'] = $_POST['loan_amount_increase'];}
	if(isset( $_POST['interest_rate_increase'])){ $results['interest_rate_increase'] = $_POST['interest_rate_increase'];}
	if(isset( $_POST['monthly_increase'])){ $results['monthly_increase'] = $_POST['monthly_increase'];}
	if(isset( $_POST['PrepaymentPenalty'])){ $results['PrepaymentPenalty'] = $_POST['PrepaymentPenalty'];}
	if(isset( $_POST['BalloonPayment'])){ $results['BalloonPayment'] = $_POST['BalloonPayment'];}
	if(isset( $_POST['PrepaymentPenalty_Increase'])){ $results['PrepaymentPenalty_Increase'] = $_POST['PrepaymentPenalty_Increase'];}
	if(isset( $_POST['BalloonPayment_Increase'])){ $results['BalloonPayment_Increase'] = $_POST['BalloonPayment_Increase'];}
	if(isset( $_POST['InterestOnlyPayments'])){ $results['InterestOnlyPayments'] = $_POST['InterestOnlyPayments'];}
	if(isset( $_POST['OptionalPayment'])){ $results['OptionalPayment'] = $_POST['OptionalPayment'];}
	if(isset( $_POST['StepPayment'])){ $results['StepPayment'] = $_POST['StepPayment'];}
	if(isset( $_POST['SeasonalPayments'])){ $results['SeasonalPayments'] = $_POST['SeasonalPayments'];}
	if(isset( $_POST['PaymentFirstChange'])){ $results['PaymentFirstChange'] = $_POST['PaymentFirstChange'];}
	if(isset( $_POST['PaymentSubsequentChange'])){ $results['PaymentSubsequentChange'] = $_POST['PaymentSubsequentChange'];}
	if(isset( $_POST['PaymentMaximum'])){ $results['PaymentMaximum'] = $_POST['PaymentMaximum'];}
	if(isset( $_POST['PaidFromLoan'])){ $results['PaidFromLoan'] = $_POST['PaidFromLoan'];}
	if(isset( $_POST['DownPayment'])){ $results['DownPayment'] = $_POST['DownPayment'];}
	if(isset( $_POST['BorrowerFunds'])){ $results['BorrowerFunds'] = $_POST['BorrowerFunds'];}
	if(isset( $_POST['SellerCredits'])){ $results['SellerCredits'] = $_POST['SellerCredits'];}
	if(isset( $_POST['Assumption'])){ $results['Assumption'] = $_POST['Assumption'];}
	if(isset( $_POST['LatePaymentPeriod'])){ $results['LatePaymentPeriod'] = $_POST['LatePaymentPeriod'];}
	if(isset( $_POST['LatePaymentFee'])){ $results['LatePaymentFee'] = $_POST['LatePaymentFee'];}
	if(isset( $_POST['Servicing'])){ $results['Servicing'] = $_POST['Servicing'];}
	if(isset( $_POST['SelectConsiderations'])){ $results['SelectConsiderations'] = $_POST['SelectConsiderations'];}
	if(isset( $_POST['Lender_Name'])){ $results['Lender_Name'] = $_POST['Lender_Name'];}
	if(isset( $_POST['Lender_License'])){ $results['Lender_License'] = $_POST['Lender_License'];}
	if(isset( $_POST['LO_Name'])){ $results['LO_Name'] = $_POST['LO_Name'];}
	if(isset( $_POST['LO_License'])){ $results['LO_License'] = $_POST['LO_License'];}
	if(isset( $_POST['LO_Email'])){ $results['LO_Email'] = $_POST['LO_Email'];}
	if(isset( $_POST['LO_Phone'])){ $results['LO_Phone'] = $_POST['LO_Phone'];}
	if(isset( $_POST['Broker_Name'])){ $results['Broker_Name'] = $_POST['Broker_Name'];}
	if(isset( $_POST['Broker_License'])){ $results['Broker_License'] = $_POST['Broker_License'];}
	if(isset( $_POST['LO_Name2'])){ $results['LO_Name2'] = $_POST['LO_Name2'];}
	if(isset( $_POST['LO_License2'])){ $results['LO_License2'] = $_POST['LO_License2'];}
	if(isset( $_POST['LO_Email2'])){ $results['LO_Email2'] = $_POST['LO_Email2'];}
	if(isset( $_POST['LO_Phone2'])){ $results['LO_Phone2'] = $_POST['LO_Phone2'];}

	if(isset( $_POST['PropertyType'])){ $results['PropertyType'] = $_POST['PropertyType'];}
	if(isset( $_POST['InsuranceType'])){ $results['InsuranceType'] = $_POST['InsuranceType'];}
        
	//End Variable intake
	
    //Build if statements from lowest to highest

	//Start with basic inputs. Populate from summary box to fields
	if(isset($Loan_Amount))
	{
		$results['loanamount']=$Loan_Amount;
		$results['loan_points_25']= round($Loan_Amount*.0025);
	}
	
	if(isset($_POST['state']))
	{$state = $_POST['state'];
	$results['state'] = $_POST['state'];
	}
	
	if(isset($_POST['county']))
	{
	$county = $_POST['county'];
	$results['county'] = $_POST['county'];
	}
	
	if(isset($_POST['township']))
	{
	$town = $_POST['township'];
	$results['town'] = $_POST['township'];
	}

	//Prior Insurance
	if(isset($_POST['prior_insurance'])){ $PriorInsurance = $_POST['prior_insurance'];}
	else {$PriorInsurance = 0;}
	
	//Principal Balance
	if(isset($_POST['Principalbalance'])){ $PrincipalBalance = $_POST['Principalbalance'];}
	else {$PrincipalBalance = 0;}
	
    
	//End Variable Initialization
	
	//Beginning of populating Result sarray
	// Test results
       
        
        
	//zip code to get state, county and township
	if(isset($_POST['zip_code']) && !empty($_POST['zip_code']) && !isset($_POST['state'])){
	$query = "SELECT state, county, town FROM zip_code WHERE (zipcode =  '".$_POST['zip_code']."')";
	$zip = mysql_fetch_array(mysql_query($query));	
	
	$results['state'] = $zip[0];
	$state = $zip[0];
	$results['county'] = $zip[1];
	$county = $zip[1];
	$results['town'] = $zip[2];
	$town = $zip[2];
	}
    
	//Tax Adjustment
	//Annual Real Estate Taxes
	if(isset( $_POST['RealEstateTaxes']) && isset( $_POST['date']) && $Search_Type=="AC")
	{
		$results['tax_adjustment']  = round($results['RealEstateTaxes']*(date("z", strtotime($SettlementDate)) + 1)/365);
	}    
    
    
	//Monthly Amortization function
	if(isset($results['loanterm']) && isset($Loan_Amount) && isset($results['interest_rate']) && ($Search_Type=="AC" || $Search_Type=="CFPB")){
		$results['monthly'] = monthlyCost($Loan_Amount,$results['interest_rate'],$results['loanterm']);
	}
	
	//Interest Calculations
	if(isset($results['interest_rate']) && isset($Loan_Amount) && ($Search_Type=="AC" || $Search_Type=="CFPB")){
	$results['interest_daily']= round($Loan_Amount)*(($results['interest_rate']/100)/360);
	$results['interest_monthly']= round($Loan_Amount)*(($results['interest_rate']/100)/12);
	
	//Calculate monthly interest and amount remaing due for the given month
	$Interest = round($results['interest_daily']*(cal_days_in_month(CAL_GREGORIAN, substr($SettlementDate,0,2), substr($SettlementDate,6,4))-substr($SettlementDate,3,2)));

	//Settlement Date defaults to today if invalid
	if(!is_numeric($Interest) || $Interest <0){
	$SettlementDate= Date("m/d/Y");
	$Interest = round($results['interest_daily']*(cal_days_in_month(CAL_GREGORIAN, substr($SettlementDate,0,2), substr($SettlementDate,6,4))-substr($SettlementDate,3,2)));
	}
	$results['interest_remaining'] = $Interest;
	//End interest calculations

	
	}// End Interest Calculations
	
     //Monthly PMI Calculations	
	if(isset($results['monthly']) && isset($results['interest_rate']) && isset($Purchase_Price)){
		$PMIarray = pmiMonthlyCal($Loan_Amount, $Purchase_Price,$results['interest_rate'],$results['monthly']);
		$results['pmi'] = $PMIarray[0];
		$results['pmi_n']= $PMIarray[1];
		$results['balance']= $PMIarray[2];
		
		//Set Monthly totals
		
		$results['monthly_taxes']= $results['RealEstateTaxes']/12; 
		$results['monthly_homeowners']= $results['insurance']/12; 
		
		
		//sets total monthly payment for first column
		$results['monthly_total']= $results['pmi'] + $results['monthly'] + $results['monthly_taxes'] + $results['monthly_homeowners'];
	
        //Function for projected payments table
        //$ProjectedPayments = ProjectedPayments();
        //$results['Projected_Payments']['Num_Columns'] = $ProjectedPayments[0];
        //$results['Projected_Payments']['PP_Header'] = $ProjectedPayments[1];
        //$results['Projected_Payments']['PP_Header_2'] = $ProjectedPayments[2];
        //$results['Projected_Payments']['PP_Header_3'] = $ProjectedPayments[3];
        //$results['Projected_Payments']['PP_Header_4'] = $ProjectedPayments[4];
        //$results['Projected_Payments']['monthly'] = $ProjectedPayments[5];
        //$results['Projected_Payments']['monthly_2'] = $ProjectedPayments[6];
        //$results['Projected_Payments']['monthly_3'] = $ProjectedPayments[7];
        //$results['Projected_Payments']['monthly_4'] = $ProjectedPayments[8];
        //$results['Projected_Payments']['pmi'] = $ProjectedPayments[9];
        //$results['Projected_Payments']['pmi_2'] = $ProjectedPayments[10];
        //$results['Projected_Payments']['pmi_3'] = $ProjectedPayments[11];
        //$results['Projected_Payments']['pmi_4'] = $ProjectedPayments[12];
        //$results['Projected_Payments']['monthly_escrow'] = $ProjectedPayments[13];
        //$results['Projected_Payments']['monthly_escrow_2'] = $ProjectedPayments[14];
        //$results['Projected_Payments']['monthly_escrow_3'] = $ProjectedPayments[15];
        //$results['Projected_Payments']['monthly_escrow_4'] = $ProjectedPayments[16];
        //$results['Projected_Payments']['monthly_total'] = $ProjectedPayments[17];
        //$results['Projected_Payments']['monthly_total_2'] = $ProjectedPayments[18];
        //$results['Projected_Payments']['monthly_total_3'] = $ProjectedPayments[19];
        //$results['Projected_Payments']['monthly_total_4'] = $ProjectedPayments[20];
        //$results['Projected_Payments']['Real_Estate_Tax_Checkbox'] = $ProjectedPayments[21];
        //$results['Projected_Payments']['Homeowners_Checkbox'] = $ProjectedPayments[22];
        //$results['Projected_Payments']['Other_Checkbox'] = $ProjectedPayments[23];

        	
	}
	//Lender Specific Fees
	if(isset($results['state']) && ($Search_Type=="AC" || $Search_Type=="CFPB")){
	
	
	$LenderArray = Lender_Rates($state,$results['Username']);
	$results['lender_cost'] = $LenderArray[0];
	$results['line803'] = $LenderArray[1];
	$results['line804'] = $LenderArray[2];
	$results['line805'] = $LenderArray[3];
	$results['line806'] = $LenderArray[4];
	$results['line807'] = $LenderArray[5];
	$results['line808'] = $LenderArray[6];
	$results['line808_header'] = $LenderArray[7];
	$results['line809'] = $LenderArray[8];
	$results['line809_header'] = $LenderArray[9];
	$results['line810'] = $LenderArray[10];
	$results['line810_header'] = $LenderArray[11];
	}
	
	
	//Line 1101 & Line1201 & Line1203 & Title Insurance calculations for all search types
	if(isset($results['state']) && isset($Loan_Amount)){
	
	$TitleFees = Line1101_1201_1203($results['state'],$purchase,$results['county'],$results['town'],$_POST['purchase_price'],$Loan_Amount, $ExDebt,$FirstTime, $PrincipleResidence, $TitleOnly,$Mansion);	
	
    $results['closingfee'] = $TitleFees[0];
	$results['abstractfee'] = $TitleFees[1];
	$results['notaryfee'] = $TitleFees[2];
	$results['endorsements'] = $TitleFees[3];
	$results['taxresearchfee'] = $TitleFees[4];
	$results['courierfee'] = $TitleFees[5];
	$results['wirefee'] = $TitleFees[6];
	$results['deedfee'] = $TitleFees[7];
	$results['mortgagerecording'] = $TitleFees[8];
	$results['recordingprocessing'] = $TitleFees[9];
	$results['dischargetracking'] = $TitleFees[10];
	$results['miscstatefees'] = $TitleFees[11];
	$results['dischargemortgage'] = $TitleFees[12];
	$results['settlementfee'] = $TitleFees[13];
	$results['simissue'] = $TitleFees[14];
	$results['line1201'] = $TitleFees[15];
	$results['line1203'] = $TitleFees[16];
	$results['line1301'] = $TitleFees[17];
	$results['mortgagetax'] = $TitleFees[18];
	$results['transfertax'] = $TitleFees[19];
	$results['recordationtax'] = $TitleFees[20];
	$results['statetax'] = $TitleFees[21];
	$results['TaxCert'] = $TitleFees[22];
	$results['UtilSearch'] = $TitleFees[23];
	$results['line1101'] = $TitleFees[24];
	$Zone = $TitleFees[25];
	//Loan and Owner's Policy Calculations

	$TitlePremiums = TitlePremiums($results['state'],$results['county'],$Loan_Amount,$Purchase_Price,$ExDebt,$purchase,$results['simissue'],$ReissueRate, $Search_Type,$Zone);
	$results['loanpol'] = $TitlePremiums[0];
	$results['ownerspol'] = $TitlePremiums[1];
	
	// Line1103 is 0 for purchases
	$results['line1103'] = $purchase*$TitlePremiums[1];
	
	$results['line1101'] = $results['line1101'] + $results['loanpol'];
	
	
	//$results['line1101'] = round($results['closingfee'] + $results['abstractfee'] + $results['notaryfee'] + $results['loanpol'] + $results['endorsements']
	//	+ $results['taxresearchfee'] + $results['courierfee'] + $results['wirefee'] + $results['recordingprocessing']
	//	+ $results['dischargetracking'] + $results['settlementfee'] + $results['TaxCert'] + $results['UtilSearch']);

	
	}
	
	//Setting closing costs and cost to close
	if($Search_Type=="AC" || $Search_Type=="CFPB"){
		
	
	
	$results['line1001'] =  round($results['pmi']/4+ $results['insurance']/4 + $results['tax_adjustment']);
	
	$results['closing_costs'] = round($results['lender_cost'] + $results['insurance'] + $results['line1001'] + $results['line1101']+ $results['line1103'] + $results['line1201'] + $results['line1203'] + $results['interest_monthly']);
	$results['cash_to_close'] = $Purchase_Price + $results['closing_costs'] - $Loan_Amount;
	}
	
	//Seller Taxes for Line 1205
	if(isset($Purchase_Price) && isset($state) && isset($county) && $purchase==1){
	$results['line1205'] = Line_1205($Purchase_Price, $state, $county, $town);	
	
        if($state=="MD")
        {
            $results['line1203'] = $results['line1203']/2;
            $results['line1205'] = $results['line1203'];
        }
        
        }
        
	//NY CEMA Calculations
	if($Search_Type=="CEMA" || $results['state']=="NY"){
	$results['residential_mortgage']=25;
	$results['tirsa81']=25;
	$results['waiver_of_arbitration']=25;
	$results['TBP_search']=150;
	$results['muni_searches']=350;
	$results['courierfee']=50;
	$results['wirefee']=50;
	$results['recordingprocessing']=75;
	
	//Updated Recording Fees
	$results['mortgagerecording'] = 200;
	$results['CEMA_Assignment'] = 350;
	$results['Satisfaction'] = 75;
	$results['DeedRecording'] = 325;

	//Sets Condo Endorsement to $25 only if a condo is selected
	if($results['PropertyType']=="Condo"){$results['CondoEndorsement']=25;}
	else {$results['CondoEndorsement']=0;}
	
	$results['mortgagetax'] = round(.0025*(max(0,($Loan_Amount-$PrincipalBalance))));
	
	if ($Purchase_Price > 1000000 && ($results['PropertyType']=="1-2 Family" || $results['PropertyType']=="3 Family" || isset( $_POST['mansion'])))
	{
	$results['MansionTax'] = .01*$Purchase_Price;
	}
	
	$NY_Fees = NY_Counties($county, $town, $Loan_Amount,$PrincipalBalance,$Purchase_Price,$purchase, $TitleOnly, $PriorInsurance, $results['InsuranceType']);
	
	$results['line1203'] = $NY_Fees[0];
	$results['transfertax'] = $NY_Fees[1];
	$results['loanpol'] = $NY_Fees[2];
	$results['ownerspol'] = $NY_Fees[3];
	$results['settlementfee'] = $NY_Fees[4];
	$results['county'] = $NY_Fees[5];
	$results['town'] = $NY_Fees[6];
	
	//ownerspol to line value
	$results['line1103'] = $results['ownerspol'];
  
        if($results['InsuranceType']=="Refinance" || ($Search_Type=="AC" && $purchase==0))
        {
            $results['line1101'] = round($results['loanpol']+ $results['residential_mortgage'] + $results['tirsa81'] + $results['waiver_of_arbitration'] + $results['CondoEndorsement'] + $results['TBP_search']+
            $results['courierfee'] + $results['wirefee'] + $results['recordingprocessing'] + $results['settlementfee']);
            $results['line1103'] = round($purchase*$results['ownerspol']);
            $results['line1201'] = round($results['mortgagerecording'] + $results['Satisfaction']);
            
            
            $results['buyer_total'] = round($results['loanpol'] + $results['residential_mortgage'] + $results['tirsa81'] + $results['waiver_of_arbitration'] + $results['CondoEndorsement'] + $results['TBP_search']+
            $results['courierfee'] + $results['wirefee'] + $results['recordingprocessing'] + $results['settlementfee']+ $results['line1201']+$results['line1203']);

            $results['seller_total'] = 0;
            $results['lender_total'] = $results['mortgagetax'];
            $results['total_estimate']  = $results['buyer_total'] + $results['seller_total'] + $results['lender_total'];
        } //end Refinance

        elseif($results['InsuranceType']=="Purchase" || ($Search_Type=="AC" && $purchase==1))
        {
            $results['line1101'] = round($results['loanpol']+ $results['residential_mortgage'] + $results['tirsa81'] + $results['waiver_of_arbitration'] + $results['CondoEndorsement'] + $results['TBP_search']+
            $results['courierfee'] + $results['wirefee'] + $results['recordingprocessing'] + $results['muni_searches']);
            
            $results['line1103'] = round($purchase*$results['ownerspol']);
            $results['line1201'] = round($results['mortgagerecording'] + $results['CEMA_Assignment']);
            
            
            $results['buyer_total']  =$results['ownerspol']+$results['loanpol']+ $results['residential_mortgage'] + $results['tirsa81'] + $results['waiver_of_arbitration'] + $results['CondoEndorsement'] + $results['TBP_search']+
            $results['settlementfee']+$results['courierfee']+$results['wirefee']+$results['recordingprocessing']+$results['DeedRecording']+$results['mortgagerecording']+$results['line1203'] +$results['MansionTax'];
            
            $results['seller_total'] = $results['Satisfaction'] + $results['transfertax'];
            $results['lender_total'] = $results['mortgagetax'];
            $results['total_estimate'] = $results['buyer_total'] + $results['seller_total'] + $results['lender_total'];
        }

        elseif($results['InsuranceType']=="Refinance_CEMA")
        {
            $results['line1101'] = round($results['loanpol']+ $results['residential_mortgage'] + $results['tirsa81'] + $results['waiver_of_arbitration'] + $results['CondoEndorsement'] + $results['TBP_search']+
                              $results['courierfee'] + $results['wirefee'] + $results['recordingprocessing'] + $results['settlementfee']);
            
            $results['line1103'] = round($purchase*$results['ownerspol']);
            $results['line1201'] = round($results['mortgagerecording'] + $results['CEMA_Assignment'] + $results['Satisfaction']);
             
            $results['buyer_total'] = round($results['loanpol'] + $results['residential_mortgage'] + $results['tirsa81'] + $results['waiver_of_arbitration'] + $results['CondoEndorsement'] + $results['TBP_search']+
                                  $results['courierfee'] + $results['wirefee'] + $results['recordingprocessing'] + $results['settlementfee']+ $results['line1201']+$results['line1203']);
            $results['seller_total']=0;
            $results['lender_total'] = $results['mortgagetax'];
            $results['total_estimate'] = $results['buyer_total'] + $results['seller_total'] + $results['lender_total'];
        } //end CEMA Refinance

        elseif($results['InsuranceType']=="Fee Insurance")
        {
            $results['line1101'] = round($results['TBP_search']+$results['courierfee'] + $results['wirefee'] + $results['recordingprocessing'] + $results['muni_searches']);
            $results['line1103'] = round($purchase*$results['ownerspol']);
            $results['line1201'] = round($results['DeedRecording']);
            $results['line1203'] = 0;
            
            $results['buyer_total'] = $results['ownerspol']+$results['TBP_search']+$results['settlementfee'] +$results['courierfee'] + $results['wirefee'] + $results['recordingprocessing']+
            $results['DeedRecording']+$results['MansionTax'];
            
            $results['seller_total'] = $results['transfertax'];
            $results['lender_total'] = $results['mortgagetax'];
            $results['total_estimate'] = $results['buyer_total'] + $results['seller_total'] + $results['lender_total'];
        }// End Fee insurance


        
	}// End CEMA
	
	if($Search_Type=="COMM"){
	
	//Hardcoding endorsements for commercial calculator	
	$results['endorsements']=650;
	 
	}
	
// SQL Statement Insert to Search History

// Search Count
$SearchQuery = mysql_fetch_array(mysql_query("SELECT (count(*)+1) FROM Search_History WHERE Username = '".$results['Username']."'"));  
$SearchCount = $SearchQuery[0];

//Insert record into Search_History Table
switch($Search_Type){
case "AC":    

$insert = "INSERT INTO `Search_History`(`State`,`SearchType`, `Username`, `LoanType`,`SearchCount`, `Buyer`, `Address`,`Lender`, `Seller`, `SettlementDate`, `County`, `Township`, `SalesPrice`, `Deposit`, `LoanAmount`, `InterestRate`, `LoanTerm`,
`AnnTaxes`, `TaxesPaid`, `HomeOwners`, `TotalPremiums`)
VALUES ('".$results['state']."','".$Search_Type."','".$results['Username']."',".$purchase.",".$SearchCount.",'".$_POST['buyer']."','".$_POST['address']."','".$_POST['lender']."','".$_POST['seller']."','".$_POST['date']."','".$results['county']."','".$results['town']."',".$results['purchase_price'].
",".$results['deposit'].",".$results['loan_amount'].",".$results['interest_rate'].",".$results['loanterm'].",".$results['RealEstateTaxes'].",".$results['TaxesPaid'].",".$results['insurance'].",".($results['loanpol']+$results['ownerspol']).")";

mysql_query($insert);
break;

case "CEMA":
    
$insert = "INSERT INTO `Search_History`(`SearchType`, `Username`, `LoanType`,`SearchCount`, `State`, `County`, `Township`, `TitleOrderOnly`, `SalesPrice`, `LoanAmount`,`InsuranceType`,`PropertyType`,`PriorInsurance`,
`PrincipalBalance`, `TotalPremiums`)
VALUES ('".$Search_Type."','".$results['Username']."',".$purchase.",".$SearchCount.",'NY', '".$results['county']."', '".$results['town']."','".$results['TitleOrderOnly']."', ".$results['purchase_price'].", ".$results['loan_amount'].", '".
$_POST['InsuranceType']."','".$_POST['PropertyType']."',".$PriorInsurance.",".$PrincipalBalance.",".($results['loanpol']+$results['line1103']).")";

mysql_query($insert);

break;    

case "COMM":
if(isset($_POST['CalculateRate']) || isset($_POST['ReissueRate']))
{
$insert = "INSERT INTO `Search_History`(`SearchType`, `Username`,`SearchCount`,`State`, `County`, `Township`, `LoanType`, `LoanID`, `FileName`, `TitleOrderOnly`, `SalesPrice`, `LoanAmount`, `ExDebt`, `FirstTime`,
 `ReIssue`, `TotalPremiums`)
VALUES ('".$Search_Type."','".$results['Username']."',".$SearchCount.",'".$results['state']."', '".$results['county']."', '".$results['town']."', '".$purchase."', '".$_POST['loanid']."', '".$_POST['filename']."', '".
$results['TitleOrderOnly']."', ".$results['purchase_price'].", ".$results['loan_amount'].", ".$ExDebt.",'".$FirstTime."','".$ReissueRate."',".($results['loanpol']+$results['line1103']).")";

mysql_query($insert);
}
break;

case "GFE":
if($results['state']<>"" && $results['state']<>"NA" && (isset($_POST['CalculateRate']) || isset($_POST['ReissueRate'])) ){

$insert = "INSERT INTO `Search_History`(`SearchType`, `Username`,`SearchCount`,`State`, `County`, `Township`, `LoanType`, `LoanID`, `FileName`, `TitleOrderOnly`, `SalesPrice`, `LoanAmount`, `ExDebt`,
`FirstTime`, `ReIssue`, `TotalPremiums`) VALUES
('".$Search_Type."','".$results['Username']."',".$SearchCount.",'".$results['state']."', '".$results['county']."', '".$results['town']."', '".$purchase."', '".$_POST['loanid']."', '".$_POST['filename']."', '".$results['TitleOrderOnly'].
"', ".$results['purchase_price'].", ".$results['loan_amount'].", ".$ExDebt.",'".$FirstTime."','".$ReissueRate."',".($results['loanpol']+$results['line1103']).")";

mysql_query($insert);
break;

}


    
} // End SQL Switch	
	


if(isset($_POST['EmailQuote']))
{
$insert = "INSERT INTO `Email_Print`(`Username`,`SearchType`,`State`,`LoanType`,`Email` ) VALUES
('".$results['Username']."','".$Search_Type."','".$results['state']."','".$purchase."','".$_POST['EmailQuote']."')";

mysql_query($insert);    
}        
        
//Here I will take all of your variables and build a json or xml file and return it
header("Content-Type: application/json", true);
echo json_encode($results);
}

//Begin functions
	
Function monthlyCost($LoanAmount,$InterestRate,$LoanTerm){
//Monthly Mortgage Payment
$n = 12*$LoanTerm;
$i = (($InterestRate)/100/12);
$amortize = round(($LoanAmount)*(($i*(pow(1+$i,$n)))/(pow(1+$i,$n)-1)));

return $amortize;
}

Function pmiMonthlyCal($loanamount, $purchaseprice,$InterestRate,$monthlyPMT){

//PMI calculations
$LoanToSales = (($loanamount)/($purchaseprice));

$PMI_Rate=0;
$PMI_Check = "Yes";
if($LoanToSales > .95){$PMI_Rate=.0115;}
else if($LoanToSales > .90 && $LoanToSales <= .95){$PMI_Rate=.0067;}
else if($LoanToSales > .85 && $LoanToSales <= .90){$PMI_Rate=.0049;}
else if($LoanToSales > .80 && $LoanToSales < .85){$PMI_Rate=.0032;}
else {$PMI_Rate=0;
$PMI_Check="Off";}

$PMI = $PMI_Rate*($loanamount);
$PMI_monthly = round(($PMI)/12);

$balance = $loanamount;
$monthly_interest =  (($InterestRate)/100/12);
$n=0;

if($PMI_monthly > 0){
while (($balance/$purchaseprice)>.8 && $n<100){

$interestPMT = $balance*$monthly_interest;
$principalPMT = $monthlyPMT - $interestPMT;
$balance = $balance - $principalPMT;
$n = $n +1;	
}
}

return array($PMI_monthly, $n, $balance);
}

Function Line1101_1201_1203($state, $purchase, $county, $township, $salesprice, $loanamount, $ExDebt,$FirstTime, $PrincipleResidence, $TitleOnly, $Mansion){
//SELECT query for State fees
//Lines 1101 and 1201 population

$query = "SELECT * FROM HPC_GFE_Rates WHERE (HPC_GFE_Rates.State =  '".$state."' AND Purchase=".$purchase.")";


//Avanish look from here
$row = mysql_fetch_array(mysql_query($query)); // Takes in array of HPC Rates
 
$ClosingFee = $row[1];
$AbstractFee = $row[2];
$NotaryFee = $row[3];
$Endorsements=$row[4];
$TaxResearchFee=$row[5];
$CourierFee=$row[6];
$WireFee = $row[7];
//$DeedFee = $row[8];
//$MortgageRecording = $row[9];
$RecordingProcessing = $row[10];
$DischargeTracking = $row[11];
$MiscStateFees = $row[12];
//$DischargeMortgage = $row[13];
$SettlementFee = $row[14];
$SimIssue=$row[15];

//Default values
$Line1203 = 0;
$Line1301 = 0;
$MortgageTax = 0;
$TransferTax = 0;
$RecordationTax = 0;
$StateTax = 0;
$TaxCert = 0;
$UtilSearch = 0;
$Line1101_Additional = 0;



$RecordingQuery = "SELECT `Transfer_Tax_State`,`Transfer_Tax_City`,`Mortgage_Tax`,`Deed_Base`,`Deed_Per_Page`,`Deed_Total_Pages`,
`Mortgage_Base`,`Mortgage_Per_Page`,`Mortgage_Total_Pages`,`Release_Base`,`Release_Per_Page`,`Release_Total_Pages`,`Zone`
FROM `HPC_GFE_Recording` WHERE `State` ='".$state."' AND County ='".$county."' AND Town='".$township."'";

$row = mysql_fetch_array(mysql_query($RecordingQuery)); // Takes in array of HPC Rates


if (!isset($row[0]))
{
$RecordingQuery = "SELECT `Transfer_Tax_State`,`Transfer_Tax_City`,`Mortgage_Tax`,`Deed_Base`,`Deed_Per_Page`,`Deed_Total_Pages`,
`Mortgage_Base`,`Mortgage_Per_Page`,`Mortgage_Total_Pages`,`Release_Base`,`Release_Per_Page`,`Release_Total_Pages`,`Zone`
FROM `HPC_GFE_Recording` WHERE `State` ='".$state."' AND County ='".$county."'";

$row = mysql_fetch_array(mysql_query($RecordingQuery)); // Takes in array of HPC Rates
}

if (!isset($row[0]))
{
$RecordingQuery = "SELECT `Transfer_Tax_State`,`Transfer_Tax_City`,`Mortgage_Tax`,`Deed_Base`,`Deed_Per_Page`,`Deed_Total_Pages`,
`Mortgage_Base`,`Mortgage_Per_Page`,`Mortgage_Total_Pages`,`Release_Base`,`Release_Per_Page`,`Release_Total_Pages`,`Zone`
FROM `HPC_GFE_Recording` WHERE `State` ='".$state."' AND County ='NA'";

$row = mysql_fetch_array(mysql_query($RecordingQuery)); // Takes in array of HPC Rates
}

if (!isset($row[0]))
{
$RecordingQuery = "SELECT `Transfer_Tax_State`,`Transfer_Tax_City`,`Mortgage_Tax`,`Deed_Base`,`Deed_Per_Page`,`Deed_Total_Pages`,
`Mortgage_Base`,`Mortgage_Per_Page`,`Mortgage_Total_Pages`,`Release_Base`,`Release_Per_Page`,`Release_Total_Pages`,`Zone`
FROM `HPC_GFE_Recording` WHERE `State` ='".$state."'";

$row = mysql_fetch_array(mysql_query($RecordingQuery)); // Takes in array of HPC Rates
}

$Line1203 = ($purchase * $salesprice * $row[0]) + ($purchase * $salesprice * $row[1]) + ( $loanamount * $row[2]);

$DeedFee = $row[3] + $row[4]*$row[5];
$MortgageRecording = $row[6] + $row[7]*$row[8];
$DischargeMortgage =  $row[9] + $row[10]*$row[11];
$Zone = $row[12];


//state switch
switch($state){
        case "AL":
            $Line1203 = .0015*$loanamount + .001*$purchase*max(0,($salesprice - $loanamount));
        break;
    
        case "DC":
        
        if($salesprice>=400000){$Line1203 = round(.0145*$purchase*$salesprice);}
        else {$Line1203 = round(.011*$purchase*$salesprice);}
        break;

        break;

        case "DE":

            //switch(strtolower($township)){
            //case "farmington":
            //case "hartly":
            //case "little creek":
            //case "woodside":
            //$Line1203 = round($purchase*.01*$salesprice);
            //break;
            //
            //default:
            //$Line1203 = round($purchase*.015*$salesprice);
            //}//end switch

            //Discharge tracking $0 for purchase, abstract fee increases $100 for refis
            //if($purchase==1){ $AbstractFee = round($AbstractFee+100);}

        
        //DE complete
        break;

        case "FL":
        //#Update
        if($purchase==1){
	    $Line1301 = $MiscStateFees;
	}

        $Line1203 = round(.0035*$loanamount) + round(.002*$loanamount); //takes into account intangible tax
        //End FL 
        break;

        case "GA":
         //   $Line1203 = round(.003*$loanamount); 
        break;

        case "KS":
        //    $Line1203=round(.0026*$loanamount);
        break;    
        
        case "MA":
		//#Update
           if($purchase==1){
           $Endorsements=0;
           $ClosingFee=350;}
           
           if($purchase==1 && ($county =='Dukes' || $county =='Nantucket')){
            $Line1203= .02*$salesprice; //represents land bank fee
            $MiscStateFees = 450;
            $Line1301 = $MiscStateFees;
	   }

        break;

        case "MD":

         $query= "SELECT recordation, transfertax, exemption FROM `HPC_MD_Counties` WHERE  County = '".$county."'";
         $taxes=mysql_fetch_array(mysql_query($query));

         $Recordation = $taxes[0];
         $TransferTaxRate = $taxes[1];
         $Exemption  = $taxes[2];
        
        $MortgageTax = (1-$purchase)*round($Recordation*(max($loanamount-$ExDebt,0)));
        $TransferTax = $purchase*$TransferTaxRate*max(0,($salesprice));
        $StateTax = $purchase*(2-($FirstTime))*(.0025*$salesprice);
        $RecordationTax = $Recordation*$purchase*max(0,($salesprice-($PrincipleResidence)*$Exemption)); //local and state transfer taxes.
        
          if($loanamount>500000 && strtolower($county)=="montgomery" && $purchase==0)
        {
            $MortgageTax= .01*($loanamount-$ExDebt);
        }
        
        if($salesprice>500000 && strtolower($county)=="montgomery" && $purchase==1)
        {
            $RecordationTax = .01*max(0,($salesprice-(($PrincipleResidence)*50000)));
        }


         //All tax paid by Buyer (in demo system only) 
	$Line1203 = $MortgageTax + $TransferTax + $RecordationTax + $StateTax;
         
	 //End MD
        break;

        case "ME":
          
          
        break;

      
        case "MN":

         break;

        case "NH":

        break;

        case "NJ":
        
         if($Mansion=="Yes"){$Line1203 = $Line1203 + .01*$salesprice;} // Mansion Tax calculation
        
	//#Update
         $SettlementFee = $SettlementFee + $purchase*25;
         $DischargeTracking = (1-$purchase)*$DischargeTracking;
         $ClosingFee = (1-$TitleOnly)*$ClosingFee;
         $WireFee = (1-$TitleOnly)*$WireFee;
         $DischargeMortgage = (1-$TitleOnly)*$DischargeMortgage;

	 //Additional Fee for insurance protection letter
	 $Line1101_Additional = $MiscStateFees;
	 
	//Tiered transfer tax calculations
        if($salesprice>350000)
        {
            $Line1203 = $purchase*round(.0058*min(150000,$salesprice)+ .0085*max(0,min($salesprice-150000,50000))+ .0096*max(0,min($salesprice-200000,350000)) + .0106*max(0,min($salesprice-550000,300000)) + .0116*max(0,min($salesprice-850000,150000)) + .0121*max($salesprice-1000000,0) );
        }
        else
        {
             $Line1203 = $purchase*round(.004*min(150000,$salesprice)+ (.0067)*max(0,min($salesprice-150000,50000))+ (.0078)*max(0,min($salesprice-200000,150000)) );
        }
     
        break;

        case "PA":
         
//         $query= "SELECT TaxRate, RecordingRefi, PurchRecording FROM `HPC_PA-Counties` WHERE  County = '".$county."' AND Township ='".$township."'";
//         
//         if(mysql_num_rows(mysql_query($query)) == 0)
//         {$query= "SELECT TaxRate, RecordingRefi, PurchRecording FROM `HPC_PA-Counties` WHERE  County = '".$county."' AND Township = 'All Townships'";}
//         
//         $taxes=mysql_fetch_array(mysql_query($query));
//
//         $TaxRate= $taxes[0];
//         //#Update
//	 // Fees are set to be purchase/refi specific and workwith line 12901 calculation below 
//	 $DischargeMortgage = $taxes[1];
//	 $DeedFee = $taxes[2];
//	 $MortgageRecording = 0;
//	 
//         $Line1203 = $purchase*round($TaxRate*$salesprice/2);  //Divide by two accounts for buyer/seller split



         if (strtolower($county) == "philadelphia"){
         $TaxCert = 40;
         $UtilSearch = 10;
         }
         else {
         $TaxCert = 50;
         $UtilSearch = 30;
         }
         
	 $Line1101_Additional = $TaxCert + $UtilSearch; 
        break;

        case "RI":
	
	//#Update	
        // $ClosingFee = $ClosingFee + $purchase*50;
        break;

        case "TN":
      
	//$Line1203 = round(.00215*$loanamount)+$purchase*round(.0047*$salesprice);
         
        break;

        case "VA":
	
          if($purchase==0 && $ExDebt>0)
          {
          $Line1203 = $Line1203 +round(1.33333*(.0018*min(10000000,$loanamount)+ .0016*max(0,min($loanamount-10000000,10000000))+ .0014*max(0,min($loanamount-2000000,10000000))+ .0012*max(0,min($loanamount-30000000,10000000)) + .001*max(0,$loanamount-40000000) ));
          $StateRecordationTax = round((.0018*min(10000000,$loanamount)+ .0016*max(0,min($loanamount-10000000,10000000))+ .0014*max(0,min($loanamount-2000000,10000000))+ .0012*max(0,min($loanamount-30000000,10000000)) + .001*max(0,$loanamount-40000000) )); 
          $LocalRecordationTax = round(0.33333*(.0018*min(10000000,$loanamount)+ .0016*max(0,min($loanamount-10000000,10000000))+ .0014*max(0,min($loanamount-2000000,10000000))+ .0012*max(0,min($loanamount-30000000,10000000)) + .001*max(0,$loanamount-40000000) )); 
           
          }

          else
          {
          $Line1203 = $Line1203 + round(1.33333*(.0025*min(10000000,$loanamount)+ .0022*max(0,min($loanamount-10000000,10000000))+ .0019*max(0,min($loanamount-2000000,10000000))+ .0016*max(0,min($loanamount-30000000,10000000)) + .0013*max(0,$loanamount-40000000) ));
          $StateRecordationTax = round((.0025*min(10000000,$loanamount)+ .0022*max(0,min($loanamount-10000000,10000000))+ .0019*max(0,min($loanamount-2000000,10000000))+ .0016*max(0,min($loanamount-30000000,10000000)) + .0013*max(0,$loanamount-40000000) )); 
          $LocalRecordationTax = round(0.33333*(.0025*min(10000000,$loanamount)+ .0022*max(0,min($loanamount-10000000,10000000))+ .0019*max(0,min($loanamount-2000000,10000000))+ .0016*max(0,min($loanamount-30000000,10000000)) + .0013*max(0,$loanamount-40000000) ));           
          }
          
          $GrantorTax = .001*$purchase*$salesprice;
          $StateDeedTax =  .0025*$purchase*$salesprice;
          $LocalDeedTax =  .000833333*$purchase*$salesprice;
           
        break;

        case "VT":
         
          $Line1203 = $purchase*($Line1203-$PrincipleResidence*(.0075)*min($salesprice,100000));

          
        break;

        case "WV":    
            $Line1203 = $purchase*($Line1203+20); //$20 Deed Privilege fee
        break;
        
        case "":
        case "NA":

        break;

    default:
    

}//End State Switch

//Calculations exclude loan policy
$Line1101 = round($ClosingFee + $AbstractFee + $NotaryFee + $Endorsements + $TaxResearchFee + $CourierFee + $WireFee + $RecordingProcessing + $DischargeTracking + $SettlementFee + $Line1101_Additional);
  

$Line1201 = round($purchase*$DeedFee+$MortgageRecording +(1-$purchase)*$DischargeMortgage);	


return array($ClosingFee, $AbstractFee,$NotaryFee,$Endorsements,$TaxResearchFee,$CourierFee,$WireFee,$DeedFee,$MortgageRecording,$RecordingProcessing,$DischargeTracking,$MiscStateFees,
	     $DischargeMortgage,$SettlementFee, $SimIssue, $Line1201, $Line1203, $Line1301, $MortgageTax, $TransferTax, $RecordationTax, $StateTax, $TaxCert, $UtilSearch, $Line1101,$Zone);	
}

Function TitlePremiums($state,$county,$loanamount,$salesprice,$ExDebt, $purchase,$SimIssue, $ReIssue,$Search_Type,$Zone){

//Loan and Owner's Policy Calculations
$LoanQuery = "SELECT min, max, LoanRate, LoanFixed FROM HPC_GFE_Policy WHERE HPC_GFE_Policy.State =  '".$state."' AND County = 'NA' AND HPC_GFE_Policy.max >".$loanamount." AND HPC_GFE_Policy.min <=".$loanamount;

if($state=="TN")
{
switch($county)
{
    case "Davidson":
    case "Hamilton":
    case "Knox":
    case "Rutherford":
    case "Shelby":
    case "Williamson":
        $LoanQuery = "SELECT min, max, LoanRate, LoanFixed FROM HPC_GFE_Policy WHERE HPC_GFE_Policy.State =  '".$state."' AND HPC_GFE_Policy.County =  '".$county."' AND HPC_GFE_Policy.max >".$loanamount." AND HPC_GFE_Policy.min <=".$loanamount;
    break;
}
}

if($state=="CO")
    {
       $LoanQuery = "SELECT min, max, LoanRate, LoanFixed FROM HPC_GFE_Policy WHERE HPC_GFE_Policy.State =  '".$state."' AND HPC_GFE_Policy.County =  '".$Zone."' AND HPC_GFE_Policy.max >".$loanamount." AND HPC_GFE_Policy.min <=".$loanamount;
    }
    

$row = mysql_fetch_array(mysql_query($LoanQuery)); // Takes in array of GFE Rates

$LoanMin = $row[0];
$LoanMax = $row[1];
$LoanRate = $row[2];
$LoanFixed = $row[3];


// Owner's Policy calculations
$OwnersQuery = "SELECT min, max, OwnerRate, OwnerFixed, SimIssue FROM HPC_GFE_Policy WHERE HPC_GFE_Policy.State =  '".$state."' AND County='NA' AND HPC_GFE_Policy.max >".$salesprice." AND HPC_GFE_Policy.min <=".$salesprice;

if($state=="TN")
{
 switch($county)
{
    case "Davidson":
    case "Hamilton":
    case "Knox":
    case "Rutherford":
    case "Shelby":
    case "Williamson":   
        $OwnersQuery = "SELECT min, max, OwnerRate, OwnerFixed, SimIssue FROM HPC_GFE_Policy WHERE HPC_GFE_Policy.State =  '".$state."' AND HPC_GFE_Policy.County =  '".$county."' AND HPC_GFE_Policy.max >".$salesprice." AND HPC_GFE_Policy.min <=".$salesprice;
    break;
}
}

if($state=="CO")
    {
        $OwnersQuery = "SELECT min, max, OwnerRate, OwnerFixed, SimIssue FROM HPC_GFE_Policy WHERE HPC_GFE_Policy.State =  '".$state."' AND County='".$Zone."' AND HPC_GFE_Policy.max >".$salesprice." AND HPC_GFE_Policy.min <=".$salesprice;
    }
    
$row = mysql_fetch_array(mysql_query($OwnersQuery)); // Takes in array of HPC Rates

$OwnersMin = $row[0];
$OwnersMax = $row[1];
$OwnersRate = $row[2];
$OwnersFixed = $row[3];
$SimIssue = $row[4];

//Setting initial fees

$LoanPol = round($LoanRate*($loanamount-$LoanMin)+$LoanFixed);
$OwnersPol = round($OwnersRate*($salesprice-$OwnersMin)+$OwnersFixed + $SimIssue - $LoanPol);
if($purchase==0){$OwnersPol=0;}

	
//State Specific exceptions	
switch($state){
	case "CT":
	if(!empty($ReIssue) && $purchase==0){
            $LoanPol = .6*$LoanPol;
	}
	break;	

	case "DE":
	$LoanPol = round(.00275*max(($loanamount - $ExDebt),0)) + round(.00165*max($ExDebt,0));
        $OwnersPol = $purchase*round($OwnersRate*($salesprice-$OwnersMin)+$OwnersFixed + $SimIssue - $LoanPol);
        
	if(!empty($ReIssue) && $purchase==0){
            $LoanPol = .6*$LoanPol;
	}
	break;  
	
	case "FL":
	//Loan and Owner's Policy Calculations redone for existing debt
        $query = "SELECT min, max, LoanRate, LoanFixed FROM HPC_GFE_Policy WHERE HPC_GFE_Policy.State =  '".$state."' AND HPC_GFE_Policy.max >=".($loanamount-$ExDebt)." AND HPC_GFE_Policy.min <=".($loanamount-$ExDebt);
        $row = mysql_fetch_array(mysql_query($query)); // Takes in array of HPC Rates

        $LoanMin = $row[0];
        $LoanMax = $row[1];
        $LoanRate = $row[2];
        $LoanFixed = $row[3];

        //Compensates for existing debt payment
        $LoanPol = round($LoanRate*($loanamount-$ExDebt-$LoanMin)+$LoanFixed);
        $LoanPol= $LoanPol + .0033*min($ExDebt,100000) + max(.003*min(900000, $ExDebt-100000),0)+ max(.002*min(9000000, $ExDebt-1000000),0);
	break;	
	
	case "IL":
	$OwnersPol = $purchase*($LoanPol+320);
	break;

	case "IN":

	if($Search_Type=="COMM"){
		
	$LoanQuery = "SELECT min, max, LoanRate, LoanFixed FROM HPC_GFE_Policy WHERE HPC_GFE_Policy.State =  '".$state."' AND HPC_GFE_Policy.County =  'COMM' AND HPC_GFE_Policy.max >".$loanamount." AND HPC_GFE_Policy.min <=".$loanamount;

        $row = mysql_fetch_array(mysql_query($LoanQuery)); // Takes in array of GFE Rates

        $LoanMin = $row[0];
        $LoanMax = $row[1];
        $LoanRate = $row[2];
        $LoanFixed = $row[3];

        $OwnersQuery = "SELECT min, max, OwnerRate, OwnerFixed FROM HPC_GFE_Policy WHERE HPC_GFE_Policy.State =  '".$state."' AND HPC_GFE_Policy.County =  'COMM' AND HPC_GFE_Policy.max >".$salesprice." AND HPC_GFE_Policy.min <=".$salesprice;

        $row = mysql_fetch_array(mysql_query($OwnersQuery)); // Takes in array of HPC Rates

        $OwnersMin = $row[0];
        $OwnersMax = $row[1];
        $OwnersRate = $row[2];
        $OwnersFixed = $row[3];

        //Setting initial fees

        $LoanPol = round($LoanRate*($loanamount-$LoanMin)+$LoanFixed);
        $OwnersPol = round(($OwnersRate*($salesprice-$OwnersMin)+$OwnersFixed) + $SimIssue - $LoanPol);
        if($purchase==0){$OwnersPol=0;}	
	}	
		
	if(!empty($ReIssue) && $purchase==0){
            $LoanPol = .75*$LoanPol;
	}
	break;	
	
	case "KY":
	if(!empty($ReIssue) && $purchase==0){
            $LoanPol = .7*$LoanPol;
	}
	break;

	case "MA":
	if(!empty($ReIssue) && $purchase==0){
            $LoanPol = .6*$LoanPol;
	}
	break;

	case "MD":
	if($LoanPol< 111.20 && $loanamount<> 0){$LoanPol = 111.2;}
        if($OwnersPol < 155.60){ $OwnersPol = $purchase*(155.6);}
	break;
	
	case "ME":
	if(!empty($ReIssue) && $purchase==0){
            $LoanPol = $LoanPol-round(.001*$loanamount);
	}
	break;		
	
	case "MI":
          if($purchase==1)
	  {
          $LoanPol = max(.8*$LoanPol,175); //Simultaneous Issue Calculation
          }
	 
	 if(!empty($ReIssue) && $purchase==0){
            $LoanPol = .6*$LoanPol;
	} 
	  // End MI 
	break;
	
	case "MN":          
          if($LoanPol<100){$LoanPol = 100;}
          if($OwnersPol<100){$OwnersPol = $purchase*100;}
	break;  
	  
	case "NH":
	   // Adds 10% and $75 for NH Expanded rates
	   $OwnersPol = $purchase*round(1.1*($OwnersRate*($salesprice-$OwnersMin)+$OwnersFixed) + $SimIssue + 75 - $LoanPol);
	   
	   if(!empty($ReIssue) && $purchase==0){
            $LoanPol = .6*$LoanPol;
	   } 
	   
	break;

	case "NJ":
        //Use full rate for "New" money
        $query = "SELECT min, max, OwnerRate, OwnerFixed FROM HPC_GFE_Policy WHERE HPC_GFE_Policy.State =  '".$state."' AND HPC_GFE_Policy.max >".($loanamount-$ExDebt)." AND HPC_GFE_Policy.min <=".($loanamount-$ExDebt);
        $row = mysql_fetch_array(mysql_query($query)); // Takes in array of HPC Rates

        $OwnersMin = $row[0];
        $OwnersMax = $row[1];
        $OwnersRate = $row[2];
        $OwnersFixed = $row[3];

        $LoanPol = round($OwnersRate*($loanamount-$ExDebt-$OwnersMin)+$OwnersFixed);
     
        $query = "SELECT min, max, LoanRate, LoanFixed FROM HPC_GFE_Policy WHERE HPC_GFE_Policy.State =  '".$state."' AND HPC_GFE_Policy.max >".$ExDebt." AND HPC_GFE_Policy.min <=".$ExDebt;
        $row = mysql_fetch_array(mysql_query($query)); // Takes in array of HPC Rates

        $LoanMin = $row[0];
        $LoanMax = $row[1];
        $LoanRate = $row[2];
        $LoanFixed = $row[3];

        $LoanPol = $LoanPol + round($LoanRate*($ExDebt-$LoanMin)+$LoanFixed); 
        
        $OwnersPol = round($OwnersRate*($salesprice-$OwnersMin)+$OwnersFixed + $SimIssue - $LoanPol);
        if($purchase==0){$OwnersPol=0;}
        
	break;

	case "OH":
	//Policy minimums
          if($LoanPol<125 && $purchase==0){$LoanPol=125;}
          if($OwnersPol<175){$OwnersPol=$purchase*175;}
	
	 if(!empty($ReIssue) && $purchase==0){
            $LoanPol = .7*$LoanPol;
	   } 
	break;	

	case "RI":
	if(!empty($ReIssue) && $purchase==0){
            $LoanPol = $LoanPol-round(.001*$loanamount);
	}
	break;

	case "SC":
         //Policy minimums
          if($LoanPol<100){$LoanPol=100;}
          if($OwnersPol<100){$OwnersPol=$purchase*100;}
	break;  
	  
	case "TN":
	//$LoanQuery = "SELECT min, max, LoanRate, LoanFixed FROM HPC_GFE_Policy WHERE HPC_GFE_Policy.State =  '".$state."' AND HPC_GFE_Policy.County =  '".$county."' AND HPC_GFE_Policy.max >".$loanamount." AND HPC_GFE_Policy.min <=".$loanamount;
	//
	//$row = mysql_fetch_array(mysql_query($LoanQuery)); // Takes in array of GFE Rates
	//
	//$LoanMin = $row[0];
	//$LoanMax = $row[1];
	//$LoanRate = $row[2];
	//$LoanFixed = $row[3];
	//
	//$OwnersQuery = "SELECT min, max, OwnerRate, OwnerFixed FROM HPC_GFE_Policy WHERE HPC_GFE_Policy.State =  '".$state."' AND HPC_GFE_Policy.County =  '".$county."' AND HPC_GFE_Policy.max >".$salesprice." AND HPC_GFE_Policy.min <=".$salesprice;
	//
	//$row = mysql_fetch_array(mysql_query($OwnersQuery)); // Takes in array of HPC Rates
	//
	//$OwnersMin = $row[0];
	//$OwnersMax = $row[1];
	//$OwnersRate = $row[2];
	//$OwnersFixed = $row[3];
	//
	//$LoanPol = round($LoanRate*($loanamount-$LoanMin)+$LoanFixed);
	//$OwnersPol = round($OwnersRate*($salesprice-$OwnersMin)+$OwnersFixed + $SimIssue - $LoanPol);
	
	//Policy minimums
          if($LoanPol < 200){ $LoanPol = 200;}
          
          if($OwnersPol<200){$OwnersPol=$purchase*200;}
	  
	if(!empty($ReIssue) && $purchase==0){
            $LoanPol = .7*$LoanPol;
	   } 
	
	break; // End TN
	
        case "VA":
          // Added $20 for ??
	  $LoanPol = $LoanPol + (1-$purchase)*20;
          
	  //Policy minimums
          $LoanPol = max($LoanPol,200);
          $OwnersPol = $purchase*max($OwnersPol,200);
	  
          if(!empty($ReIssue) && $purchase==0)
	  {
          $LoanPol = .7*$LoanPol;
          }
        break;
	
        case "VT":
	//Policy minimums
          $LoanPol = max($LoanPol,200);
          $OwnersPol = $purchase*max($OwnersPol,200);
	  
          if(!empty($ReIssue) && $purchase==0)
	  {
          $LoanPol = .5*$LoanPol;
          }
        break;

	case "WI":
	  
          if(!empty($ReIssue) && $purchase==0)
	  {
          $LoanPol = .8*$LoanPol;
          }
        break;
//End state switch
}	
	
return array($LoanPol, $OwnersPol);
}

Function Lender_Rates($state, $Username){
	//Import Fees from Database
	$query = "SELECT LenderCost, TaxRate, Line803, Line804, Line805, Line806, Line807 FROM HPC_Rates WHERE (HPC_Rates.State =  '".$state."')";

	$row = mysql_fetch_array(mysql_query($query)); // Takes in array of HPC Rates

	$LenderCost = $row[0];
	$TaxRate = $row[1];
	$Line803 = $row[2];
	$Line804 = $row[3];
	$Line805 = $row[4];
	$Line806 = $row[5];
	$Line807 = $row[6];	
	
	//$transfertax=round($TaxRate*$salesprice);
	
	//Line808 - 810 info for citizens bank specific rates
	//DS changed line808-10 to default to 0 instead of ""
	$Line808 =0;
	$Line808_Header ="";
	$Line809 =0;
	$Line809_Header ="";
	$Line810 =0;
	$Line810_Header ="";

	//Citizens Bank Specific Fees
	if (strpos($Username,'citizensbank') !== false) {
	$LenderCost = 1144.20;
	$Line803 = 0;
	$Line804 = 400;
	$Line805 = 16.20;
	$Line806 = 72;
	$Line807 = 7;
	$Line808 =20;
	$Line808_Header ="AU Underwriting Fee";
	$Line809 =529;
	$Line809_Header ="Processing Fee";
	$Line810 =100;
	$Line810_Header ="Underwriting Fee";
	}

	//First Niagara Specific Fees
	if (strpos($Username,'firstniagara') !== false) {
	$LenderCost = 347;
	$Line803 = 0;
	$Line804 = 325;
	$Line805 = 22;
	$Line806 = 0;
	$Line807 = 0;
	}

	//Guaranteed Rate/Keller Williams Specific Fees
	if ((strpos($Username,'kw.com') !== false) || (strpos($Username,'guaranteedrate') !== false)) {
	$LenderCost = 1360;
	$Line803 = 990;
	$Line804 = 360;
	$Line805 = 5;
	$Line806 = 0;
	$Line807 = 5;
	}

	
	return array($LenderCost, $Line803, $Line804, $Line805, $Line806, $Line807, $Line808, $Line808_Header, $Line809, $Line809_Header, $Line810, $Line810_Header);
}

Function Line_1205($salesprice, $state, $county, $township){
	//Line 1205 Seller Tax calculations
	$TaxQuery = "SELECT min, max, TaxRate, Fixed,Deduct FROM HPC_Seller_Taxes WHERE State =  '".$state."' AND County='".$county."' AND Town='".$township."' AND max >".$salesprice." AND min <=".$salesprice;
	$row = mysql_fetch_array(mysql_query($TaxQuery));
	
	if(empty($row)){
	$TaxQuery = "SELECT min, max, TaxRate, Fixed,Deduct FROM HPC_Seller_Taxes WHERE State =  '".$state."' AND County='".$county."' AND max >".$salesprice." AND min <=".$salesprice;
	$row = mysql_fetch_array(mysql_query($TaxQuery));
	}
	
	if(empty($row)){
	$TaxQuery = "SELECT min, max, TaxRate, Fixed,Deduct FROM HPC_Seller_Taxes WHERE State =  '".$state."' AND County='NA' AND Town='NA' AND max >".$salesprice." AND min <=".$salesprice." AND Notes=''";
	$row = mysql_fetch_array(mysql_query($TaxQuery)); // Takes in array of HPC Rates
	}
	
	$TaxMin = $row[0];
	$TaxMax = $row[1];
	$TaxRate = $row[2];
	$TaxFixed = $row[3];
	$TaxDeduct = $row[4];

	$Line1205 = round($TaxRate*max(0,($salesprice-$TaxMin-$TaxDeduct))+$TaxFixed);

	return $Line1205;	
}

Function NY_Counties($county, $township, $Loan_Amount,$PrincipalBalance,$Purchase_Price,$purchase, $TitleOrderOnly, $PriorInsurance, $InsuranceType){

//SELECT Names
$CountyQuery = "SELECT Name FROM NYnames WHERE (NYnames.Value =  '".$county."')";
$row = mysql_fetch_array(mysql_query($CountyQuery)); // Takes in array of HPC Rates
$county = $row[0];

$query = "SELECT Name FROM NYnames WHERE (NYnames.Value =  '".$township."')";
$row = mysql_fetch_array(mysql_query($query)); // Takes in array of HPC Rates
$township = $row[0];



$TaxQuery= "SELECT TaxRate, Deduction, Zone FROM `HPC_NY-Counties` WHERE  County = '".$county."'";
$taxes=mysql_fetch_array(mysql_query($TaxQuery));

$TaxRate= $taxes[0];
$Deduction = $taxes[1];
$Zone = $taxes[2];

$Line1203=round($TaxRate*max(0,($Loan_Amount-$Deduction-$PrincipalBalance)));

//yonkers township exception
if($township=='Yonkers'){$Line1203=round(.0155*max(0,($Loan_Amount-$PrincipalBalance)));}

//New York over $500k rate change
if(($county=="New York" || $county=="Kings" || $county=="Queens" || $county=="Bronx" || $county=="Richmond")&& $Loan_Amount >=500000)
{$Line1203=round(.01925*max(0,($Loan_Amount-$PrincipalBalance)));}

if ($Zone == 1){

$query = "SELECT min, max, Z1_LoanRate, Z1_LoanFixed FROM `HPC_NY-Insurance` WHERE `HPC_NY-Insurance`.max >=".$Loan_Amount." AND `HPC_NY-Insurance`.min <=".$Loan_Amount;
$row = mysql_fetch_array(mysql_query($query)); // Takes in array of HPC Rates

$LoanMin = $row[0];
$LoanMax = $row[1];
$LoanRate = $row[2];
$LoanFixed = $row[3];

$query = "SELECT min, max, Z1_OwnersRate, Z1_OwnersFixed FROM `HPC_NY-Insurance` WHERE `HPC_NY-Insurance`.max >=".$Purchase_Price." AND `HPC_NY-Insurance`.min <=".$Purchase_Price;
$row = mysql_fetch_array(mysql_query($query)); // Takes in array of HPC Rates

$OwnersMin = $row[0];
$OwnersMax = $row[1];
$OwnersRate = $row[2];
$OwnersFixed = $row[3];
}
else {
$query = "SELECT min, max, Z2_LoanRate, Z2_LoanFixed FROM `HPC_NY-Insurance` WHERE `HPC_NY-Insurance`.max >=".$Loan_Amount." AND `HPC_NY-Insurance`.min <=".$Loan_Amount;
$row = mysql_fetch_array(mysql_query($query)); // Takes in array of HPC Rates

$LoanMin = $row[0];
$LoanMax = $row[1];
$LoanRate = $row[2];
$LoanFixed = $row[3];

$query = "SELECT min, max, Z2_OwnersRate, Z2_OwnersFixed FROM `HPC_NY-Insurance` WHERE `HPC_NY-Insurance`.max >=".$Purchase_Price." AND `HPC_NY-Insurance`.min <=".$Purchase_Price;
$row = mysql_fetch_array(mysql_query($query)); // Takes in array of HPC Rates

$OwnersMin = $row[0];
$OwnersMax = $row[1];
$OwnersRate = $row[2];
$OwnersFixed = $row[3];
}

$LoanPol = round(($LoanRate*($Loan_Amount-$LoanMin)+$LoanFixed));
        


if($purchase==1){
	//$DischargeTracking=0;// sets discharge tracking to 0 in purchase
   $LoanPol=.3*$LoanPol;
     }
 else{
if($Loan_Amount<=475000){$LoanPol=$LoanPol*(1-.5*min(1,($PriorInsurance/$Loan_Amount)));}
else{
$LoanPol=$LoanPol*(1-.3*min(1,($PriorInsurance/$Loan_Amount))); }
 }//sets loan policy for refis

 
 
 //15% deduction in place for all owner's polcies in order to match fidelity fees
 if($Purchase_Price<1000000){ $OwnersPol = round(.85*($OwnersRate*($Purchase_Price-$OwnersMin)+$OwnersFixed));}
 else {$OwnersPol = round($OwnersRate*($Purchase_Price-$OwnersMin)+$OwnersFixed);}
 
 $AttorneySettlement = (1-$TitleOrderOnly)*(1-$purchase)*(425+225*($Zone-1));

//Transfer tax on purchases
if($purchase==1){
    switch($township){
	case "East Hampton":
	case "Shelter Island":
	case "Southhampton":
	$transfertax = round(.02*max($Purchase_Price-250000,0));
	    
	break;
    
	case "Riverhead":
	case "Southold":
	$transfertax = round(.02*max($Purchase_Price-150000,0));
	
	break;
    
	case "Warwick":
	$transfertax = round(.0075*max($Purchase_Price-100000,0));
	
        break;

	case "Red Hook":
	$transfertax= round(.02*$Purchase_Price);
	break;
	
    default:
	
	$transfertax = round(.004*$Purchase_Price);
	
    }//end switch
}
else{$transfertax=0;}//end purchaser transfer tax calculations



return array($Line1203,$transfertax,$LoanPol,$OwnersPol,$AttorneySettlement,$county,$township);	
	
}



?>