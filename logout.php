<?php
error_reporting(0);
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>logout</title>
</head>

<body>
<?php

//session_start();
unset($_SESSION['user_id']);
session_destroy();  
//header('Location: index.php');
	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
                       exit();	

?>
</body>
</html>
