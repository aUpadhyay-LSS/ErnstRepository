<?php
require_once('C:/xampp/htdocs/Ernst/XMLGenerator.php');

  if(isset($_POST['state']))
   {
		$username=mysql_real_escape_string("jimboind_demo");
		$password=mysql_real_escape_string("Test123");
		$database=mysql_real_escape_string("lodestar");
		$db = mysql_connect('localhost',$username,$password);
		//echo $db;
		mysql_select_db($database) or die ( "Unable to select database: ". mysql_error());
		$ernst_state=mysql_real_escape_string($_POST['state']);
		$ernst_county=mysql_real_escape_string($_POST['county']);
		$ernst_township=mysql_real_escape_string($_POST['township']);
		//echo $ernst_state;
		if($ernst_state!='') 
		{
			$query_result=mysql_query("select PageREC from geography where state_abv='".$ernst_state."' and county='".$ernst_county."' and township='".$ernst_township."';") or die(mysql_error()); 
			
			if (mysql_num_rows($query_result)>0)
			{
				/* while($row = mysql_fetch_array($query_result)) {
				echo $row['PageREC'];
				} */
				$row = mysql_fetch_array($query_result);
				$PageREC = $row['PageREC'];
				GenerateXML($PageREC);
				//echo $PageREC;
			}
			else
			{
				echo "No PageREC value found";
			}
			mysql_close($db);
		} 
	else 
	   { 
			 echo "Please select state";
	   }
	 }
?>