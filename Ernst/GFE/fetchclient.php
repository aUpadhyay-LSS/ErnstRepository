<?php


require('db.php');
$db = mysql_connect('localhost',$username,$password);
@mysql_select_db($database) or die( "Unable to select database ". mysql_error());

$query = mysql_query("SELECT Client_id from client_configuration);

while($row = mysql_fetch_array($query)){
$client = $row["Client_id"];
echo '<option value="'.$client.'">'.$client.'</option>';
}

?>