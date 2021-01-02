<?php
//include 'dbconfig.php';	
//session_start();
include 'header.php';
?>
<?php
if(isset($_POST['action']) && $_POST['action']=="project_choose")
{
	$_SESSION['project_id']=$_POST['project_id'];
}
?>
<h1 align="center">Welcome to Job Expenses</h1>

<center style="padding:10px;">
<select id="project_select" class="project_select" name="project_select" style="min-width: 400px;">
<option value="">Select project</option>
<?php	
$sql="SELECT * FROM project WHERE id!='0'";
$sql.=" ORDER BY id DESC";
$res=mysqli_query($con,$sql);
$rowcount=mysqli_num_rows($res);
$i=0;
				
 while($row=mysqli_fetch_assoc($res))
  {
	$i=$i+1;			  	
?>
	<option value="<?php echo $row['id'];?>" <?php if(@$_SESSION['project_id']==$row['id']){ echo "selected";}?>><?php echo $row['project_name']?></option>
<?php
}
?>					
</select>
</center>	
<script>
$('.project_select').on('change', function(){
	var project_id=$('.project_select').val();
	
	var datastring = 'project_id=' + project_id + '&action=project_choose';
  
               $.ajax({  
				     url:"index.php",
                     method:"POST",  
                     data:datastring, 
                     success:function(data)  
                     {  
                       // alert(data);
						// window.location.reload(true);
						 location.href='jobexpenses.php';
					 }
					 }); 
})
</script>
<!--div class="body_content">

</div>

<script>
$(document).ready(function(){
	
$('.header_menu').on('click', function(){
	
	//var s_id=this.id;
	//($(this).attr('id'));
	//	alert($("#"+this.id).html());
	var m_id=$(this).attr('id');
	var url=m_id+".php";
	var email=$("#email").val();
	var password=$("#password").val();
	
	var datastring = 'action=login';
  
               $.ajax({  
                     //:"ajax/login_ajax.php",  
				     url:url,
                     method:"POST",  
                     data:datastring, 
                     success:function(data)  
                     {  
                       // alert(data);
						$(".leftsidebar").hide();
						 $(".rightsidebar").hide();
						 
						$(".body_content").html(""); 
						 $(".body_content").empty();  
						$(".body_content").html(data); 
					 }
					 }); 
})
	
});		
</script-->
<?php
//include 'footer.php';
?>