<!DOCTYPE html>
<html> 
	<head> 
	<title>Calling Ernst Web service using PHP</title> 
	</head> 
	<body> 
		<?php
			//set_time_limit(90);
			// XML from the Request.xml file passed as string
			$input_xml = '<?xml version="1.0" encoding="UTF-8"?><Request><Version>2</Version><Authentication><UserID>LodeStar</UserID><Password>TestAccoun</Password></Authentication><TransactionDate/><ClientTransactionID/><Guarantee>true</Guarantee><Purpose>GFE</Purpose><ErnstRequest><Version>1</Version><Options><Option><Name></Name><Value></Value></Option><Option><Name></Name><Value></Value></Option></Options><TransactionCode>100</TransactionCode><DataSource/><Property><Page>PA005</Page><City/><County></County><State></State><FullAddress/><EstimatedValue>250000.0</EstimatedValue><MortgageAmount>200000.0</MortgageAmount><OriginalDebtAmount>0.0</OriginalDebtAmount><UnpaidPrincipalBalance>0.0</UnpaidPrincipalBalance><Title></Title><TitleAmount>0.0</TitleAmount><OwnersTitleAmount>0.0</OwnersTitleAmount><OriginalTitleAmount>0.0</OriginalTitleAmount><OriginalMortgageDate/><StateQuestions><Q1></Q1><Q2></Q2><Q3></Q3><Q4></Q4><Q5></Q5><Q6></Q6><Q7></Q7><Q8></Q8><Q9></Q9><Q10></Q10><Q11></Q11><Q12></Q12><Q13></Q13><Q14></Q14><Q15></Q15><Q16></Q16><Q17></Q17><Q18></Q18><Q19></Q19><Q20></Q20><Q21></Q21><Q22></Q22><Q23></Q23><Q24></Q24><Q25></Q25><Q26></Q26><Q27></Q27><Q28></Q28><Q29></Q29><Q30></Q30><Q31></Q31><Q32></Q32><Q33></Q33><Q34></Q34><Q35></Q35><Q36></Q36><Q37></Q37><Q38></Q38><Q39></Q39><Q40></Q40><Q41></Q41><Q42></Q42><Q43></Q43><Q44></Q44><Q45></Q45><Q46></Q46><Q47></Q47><Q48></Q48><Q49></Q49><Q50></Q50><V1></V1><V2></V2><V3></V3><V4></V4><V5></V5><V6></V6><V7></V7><V8></V8><V9></V9><V10></V10><V11></V11><V12></V12><V13></V13><V14></V14><V15></V15><V16></V16><V17></V17><V18></V18><V19></V19><V20></V20><V21></V21><V22></V22><V23></V23><V24></V24><V25></V25><V26></V26><V27></V27><V28></V28><V29></V29><V30></V30><V31></V31><V32></V32><V33></V33><V34></V34><V35></V35><V36></V36><V37></V37><V38></V38><V39></V39><V40></V40><V41></V41><V42></V42><V43></V43><V44></V44><V45></V45><V46></V46><V47></V47><V48></V48><V49></V49><V50></V50></StateQuestions></Property><NumberOfPages><Mortgage>20</Mortgage><Deed>3</Deed></NumberOfPages><Mortgage><AmendmentModificationPages>0</AmendmentModificationPages><Index><NumberOfGrantors>1</NumberOfGrantors><NumberOfGrantees>1</NumberOfGrantees><NumberOfSurnames>1</NumberOfSurnames><NumberOfSignatures>1</NumberOfSignatures></Index></Mortgage><Deed><AmendmentModificationPages>0</AmendmentModificationPages><Index><NumberOfGrantors>1</NumberOfGrantors><NumberOfGrantees>1</NumberOfGrantees><NumberOfSurnames>1</NumberOfSurnames><NumberOfSignatures>1</NumberOfSignatures></Index></Deed><Release><Pages>3</Pages><NumberOfReleases>1</NumberOfReleases><Index><NumberOfGrantors>1</NumberOfGrantors><NumberOfGrantees>1</NumberOfGrantees><NumberOfSurnames>1</NumberOfSurnames><NumberOfSignatures>1</NumberOfSignatures></Index></Release></ErnstRequest></Request>';
			$url="http://www.ernstpublishing.com/XML_WebService/ProcessXML.asmx/Request";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url); //Connection to Ernst Server
			curl_setopt($ch, CURLOPT_TIMEOUT,        100); 
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
			curl_setopt($ch, CURLOPT_POST,1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, 'xmlRequest='.$input_xml);
			//curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1000);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 'Connection: keep-alive','Accept:	text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8', 'Content-Length:'.strlen("xmlRequest=" . $input_xml)));
			//echo strlen("xmlRequest='" . $input_xml . "'");
			//echo strlen("xmlRequest= '" . $input_xml . "'");
			$data = curl_exec($ch);
			$err = curl_error($ch); 
			curl_close($ch);
			//echo "This is the response from Ernst Server: ";
			//echo $data;
			//echo $err;
			//convert the XML result into array
			//$array_data = json_decode(json_encode(simplexml_load_string($data)), true);
			//print_r('<pre>');
			//print_r($array_data);
			//print_r('</pre>');
		?> 
	</body> 
</html> 
 