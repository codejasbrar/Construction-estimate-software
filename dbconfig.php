<?php
 
  
  
 	$host_name  = "localhost";
	
	$database="expenses";
	
	//$database="dash_expenses";
	
	 $user_name  = "root";
//$user_name="dash_expenses";

    $password   = "";
//$password="expenses@#456";

$con = new mysqli($host_name,$user_name,$password,$database) or die("Error " . mysqli_error($con));
global $con;
/*
function mysqli_real_escape_string_walker(&$item, $key) {
global $con;
if (!is_numeric($item)) {
$item = filter_var($item, FILTER_SANITIZE_STRING);
$item = $con->real_escape_string($item);
//$item = str_replace('<script>','',$item);
}
}
*/


?>