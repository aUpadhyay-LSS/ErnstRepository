<?php
	//include('XMLGenerator.php'); 
	include('XMLParser.php');
	function CallErnst($XML_Generated,$PageRecVal)
	{
		$input_xml = $XML_Generated;
		$url="http://www.ernstpublishing.com/XML_WebService/ProcessXML.asmx/Request";
		$ch = curl_init();
		$fp = fopen("temp.txt", "w");
		curl_setopt($ch, CURLOPT_URL, $url); 
		curl_setopt($ch, CURLOPT_TIMEOUT,        100);
		curl_setopt($ch, CURLOPT_FILE, $fp);
		//curl_setopt($ch, CURLOPT_HEADER, 0);	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); 
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1000);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded', 'Connection: keep-alive','Accept:	text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8', 'Content-Length:'.strlen("xmlRequest=" . $input_xml)));
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'xmlRequest='.$input_xml);
		$data = curl_exec($ch);
		$err = curl_error($ch); 
		curl_close($ch);
		fclose($fp);
		$file = "temp.txt";
		$read_string = file_get_contents($file);
		$modified_string = str_replace('&amp;', '&', $read_string);
		$modified_string = str_replace('&lt;', '<', $modified_string);
		$modified_string = str_replace('&gt;', '>', $modified_string);
		$modified_string = str_replace('&quot;', '"', $modified_string);
		$modified_string = str_replace('&apos;', "'", $modified_string);
		file_put_contents('temp.txt', $modified_string);
		//echo $read_string;
		//include('XMLParser.php'); 
		ParseXML($PageRecVal);
	}
	
?> 

 