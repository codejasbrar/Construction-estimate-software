<?php
include 'header.php';
?>

<?php
	$sql='';
$sql="SELECT * FROM project WHERE id!='0'

";

$sql.=" ORDER BY id DESC
";

$res=mysqli_query($con,$sql);
$rowcount=mysqli_num_rows($res);
?>	
<div class="response"><h2 class="total_balance"></h2>
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
				<th>Sr No.</th>
                <th>Project Name</th>
                <th>Description</th>
				<th>Address</th>
				<th>Post Code</th>
				<th>Job Price</th>
				<th>Balance</th>
                <th>Edit/Delete</th>
                
                
            </tr>
        </thead>
        <tbody>
		 <?php
				$i=0;
				$total_balance=0;
                while($row=mysqli_fetch_assoc($res))
				
                  {
					$i=$i+1;
					$bank_balance=0;
					$project_ids=$row['id'];
				$pass_sql = "SELECT current_balance FROM passbook WHERE project_id='$project_ids'";
	$pass=mysqli_query($con,$pass_sql);
	$passbook=mysqli_fetch_assoc($pass);
	$bank_balance=$passbook['current_balance'];	
			if($bank_balance=="")
					{
						$bank_balance=0;
					}	
				$total_balance=$total_balance + $bank_balance;	
				  ?>	
            <tr>
                <td><?php echo $i;?></td>
                <td>
				<input type="text" value="<?php echo $row['project_name'];?>" id="project_name<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="project_name form-control1">
							   
							   <font id="project_name_font<?php echo $row['id'];?>"><?php echo $row['project_name'];?></font>
				</td>
                <td>
				<input type="text" value="<?php echo $row['description'];?>" id="description<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="description form-control1">
							   
							   <font id="description_font<?php echo $row['id'];?>"><?php echo $row['description'];?></font>	
				</td>
				 <td>
				<input type="text" value="<?php echo $row['address'];?>" id="address<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="address form-control1">
							   
							   <font id="address_font<?php echo $row['id'];?>"><?php echo $row['address'];?></font>	
				</td>
				 <td>
				<input type="text" value="<?php echo $row['post_code'];?>" id="post_code<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="post_code form-control1">
							   
							   <font id="post_code_font<?php echo $row['id'];?>"><?php echo $row['post_code'];?></font>	
				</td>
				 <td>
				<input type="text" value="<?php echo $row['job_price'];?>" id="job_price<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="job_price form-control1">
							   
							   <font id="job_price_font<?php echo $row['id'];?>"><?php echo '&pound'.number_format($row['job_price']);?></font>	
				</td>
				<td><?php echo '&pound;'.number_format($bank_balance);?></td>
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
                <th>Project Name</th>
                <th>Description</th>
				<th>Address</th>
				<th>Post Code</th>
				<th>Job Price</th>
				<th>Balance</th>
                <th>Edit/Delete</th>
                
            </tr>
        </tfoot>
    </table>
	<script>
	$('.total_balance').html('Total Balance : &pound;<?php echo number_format($total_balance);?>');
	</script>
</div>	
	
<div>
<h2>Create new project</h2>	<br>
<input type="text" name="project_name" id="project_name" value="" placeholder="Project name" style="min-width: 200px;">
<input type="text" name="description" id="description" value="" placeholder="Project description" style="min-width: 400px;"><br><br>
<input type="text" name="address" id="address" value="" placeholder="Address" style="min-width: 400px;">
<input type="text" name="post_code" id="post_code" value="" placeholder="Post code" style="min-width: 200px;"><br><br>
&nbsp; Job price :<input type="text" name="job_price" id="job_price" value="0" placeholder="Job price">
&nbsp; Deposit :<input type="text" name="deposit" id="deposit" value="0" placeholder="Deposit">	
<input type="button" name="update" id="update" value="Create">	
<br><br>	
</div>	

<script>
$('#update').click(function(){
	
	var project_name=$("#project_name").val();
		var description=$("#description").val();
	var user_id=$("#user_id").val();
	var address=$("#address").val();
	var post_code=$("#post_code").val();
	var job_price=$("#job_price").val();
	var deposit=$("#deposit").val();
	
	if(project_name!="")	
		{
		$("#project_name").val("");
			$("#description").val("");	
			$("#address").val("");
			$("#post_code").val("");
			$("#job_price").val("");
			$("#deposit").val("");
		var datastring = 'project_name=' + project_name + '&description=' + description + '&user_id=' + user_id + '&address=' + address + '&post_code=' + post_code + '&job_price=' + job_price + '&deposit=' + deposit + '&action=insert';
		//alert(datastring);
	         $.ajax({  
                     url:"project_ajax.php",  
                     method:"POST",  
                     data:datastring,  
                     success:function(data)  
                     { 
						 //$('#example').prepend('<tr><td>1</td><td>sd</td><td>ffff</td><td>sd</td><td>xcx</td></tr>');
						 $('.response').html(data);
						 
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
} );


function show_edit(id)
	{
		//alert(id);
		$("#project_name"+id).show();
		$("#description"+id).show();
		$("#address"+id).show();
		$("#post_code"+id).show();
		$("#job_price"+id).show();
		
		
		
		$("#save"+id).show();
		
		$("#project_name_font"+id).hide();
		$("#description_font"+id).hide();
		$("#address_font"+id).hide();
		$("#post_code_font"+id).hide();
		$("#job_price_font"+id).hide();
		
		$("#edit"+id).hide();
		
	}
	
	
	function save_edit(id)
	{
		//alert(id);
		
		
		var project_name=$("#project_name"+id).val();
		var description=$("#description"+id).val();
		var address=$("#address"+id).val();
		var post_code=$("#post_code"+id).val();
		var job_price=$("#job_price"+id).val();
		
		var datastring = 'id=' + id + '&project_name=' + project_name + '&description=' + description + '&address=' + address + '&post_code=' + post_code + '&job_price=' + job_price + '&action=save';
		//alert(datastring);
	         $.ajax({  
                     url:"project_ajax.php",  
                     method:"POST",  
                     data:datastring,  
                     success:function(data)  
                     {  
                         //alert(data);
						 
		$("#project_name"+id).hide();
		$("#description"+id).hide();
		$("#address"+id).hide();
		$("#post_code"+id).hide();
		$("#job_price"+id).hide();
		
		$("#save"+id).hide();
						 
					 
		
		$("#project_name_font"+id).show();
		$("#description_font"+id).show();
		$("#address_font"+id).show();
		$("#post_code_font"+id).show();
		$("#job_price_font"+id).show();
		
		$("#project_name_font"+id).html(project_name);
		$("#description_font"+id).html(description);
		$("#address_font"+id).html(address);
		$("#post_code_font"+id).html(post_code);
		$("#job_price_font"+id).html(job_price);			 
						 
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
                     url:"project_ajax.php",  
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
	
	
</script>
</body>	
</html>