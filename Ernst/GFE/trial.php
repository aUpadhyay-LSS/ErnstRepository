<html>
<head>
<?php

require('db.php');

$con = mysql_connect('localhost',$username,$password);
@mysql_select_db($database) or die( "Unable to select database ". mysql_error());

?>
<script type="text/javascript">
    
    
</script>
</head>
<body>
<form>
    
<select onchange = "fetchcounties(this.value)">
    <option selected>Please select the state</option>
<?php
$result = mysql_query("Select distinct state from zip_code");
while($data = mysql_fetch_array($result,MYSQL_BOTH))
{
    //echo '<option value= "',$data['0'],'">',$data['0'],'</option>'
      echo "<option value=".$data['state'].">".$data['state']."</option>";
      
}
?>
</select>

</form>
</body>
</html>