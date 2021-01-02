<?php
session_start();
include 'dbconfig.php';
if(isset($_POST['action']) && $_POST['action']=="login" && isset($_POST['email']) && isset($_POST['password']))
{
	$email=$_POST['email'];
$password=$_POST['password'];
$sql="SELECT * FROM users WHERE email='$email' AND password='$password'";
$res = mysqli_query($con,$sql);
				if(mysqli_num_rows($res)>0)
                  {
				 // $_SESSION['user_name']=$user_name;
				   $row=mysqli_fetch_assoc($res);
				   //$_SESSION['id']=$row['id'];
					$_SESSION['user_id']=$row['id'];
				    $_SESSION['user_role']=$row['user_role'];
					$_SESSION['user_name']=ucfirst($row['first_name'].' '.$row['last_name']);
				  
				  	//echo $_SESSION['user_id'];
					
						echo "<script>location.href='index.php';</script>";
						exit;	
                       
				  }
				  else
				  {
				  
				  // echo "<script type='text/javascript'>alert('Wrong Username And Password');</script>";
					echo "<h3>Wrong Username or Password</h3>";  
				  }
}

?>