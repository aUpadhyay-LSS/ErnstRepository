<?php


require('les_config.php');
$db = mysql_connect('localhost',$username,$password);
@mysql_select_db($database) or die( "Unable to select database ". mysql_error());

$county = mysql_real_escape_string($_POST['county']);
$state = mysql_real_escape_string($_POST['state']);
//$states = mysql_real_escape_string($states);
$query = mysql_query("SELECT DISTINCT CONCAT(UPPER(SUBSTRING(town,1,1)),LOWER(SUBSTRING(town FROM 2))) from zip_code  where county ='$county' and state ='$state' ORDER BY town ASC");

while($row = mysql_fetch_array($query)){
$town = $row["0"];
echo '<option value="'.$town.'">'.$town.'</option>';
}
?>