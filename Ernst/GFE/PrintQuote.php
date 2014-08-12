<?php

header('P3P: CP="CAO PSA OUR"');
session_start();
ob_flush();
?>
<html>
<head>
<style>
body { background: #efeee9; }
html, body { font-family: 'Lucida Grande',arial; font-size: 12px; }
p {text-indent: 50;}
</style>
</head>
<body>
<?php
echo $_SESSION['EmailBody'];
?>
<script>
window.print();    
</script>
</body>
</html>
