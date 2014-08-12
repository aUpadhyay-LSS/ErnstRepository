<?php


require('les_config.php');
$db = mysql_connect('localhost',$username,$password);
@mysql_select_db($database) or die( "Unable to select database ". mysql_error());

$states = mysql_real_escape_string($_POST['state']);

//$states = mysql_real_escape_string($states);
$query = mysql_query("SELECT DISTINCT CONCAT(UPPER(SUBSTRING(county,1,1)),LOWER(SUBSTRING(county FROM 2))) from zip_code  where state ='$states' ORDER BY county ASC");

while($row = mysql_fetch_array($query)){
$county = $row["0"];
echo '<option value="'.$county.'">'.$county.'</option>';
}

?>