<?php
header('P3P: CP="CAO PSA OUR"');
session_start();
ob_flush();
session_destroy();
?>
<html>
<head>
<link rel="stylesheet" href="Stylesheets/Res-Title_GFE.css" type="text/css" />
</head>
<body style="background: #efeee9; ">
<div class='middle'>
<br/><br/><br/>
<p STYLE= margin-left:15px;font-family:arial;color:grey;font-size:20px;">
     You have been successfully logged out </p>
<br/><br/><a href="GFE_main.php">Return to GFE</a>
    
</div>
</body>
</html>