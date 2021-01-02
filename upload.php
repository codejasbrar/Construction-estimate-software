<?php
session_start();
print_r($_FILES); //this will print out the received name, temp name, type, size, etc.


$size = $_FILES['audio_data']['size']; //the size in bytes
$input = $_FILES['audio_data']['tmp_name']; //temporary name that PHP gave to the uploaded file
$output = $_FILES['audio_data']['name'].".wav"; //letting the client control the filename is a rather bad idea
//echo "<script>alert('ds');</script>";
//move the file from temp name to local folder using $output name
//move_uploaded_file($input, $output)
	
if(is_uploaded_file($_FILES['audio_data']['tmp_name'])) {	
	
$sourcePath = $_FILES['audio_data']['tmp_name'];
$targetPath = "audio_files/".$_FILES['audio_data']['name'].".wav";
//$_SESSION['audio_files'][]=$_FILES['audio_data']['name'].".wav";
//print_r($_SESSION['audio_files']);	


	
 if(move_uploaded_file($sourcePath,$targetPath))
 {
	$_SESSION['audio_files'][]=$_FILES['audio_data']['name'].".wav";
 }
}
?>