<?php
include('ErnstRequest.php');
function GenerateXML($PageREC,$EstimatedValue,$MortgageAmount)
{
	$PageRecVal = $PageREC;//'MI012';
	$EstimatedValue = $EstimatedValue;
	$MortgageAmount = $MortgageAmount;
	$Request = new SimpleXMLElement('<Request/>');
	$Request->addChild('Version', "2");
	$Authentication = $Request->addChild('Authentication');
	$Authentication->addChild('UserID', "LSXMLProd"); //LodeStar
	$Authentication->addChild('Password', "P78038"); //TestAccoun
	$Request->addChild('TransactionDate', "");
	$Request->addChild('ClientTransactionID', "");
	$Request->addChild('Guarantee', "true");
	$Request->addChild('Purpose', "GFE");
	$ErnstRequest = $Request->addChild('ErnstRequest');
	$ErnstRequest->addChild('Version', "1");
	$Options=$ErnstRequest->addChild('Options');
	for ($i=1; $i<3; $i++) {
	$Option=$Options->addChild('Option');
	$Option->addChild('Name', "");
	$Option->addChild('Value', "");
	}
	$ErnstRequest->addChild('TransactionCode', "100");
	$ErnstRequest->addChild('DataSource', "");
	$Property=$ErnstRequest->addChild('Property');
	$Property->addChild('Page', $PageRecVal); //Change PageRec Value by fetching it from the database Index File
	$Property->addChild('City', "");
	$Property->addChild('County', "");
	$Property->addChild('State', "");
	$Property->addChild('FullAddress', "");
	$Property->addChild('EstimatedValue', $EstimatedValue);
	$Property->addChild('MortgageAmount', $MortgageAmount);
	$Property->addChild('OriginalDebtAmount', "0.0");
	$Property->addChild('UnpaidPrincipalBalance', "0.0");
	$Property->addChild('Title', "");
	$Property->addChild('TitleAmount', "0.0");
	$Property->addChild('OwnersTitleAmount', "0.0");
	$Property->addChild('OriginalTitleAmount', "0.0");
	$Property->addChild('OriginalMortgageDate', "");
	$StateQuestions=$Property->addChild('StateQuestions');
	$StateQuestions->addChild('Q1', "");
	for ($i = 1; $i <= 50; ++$i) {
		$StateQuestions->addChild("Q$i", "");
	};
	for ($i = 1; $i <= 50; ++$i) {
		$StateQuestions->addChild("V$i", "");
	};
	$NumberOfPages=$ErnstRequest->addChild('NumberOfPages');
	$NumberOfPages->addChild('Mortgage', "20");
	$NumberOfPages->addChild('Deed', "3");
	$Mortgage=$ErnstRequest->addChild('Mortgage');
	$Mortgage->addChild('AmendmentModificationPages', "0");
	$Index=$Mortgage->addChild('Index');
	$Index->addChild('NumberOfGrantors', "1");
	$Index->addChild('NumberOfGrantees', "1");
	$Index->addChild('NumberOfSurnames', "1");
	$Index->addChild('NumberOfSignatures', "1");
	$Deed=$ErnstRequest->addChild('Deed');
	$Deed->addChild('AmendmentModificationPages', "0");
	$Index=$Deed->addChild('Index');
	$Index->addChild('NumberOfGrantors', "1");
	$Index->addChild('NumberOfGrantees', "1");
	$Index->addChild('NumberOfSurnames', "1");
	$Index->addChild('NumberOfSignatures', "1");
	$Release=$ErnstRequest->addChild('Release');
	$Release->addChild('Pages', "3");
	$Release->addChild('NumberOfReleases', "1");
	$Index=$Release->addChild('Index');
	$Index->addChild('NumberOfGrantors', "1");
	$Index->addChild('NumberOfGrantees', "1");
	$Index->addChild('NumberOfSurnames', "1");
	$Index->addChild('NumberOfSignatures', "1");
	Header('Content-type: text/xml');
	//print($Request->asXML());
	$XML_Generated=$Request->asXML();
	CallErnst($XML_Generated,$PageRecVal);
}
?>