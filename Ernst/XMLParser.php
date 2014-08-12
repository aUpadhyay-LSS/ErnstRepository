<?php 
	header('Content-type: text/plain');  
	//include('ErnstRequest.php'); 
	include('Parser_Helper.php'); 
	function ParseXML($PageRecVal)
	{
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
		//echo $PageRecVal;
		$parsed_array = [search($out, 'Page', $PageRecVal)];
		ob_start();
		var_dump($parsed_array[0][0]['County']);
		$county = ob_get_clean();
		$county = substr($county, 11, -2); 
		echo "County: ",$county;
		echo "\r\n";
		ob_start();
		var_dump($parsed_array[0][0]['State']);
		$state = ob_get_clean();
		$state = substr($state, 11, -2); 
		echo "State: ",$state;
		echo "\r\n";    
		
		echo "\r\n"; 
		echo "Line Number: 1201";
		echo "\r\n";
		$parsed_array = [search($out, 'LineNumber', '1201')];
		ob_start();
		var_dump($parsed_array[0][0]['LineDescription']);
		$LineDescription = ob_get_clean();
		$LineDescription = substr($LineDescription, 12, -2); 
		echo "Line Description: ",$LineDescription;
		echo "\r\n";
		ob_start();
		var_dump($parsed_array[0][0]['DeedAmount']);
		$DeedAmount = ob_get_clean();
		$DeedAmount = substr($DeedAmount, 11, -2); 
		echo "Deed Amount: ",$DeedAmount;
		echo "\r\n";
		ob_start();
		var_dump($parsed_array[0][0]['MortgageAmount']);
		$MortgageAmount = ob_get_clean();
		$MortgageAmount = substr($MortgageAmount, 11, -2); 
		echo "Mortgage Amount: ",$MortgageAmount;
		echo "\r\n";
		ob_start();
		var_dump($parsed_array[0][0]['ReleaseAmount']);
		$ReleaseAmount = ob_get_clean();
		$ReleaseAmount = substr($ReleaseAmount, 11, -2); 
		echo "Release Amount: ",$ReleaseAmount;
		echo "\r\n";
		
		echo "\r\n"; 
		echo "Line Number: 1202";
		echo "\r\n";
		$parsed_array = [search($out, 'LineNumber', '1202')];
		ob_start();
		var_dump($parsed_array[0][0]['LineDescription']);
		$LineDescription = ob_get_clean();
		$LineDescription = substr($LineDescription, 12, -2); 
		echo "Line Description: ",$LineDescription;
		echo "\r\n";
		ob_start();
		var_dump($parsed_array[0][0]['DeedAmount']);
		$DeedAmount = ob_get_clean();
		$DeedAmount = substr($DeedAmount, 11, -2); 
		echo "Deed Amount: ",$DeedAmount;
		echo "\r\n";
		ob_start();
		var_dump($parsed_array[0][0]['MortgageAmount']);
		$MortgageAmount = ob_get_clean();
		$MortgageAmount = substr($MortgageAmount, 11, -2); 
		echo "Mortgage Amount: ",$MortgageAmount;
		echo "\r\n";
		ob_start();
		var_dump($parsed_array[0][0]['ReleaseAmount']);
		$ReleaseAmount = ob_get_clean();
		$ReleaseAmount = substr($ReleaseAmount, 11, -2); 
		echo "Release Amount: ",$ReleaseAmount;
		echo "\r\n";
		
		echo "\r\n"; 
		echo "Line Number: 1203";
		echo "\r\n";
		$parsed_array = [search($out, 'LineNumber', '1203')];
		ob_start();
		var_dump($parsed_array[0][0]['LineDescription']);
		$LineDescription = ob_get_clean();
		$LineDescription = substr($LineDescription, 12, -2); 
		echo "Line Description: ",$LineDescription;
		echo "\r\n";
		ob_start();
		var_dump($parsed_array[0][0]['DeedAmount']);
		$DeedAmount = ob_get_clean();
		$DeedAmount = substr($DeedAmount, 11, -2); 
		echo "Deed Amount: ",$DeedAmount;
		echo "\r\n";
		ob_start();
		var_dump($parsed_array[0][0]['MortgageAmount']);
		$MortgageAmount = ob_get_clean();
		$MortgageAmount = substr($MortgageAmount, 11, -2); 
		echo "Mortgage Amount: ",$MortgageAmount;
		echo "\r\n";
		ob_start();
		var_dump($parsed_array[0][0]['ReleaseAmount']);
		$ReleaseAmount = ob_get_clean();
		$ReleaseAmount = substr($ReleaseAmount, 11, -2); 
		echo "Release Amount: ",$ReleaseAmount;
		echo "\r\n";
		
		echo "\r\n"; 
		echo "Line Number: 1204";
		echo "\r\n";
		$parsed_array = [search($out, 'LineNumber', '1204')];
		ob_start();
		var_dump($parsed_array[0][0]['LineDescription']);
		$LineDescription = ob_get_clean();
		$LineDescription = substr($LineDescription, 12, -2); 
		echo "Line Description: ",$LineDescription;
		echo "\r\n";
		ob_start();
		var_dump($parsed_array[0][0]['DeedAmount']);
		$DeedAmount = ob_get_clean();
		$DeedAmount = substr($DeedAmount, 11, -2); 
		echo "Deed Amount: ",$DeedAmount;
		echo "\r\n";
		ob_start();
		var_dump($parsed_array[0][0]['MortgageAmount']);
		$MortgageAmount = ob_get_clean();
		$MortgageAmount = substr($MortgageAmount, 11, -2); 
		echo "Mortgage Amount: ",$MortgageAmount;
		echo "\r\n";
		ob_start();
		var_dump($parsed_array[0][0]['ReleaseAmount']);
		$ReleaseAmount = ob_get_clean();
		$ReleaseAmount = substr($ReleaseAmount, 11, -2); 
		echo "Release Amount: ",$ReleaseAmount;
		echo "\r\n";
		
		echo "\r\n"; 
		echo "Line Number: 1205";
		echo "\r\n";
		$parsed_array = [search($out, 'LineNumber', '1205')];
		ob_start();
		var_dump($parsed_array[0][0]['LineDescription']);
		$LineDescription = ob_get_clean();
		$LineDescription = substr($LineDescription, 12, -2); 
		echo "Line Description: ",$LineDescription;
		echo "\r\n";
		ob_start();
		var_dump($parsed_array[0][0]['DeedAmount']);
		$DeedAmount = ob_get_clean();
		$DeedAmount = substr($DeedAmount, 11, -2); 
		echo "Deed Amount: ",$DeedAmount;
		echo "\r\n";
		ob_start();
		var_dump($parsed_array[0][0]['MortgageAmount']);
		$MortgageAmount = ob_get_clean();
		$MortgageAmount = substr($MortgageAmount, 11, -2); 
		echo "Mortgage Amount: ",$MortgageAmount;
		echo "\r\n";
		ob_start();
		var_dump($parsed_array[0][0]['ReleaseAmount']);
		$ReleaseAmount = ob_get_clean();
		$ReleaseAmount = substr($ReleaseAmount, 11, -2); 
		echo "Release Amount: ",$ReleaseAmount;
		echo "\r\n";
	}
?>