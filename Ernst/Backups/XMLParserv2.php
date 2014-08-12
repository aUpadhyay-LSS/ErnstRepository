<?php 
	header('Content-type: text/plain');  
	//include('XMLGenerator.php'); 
	include('Parser_Helper.php'); 
	
	$xml = new Xml; 
	$filename= 'temp.txt'; 
	//$PageRecVal = "WI054";
	
	function search($array, $key, $value)
	{
		$results = array();

		if (is_array($array)) {
			if (isset($array[$key]) && $array[$key] == $value) {
				$results[] = $array;
			}

			foreach ($array as $subarray) {
				$results = array_merge($results, search($subarray, $key, $value));
			}
		}

		return $results;
	}
	
	$out = $xml->parse($filename, 'FILE');
	//print_r(search($out, 'Page', $PageRecVal));
	$parsed_array = [search($out, 'Page', $PageRecVal)];
	var_dump($parsed_array[0][0]['County']);
	echo "\r\n";    
	
	echo "Line Number: 1201";
	echo "\r\n";
	$out = $xml->parse($filename, 'FILE');
	//print_r(search($out, 'LineNumber', '1201'));
	$parsed_array = [search($out, 'LineNumber', '1201')];
	ob_start();
	var_dump($parsed_array[0][0]['DeedAmount']);
	$deedamount = ob_get_clean();
	$deedamount = substr($deedamount, 11, -2); 
	echo "Deed Amount: ",$deedamount;
	echo "\r\n";
	
	echo "Response_1202";
	echo "\r\n";
	$out = $xml->parse($filename, 'FILE');
	print_r(search($out, 'LineNumber', '1202'));
	echo "\r\n";
	
	echo "Response_1203";
	echo "\r\n";
	$out = $xml->parse($filename, 'FILE');
	print_r(search($out, 'LineNumber', '1203'));
	echo "\r\n";
?>