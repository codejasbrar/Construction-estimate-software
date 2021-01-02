<?php
include 'dbconfig.php';	
session_start();
$current_url= basename($_SERVER['PHP_SELF']);

if (! isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] == 'off' ) {
     $redirect_url = "https://www." . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
   //header("Location: $redirect_url");
    //exit();
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">

<title>Job Expenses</title>

<meta name="description" content="Job Expenses">

<meta name="author" content="Job Expenses">

<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1">
	
<style>
	*{
		margin: 0;
    padding: 0;
    outline: none;
    box-sizing: border-box;
		font-family: "Segoe UI", sans-serif, "Segoe MDL2 Assets", "Symbols";
	}
	body{
		margin: 0;
		background-color:#F9F9F9;
		width: 100%;
		
		-webkit-font-smoothing: antialiased;
		height: auto !important;
    height: 100%;
    min-height: 100%;
    text-rendering: optimizeLegibility;
	}
	ul{
		padding: 0;
		margin: 0;
	}
	.header{
		float:left;
top:0;
position:fixed;
width:100%;
height:50px;

background: rgba(0,0,0,1);	
	
color:#FFFFFF;
z-index:100;
 box-shadow: 0px 6px 8px 0px rgba(0,0,0,0.2);
			
	}
	/*.header a{
		color: #ffffff;
	}*/
	
	
	.body_content{
		width: 100%;
		float: left;
		margin-top: 50px;
		
	}
	.footer{ 
		 
		width: 100%;
		height: 50px;
		background-color: black;
		color: white;
		bottom: 0px;
		margin-bottom: 0px;
		float: left;
		position: absolute;
		
	}
	
	
	
	
	
	nav {
float:right;
padding:8px 20px 0 0;
}
#menu-icon {
display:hidden;
width:40px;
height:40px;
background:url(images/nav.png) center;

/*background-color:#FFCC00;*/
}   
a:hover#menu-icon {
border-radius:4px 4px 0 0;
}
ul {
list-style-type:none;
}
nav ul li {
font-family:'Alegreya Sans', sans-serif;
font-size:100%;
display:inline-block;
float:left;
padding:3px;

}
nav ul li a {
color:#FFFFFF;
text-decoration:none;
}
nav ul li a:hover {
color:#C3D7DF;
}
.current {
color:#C3D7DF;
}

li a, .dropbtn {
    display: inline-block;
   /* color:#FFFFFF;*/
    text-align: center;
    padding: 4px 12px;
    text-decoration: none;
	/*z-index:20;*/
}

li a:hover, .dropdown:hover {
    /*background-color: white;*/
	/*z-index:200;
	/*color:#FFFFFF;*/
}

li.dropdown {
    display: inline-block;
	/*z-index:200;
	/*color:#FFFFFF;*/
}

.dropdown-content {
    display: none;
    position:fixed;
    background-color:#FFFFFF;
    min-width: 180px;
    box-shadow: 0px 6px 8px 0px rgba(0,0,0,0.2);
	z-index:300;
}

.dropdown-content a {
    color: black;
    padding: 10px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
	z-index:300;
}	

input{
		
		padding: 5px; 
		margin-left: 1%;
	border-style: solid;
	   border-width: 1px; 
	/*border-color: rgb(160,160,255); */
	border-color: rgba(0,0,255,0.25);
	/*border-color: #7A7A7A; */

	}
textarea{
		
		padding: 5px; 
		margin-left: 1%;
	border-style: solid;
	   border-width: 1px; 
	/*border-color: rgb(160,160,255); */
	border-color: rgba(0,0,255,0.25);
	/*border-color: #7A7A7A; */

	}	
	
	/*
	input[type='text']{
		border:1px solid #f7a937;
		border: 1px solid #7A7A7A !important;
		border-width: 1px; border-color: rgb(160,160,255);
	}
	*/
	select{
		 
		padding: 5px;
		margin-left: 1%;
	}	
	/*
	.select2{
		min-width: 200px;
		
	
		-webkit-appearance: menulist;
    box-sizing: border-box; 
    align-items: center;
    white-space: pre;
    -webkit-rtl-ordering: logical; 
    color: black;
    background-color: white;
    cursor: default;
    border-width: 0.5px;
    border-style: solid;
    border-color: transparent;
   
		
	border-radius: 0px;
  
		
	text-rendering: auto;
    color: initial;
    letter-spacing: normal;
    word-spacing: normal;
    text-transform: none;
    text-indent: 0px;
    text-shadow: none;
    display: inline-block;
    text-align: start;
   
    font: 400 13.3333px Arial;	
	
	}	
	/*
	.select2-container{
		margin: 2%;
	}
	
	.select2-container .select2-selection--single .select2-selection__rendered {
		display: inline-block;
		 border-color: transparent;
		height: 30px;
		margin: 2%;
	}
	
	.select2-container--default .select2-selection--single .select2-selection__rendered {
		height: 30px;
		 border-color: transparent;
		display: inline-block;
		margin: 2%;
	} */
	.select2{
		min-width: 200px;
		line-height: 15px !important;
		height: 30px !important;
	}
	.select2-container--default .select2-selection--single{
		background-color: #ffffff;
		border: 1px solid #7A7A7A !important;
		border-radius: 0px !important;
		
		margin-left: 1% !important;
		 font: 400 13.3333px Arial;
		line-height: 15px !important;
		height: 30px !important;
	}
	
input[type='button']{	

	
border: solid 0px #f7a937;
    background: white;
    background: #262637;
    font-size: 17px;
    font-weight: 600;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    color: #fff;
    padding: 7px 21px;
	
	
	display: inline-block;
   /* padding: 6px 12px; */
    /*margin-bottom: 0;*/
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143; 
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
	
}
		
input[type='submit']{	

border: solid 0px #f7a937;
    background: white;
    background: #262637;
    font-size: 17px;
    font-weight: 600;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    color: #fff;
    padding: 7px 21px;
	
	
	display: inline-block;
   /* padding: 6px 12px; */
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
	
}	
	
@media screen and (max-width:1000px) {
		   body{ background-color:#F9F9F9;
		   
		   }
	
	 nav {
float:right;
padding:8px 20px 0 0;
}
		    #menu-icon{
 display:inline-block;
 }
nav ul li a {
color:#000000;
text-decoration:none;
}
 nav ul, nav:active ul { 
 display:none;
 z-index:1000;
 position:absolute;
 padding:20px;
 background:#FFFFFF;
 right:20px;
 top:40px;
 box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
 border:1px solid #FFF;
 border-radius:10px 0 10px 10px;
 width:80%; 
 }
 nav:hover ul{
 display:block;
 }
 nav li{
 text-align:center;
 width:100%;
 padding:10px 0;
 }

	input{
		width: 95%;
		padding: 5px;
		margin: 2%;
	}
	textarea{
		width: 95%;
		padding: 5px;
		margin: 2%;
	}
	.centerdiv{
		text-align: -webkit-center;
	} 
 		
	
	/*
	input[type='text']{
		width: 100%;
		padding: 5px;
	}
	*/
	select{
		width: 95%;
		padding: 5px;
		margin: 2%;
	}
	/*
	.select2-container--default .select2-selection--single{
		
		width: 100% !important;
		padding: 5px !important;
		margin: 2% !important;
		
	}
	
	/*
	.select2-container .select2-container--default .select2-container--above{
		
		
	} */
	.select2{
		
		padding: 5px !important;
		line-height: 15px !important;
		width: 95% !important;
		
		height: 35px !important;
	} 
	table{
		margin: auto;
  border-collapse: collapse;
  overflow-x: auto;
  display: block;
  width: fit-content;
  max-width: 100%;
	}
	
}
</style>
<script>
function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
 } 	
</script>	
<script src="js/jquery-3.3.1.min.js"></script>	
	
<!--link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css"-->
<link rel="stylesheet" href="css/buttons.dataTables.min.css">	
	
<!--link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"-->
<link rel="stylesheet" href="css/jquery.dataTables.min.css">	
	
<!--script src="https://code.jquery.com/jquery-3.3.1.js"></script-->
<script src="js/jquery-3.3.1.js"></script>	
	
<!--script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script-->
<script src="js/jquery.dataTables.min.js"></script>	
	
<!--script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script-->
<script src="js/dataTables.buttons.min.js"></script>	
	
<!--script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script-->
<script src="js/buttons.flash.min.js"></script>	
	
<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script-->
<script src="js/jszip.min.js"></script>	
	
<!--script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script-->
<script src="js/pdfmake.min.js"></script>	
	
<!--script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script-->
<script src="js/vfs_fonts.js"></script>	
	
<!--script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script-->
<script src="js/buttons.html5.min.js"></script>	
	
<!--script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script-->
<script src="js/buttons.print.min.js"></script>	
	
<!--link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/-->
<link href="css/select2.min.css" rel="stylesheet"/>	
	
<!--script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script-->
<script src="js/select2.min.js"></script>
	
</head>
<body>

<div class="header">
	<h2 style="float: left; color: #ffffff; text-align: center;
    padding: 4px 12px;
    text-decoration: none;"><a href="index.php" style="color:#ffffff; text-align: center;
    padding: 4px 12px;
    text-decoration: none;">Job Expenses</a></h2>	
<nav>
	<a href="#" id="menu-icon"></a>
	<ul>
	<?php	
if(isset($_SESSION['user_id']))
{
?>
<li><a href="project.php" id="project" class="header_menu">Project</a></li>	
<?php
	if(isset($_SESSION['project_id']) && !empty($_SESSION['project_id']))
    {	
		$project_id=$_SESSION['project_id'];
	?>
	<input type="hidden" name="project_id" id="project_id" value="<?php echo $project_id;?>">
<li><a href="jobexpenses.php" id="jobexpenses" class="header_menu">New Entry Form</a></li>
<li><a href="settings.php" id="settings" class="header_menu">Settings</a></li>
<li><a href="timesheet.php" id="timesheet" class="header_menu">Timesheet</a></li>		
<li><a href="jobexpenses_report.php" id="jobexpenses_report" class="header_menu">Expenses Report</a></li>
<li><a href="items_report.php" id="items_report" class="header_menu">Items Report</a></li>		
<?php } ?>		
<li><a href="logout.php" id="logout" class="header_menu">Logout</a></li>		
<?php	
}
else
{
 //echo "<script>location.href='index.php';</script>";
 //exit;
	?>
	<li><a href="login.php" id="login" class="header_menu">login</a></li>
	<?php
}
?>	
</ul>		
</nav>
</div>	
<?php	
if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
{
	$user_id=$_SESSION['user_id'];
	?>
	<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>">
	<?php
}
else
{
	if($current_url!="login.php")
	{
		
	echo "<script>location.href='login.php';</script>";
 exit;
	}
}	
?>	
<br><br><br><br>