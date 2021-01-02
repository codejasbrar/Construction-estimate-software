<?php
include 'header.php';
//session_start();

?>
<link rel="stylesheet" href="./css/main.css">
<style>
	#login_div{
		
		width: 30%; padding: 2%; background-color: #ffffff; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);  border: 1px solid transparent;
    border-radius: 10px;    position: absolute;
    top: 50%;
    left: 50%;
    -moz-transform: translateX(-50%) translateY(-50%);
    -webkit-transform: translateX(-50%) translateY(-50%);
    transform: translateX(-50%) translateY(-50%);
	}	
	#myCanvas{
    background:black;

		height: 100%;
		width: 100%;
		margin: 0;
		top: 0;
		position: absolute;
}
	body{margin:0;height:100%;
	}
	
	

	
@media screen and (max-width:1000px) {	
  #login_div{
	width:90%;
	  padding: 3%;
	}
	
	#myCanvas{
   display: none;
}
	
	}
</style>
 <section class="fog">
    <div class="absolute-bg"></div>
    <div class="fog-container">
      <div class="fog-img fog-img-first"></div>
      <div class="fog-img fog-img-second"></div>
    </div>

   

<!--canvas id="myCanvas">
</canvas-->
<div id="login_div" align="center" style="z-index: 11;">
<h1>LogIn</h1><br>
<div id="login_div_message" style="width: 100%;">&nbsp;</div>

<input type="email" name="email" id="email" placeholder="Email" style="width: 100%;"><br><br>
<input type="password" name="password" id="password" placeholder="Password" style="width: 100%;"><br><br>
<input type="button" name="action" id="login_user" value="login" style="width: 100%;"><br><br>
	
</div>


<center><!--div style="height: 400px; margin-top: 10%;
	-webkit-filter: grayscale(30%); /* Safari 6.0 - 9.0 */
    filter: grayscale(30%);
	transform: translate3d(0px, 0px, 0px); background:url(images/smoke_left.png) no-repeat center;"><font style="color:crimson; font-size: 55px;"-->
	<div style="margin-top: 100px;
	-webkit-filter: grayscale(30%); /* Safari 6.0 - 9.0 */
    filter: grayscale(30%);
	transform: translate3d(0px, 0px, 0px);"><font style="color:crimson; font-size: 55px;">
	Job Expenses</font></div></center>
	
<!--	
color: transparent;
   text-shadow: 0 0 5px rgba(0,0,0,0.5);
	-->

 
  </section>	 

	
<script>
//$(document).ready(function(){
	
$('#login_div').on('keydown', '#password', function (e) {
    var key = e.which;
    if(key == 13) {
       // alert("enter");
        $('#login_user').click();
        return false;
    }
});
	
$('#login_user').on('click', function(){
	//alert("d");
	
	var email=$("#email").val();
	var password=$("#password").val();
	
	var datastring = 'email='+email+'&password='+password+'&action=login';
               $.ajax({  
				     url:"login_ajax.php",
                     method:"POST",  
                     data:datastring, 
                     success:function(data)  
                     {  
                        //alert(data);
						//$(".body_content").html(data); 
						 $("#login_div_message").html(data); 
					 }
					 }); 
})
	
// });		
</script>
