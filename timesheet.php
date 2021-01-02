<?php
include 'header.php';
?>
<?php

if(isset($_POST["action"]) && $_POST["action"]=="insert")  
 { 
	
	$details=$_POST['details'];
	$date=$_POST['date'];
	$start_time=$_POST['start_time'];
	$end_time=$_POST['end_time'];
	$hours=$_POST['hours'];
	$peoples=$_POST['peoples'];
	
	
	
	if (!empty($_FILES['fileToUpload']['name'])) {
	
$photo=$_FILES['fileToUpload']['name'];
$test = explode('.', $_FILES["fileToUpload"]["name"]);
 $ext = end($test);
 //$name = rand(100, 999) . '.' . $ext;	
$timestamp = time(); 
		
$photo=$timestamp.'.'.$ext;//$name."-".$photo;
		
//////////////////////////////////////////////////////////////////////////////////////////////		
		// if(is_array($_FILES)) 
{
if(is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {
	
$sourcePath = $_FILES['fileToUpload']['tmp_name'];
$targetPath = "timesheet_photos/".$photo;	

 if(move_uploaded_file($sourcePath,$targetPath)) {
 }
}
}
/////////////////////////////////////////////////////////////////////////////////////////////		
		
}else{
		$photo="";	
	}
	
	
	
	
		
	$qt_insert="INSERT INTO timesheet(date,details,start_time,end_time,hours,peoples,photo,user_id,project_id)
	VALUES ('$date','$details','$start_time','$end_time','$hours','$peoples','$photo','$user_id','$project_id')";
    mysqli_query($con,$qt_insert);
	
}
?>

<?php
	$sql='';
$sql="SELECT * FROM timesheet WHERE id!='0' AND project_id='$project_id' 

";

$sql.=" ORDER BY id DESC
";

$res=mysqli_query($con,$sql);
$rowcount=mysqli_num_rows($res);
?>	
<div class="response_timesheet"><h1 align="center">Timesheet table</h1>
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
				<th>Sr No.</th>
                <th>Details</th>
				<th>Date</th>
				<th>Start Time</th>
				<th>End Time</th>
				<th>Hours</th>
				<th>Peoples</th>
                <th>Photo</th>
                <th>Edit/Delete</th>
                
                
            </tr>
        </thead>
        <tbody>
		 <?php
				$i=0;
				
                while($row=mysqli_fetch_assoc($res))
				
                  {
					$i=$i+1;
				  ?>	
            <tr>
                <td><?php echo $i;?></td>
                <td>
				<input type="text" value="<?php echo $row['details'];?>" id="details<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="details form-control1">
							   
							   <font id="details_font<?php echo $row['id'];?>"><?php echo $row['details'];?></font>
				</td>
				<td>
				<input type="date" value="<?php echo $row['date'];?>" id="date<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="date form-control1">
							   
							   <font id="date_font<?php echo $row['id'];?>"><?php echo $row['date'];?></font>
				</td>
				<td>
				<input type="time" value="<?php echo $row['start_time'];?>" id="start_time<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="start_time form-control1">
							   
							   <font id="start_time_font<?php echo $row['id'];?>"><?php echo $row['start_time'];?></font>
				</td>
				<td>
				<input type="time" value="<?php echo $row['end_time'];?>" id="end_time<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="end_time form-control1">
							   
							   <font id="end_time_font<?php echo $row['id'];?>"><?php echo $row['end_time'];?></font>
				</td>
				<td>
				<input type="text" value="<?php echo $row['hours'];?>" id="hours<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="hours form-control1">
							   
							   <font id="hours_font<?php echo $row['id'];?>"><?php echo $row['hours'];?></font>
				</td>
				<td>
				<input type="text" value="<?php echo $row['peoples'];?>" id="peoples<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="peoples form-control1">
							   
							   <font id="peoples_font<?php echo $row['id'];?>"><?php echo $row['peoples'];?></font>
				</td>
				<td>
				<?php if($row['photo']!=""){
					  echo '<br><span style="float: right;">
					  <a href="timesheet_photos/'.$row['photo'].'" target="_blank">
					  <img src="timesheet_photos/'.$row['photo'].'" style="max-width:50px;"></a></span>';
				  }
					?>
				</td>
                
                <td class="text-right"><a  href='#!' id="save<?php echo $row['id'];?>" onClick="save_edit(<?php echo $row['id'];?>);" style="display: none;" class='btn btn-simple btn-warning btn-icon edit' title='Click here to save this'>save</a>  
								<a  href='#!' id="edit<?php echo $row['id'];?>" onClick="show_edit(<?php echo $row['id'];?>);" class='btn btn-simple btn-warning btn-icon edit' title='Click here to edit this'>edit</a>
					  <a href='#!' class='btn btn-simple btn-danger btn-icon delete' onClick="delete_row(<?php echo $row['id'];?>);" title='Click here to delete this'>delete</a>
					  </td>
            </tr>
			<?php
				}
			?>
        </tbody>
        <tfoot>
            <tr>
                <th>Sr No.</th>
                <th>Details</th>
				<th>Date</th>
				<th>Start Time</th>
				<th>End Time</th>
				<th>Hours</th>
				<th>Peoples</th>
                <th>Photo</th>
                <th>Edit/Delete</th>
            </tr>
        </tfoot>
    </table>
</div>	

<form action="timesheet.php" name="timesheet_form" id="timesheet_form" method="post" enctype="multipart/form-data">	

<div style="width: 100%; float: left;">
<h2>Insert new timesheet</h2>	
<div style="float: left;">Date :</div><input type="date" id="date" value="<?php echo date("Y-m-d");?>" name="date" style="float: left;">
<div style="float: left;">Start time :</div><input type="time" id="start_time" value="<?php echo date("h:i:s");?>" name="start_time" style="float: left;">
<div style="float: left;">End time :</div>	
<input type="time" id="end_time" value="<?php echo date("h:i:s");?>" name="end_time" style="float: left;">	
<div style="float: left;">Hours :</div><input type="text" name="hours" id="hours" value="0" placeholder="Hours" style="float: left;">
<div style="float: left;">Peoples :</div><input type="text" name="peoples" id="peoples" value="0" placeholder="Peoples" style="float: left;"></div>	
<br><br>	
</div>	
<br>
<div style="width: 100%; float: left;">	<br>
<div style="float: left;">Details :</div>	
<input type="text" name="details" id="details" value="" placeholder="Details" style="min-width: 400px;">
	
<label for="fileToUpload">Upload photo</label>
<input type="file" name="fileToUpload" class="form-control" id="fileToUpload" style="opacity: 1; position: relative; height: auto;">	
<input type="hidden" name="photo" id="photo" />	
	
<input type="hidden" name="project_id" id="project_id" value="<?php echo $project_id;?>">
<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>">	
		
<input type="submit" name="update" id="update" value="Update">

<br><br><br><br>	
</div>	
<input type="hidden" name="action" id="action" value="insert">
	
</form>







<br><br><br><br>


<script>
	
$('#start_time,#end_time').on('change',function(){ 
							  
	var start_time=$('#start_time').val();
	var end_time=$('#end_time').val();
	
	
	var hours = ( new Date("1970-1-1 " + end_time) - new Date("1970-1-1 " + start_time) ) / 1000 / 60 / 60;
	hours=hours.toFixed(2);
	$('#hours').val(hours);
});	
	
$('#update_timesheet').click(function(){
	
	var details=$("#category").val();
		//var subcategory=$("#subcategory").val();
	var project_id = $('#project_id').val();
	var user_id=$('#user_id').val();
	
	if(category!="")	
		{
		var datastring = 'category=' + category + '&project_id=' + project_id + '&user_id=' + user_id + '&action=insert_category';
		//alert(datastring);
		$("#category").val("");
		 	
			
	         $.ajax({  
                     url:"settings_ajax.php",  
                     method:"POST",  
                     data:datastring,  
                     success:function(data)  
                     { 
						 //$('#example').prepend('<tr><td>1</td><td>sd</td><td>ffff</td><td>sd</td><td>xcx</td></tr>');
						 $('.response_category').html(data);
						 $("#category").val("");
						 //$("#subcategory").val("");
					 }
					 });
		}
	
});	
	
$('#update_subcategory').click(function(){
	
	var category=$("#category_select").val();
		var subcategory=$("#subcategory").val();
	var project_id = $('#project_id').val();
	var user_id=$('#user_id').val();
	
	if(category!="" && subcategory!="")	
		{
		var datastring = 'category=' + category + '&subcategory=' + subcategory + '&project_id=' + project_id + '&user_id=' + user_id + '&action=insert_subcategory';
		//alert(datastring);
		
		 $("#subcategory").val("");		
			
	         $.ajax({  
                     url:"settings_ajax.php",  
                     method:"POST",  
                     data:datastring,  
                     success:function(data)  
                     { 
						 //$('#example').prepend('<tr><td>1</td><td>sd</td><td>ffff</td><td>sd</td><td>xcx</td></tr>');
						 $('.response_subcategory').html(data);
						// $("#category_select").val("");
						 $("#subcategory").val("");
					 }
					 });
		}
	
});	
	
	
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
	
	
	 $('#example1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
	
	
} );


function show_edit(id)
	{
		//alert(id);
		
			$("#details"+id).show();
			$("#details_font"+id).hide();
		
		$("#date"+id).show();	
		$("#date_font"+id).hide();	
		
		$("#start_time"+id).show();	
		$("#start_time_font"+id).hide();	
		
		$("#end_time"+id).show();	
		$("#end_time_font"+id).hide();	
		
		$("#hours"+id).show();	
		$("#hours_font"+id).hide();	
		
		$("#peoples"+id).show();	
		$("#peoples_font"+id).hide();	
		
		$("#save"+id).show();
		
		$("#edit"+id).hide();
		
	}
	
	
	function save_edit(id)
	{
		//alert(id);
		var datastring="";
		
		
		var details=$("#details"+id).val();	
		var date=$("#date"+id).val();
		var start_time=$("#start_time"+id).val();
		var end_time=$("#end_time"+id).val();
		var hours=$("#hours"+id).val();
		var peoples=$("#peoples"+id).val();
		
		 datastring = 'id=' + id + '&details=' + details + '&date=' + date + '&start_time=' + start_time + '&end_time=' + end_time + '&hours=' + hours + '&peoples=' + peoples + '&action=save';	
		
		
		
		//alert(datastring);
	         $.ajax({  
                     url:"timesheet_ajax.php",  
                     method:"POST",  
                     data:datastring,  
                     success:function(data)  
                     {  
                         //alert(data);
		
						 
			
		$("#details"+id).hide();
		$("#details_font"+id).show();
				
		$("#date"+id).hide();
		$("#date_font"+id).show();
						 
		$("#start_time"+id).hide();
		$("#start_time_font"+id).show();
						 
		$("#end_time"+id).hide();
		$("#end_time_font"+id).show();
						 
						 
		$("#hours"+id).hide();
		$("#hours_font"+id).show();
						 
		$("#peoples"+id).hide();
		$("#peoples_font"+id).show();				 
		
		$("#details_font"+id).html(details);
		$("#date_font"+id).html(date);	
						 
		$("#start_time_font"+id).html(start_time);	
		$("#end_time_font"+id).html(end_time);					 
		$("#hours_font"+id).html(hours);		
		$("#peoples_font"+id).html(peoples);	
						 
		$("#save"+id).hide();
						 		 						 
		$("#edit"+id).show();
						 
								 
						 
					 }
					 });
		
		
	}
	
	var rd="";
	function delete_row(id)
	{
	
	if(confirm('Are you sure you want to delete?'))
	{
	
		
		var datastring = 'id=' + id + '&action=delete';
            
                $.ajax({  
                     url:"timesheet_ajax.php",  
                     method:"POST",  
                     data:datastring,  
                     success:function(data)  
                     {    
					 //alert(data);
					     
                     }  
                }); 
		
		rd="delete";
		
	}
	else
	{
	rd="del";
	return;
	}	
		
	 	
	}
	
	//remove a row
	$('body').delegate('.delete','click',function()  
	{  
	if(rd=="delete")
		{
		$(this).parent().parent().remove();	
		}
	}); 
	
//remove a row
	$('body').delegate('.remove','click',function()  
	{  
	
	$(this).parent().parent().remove();
	
	}); 		
	
	$('#category_select').select2();
	
</script>
</body>	
</html>