<?php
include 'header.php';
?>

<?php
	$sql='';
$sql="SELECT * FROM items WHERE id!='0' AND project_id='$project_id' 

";

$sql.=" ORDER BY id DESC
";

$res=mysqli_query($con,$sql);
$rowcount=mysqli_num_rows($res);
?>	
<div class="response_category"><h1 align="center">Category table</h1>
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
				<th>Sr No.</th>
                <th>Category</th>
                <!--th>Subcategory</th-->
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
				<input type="text" value="<?php echo $row['category'];?>" id="category<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="category form-control1">
							   
							   <font id="category_font<?php echo $row['id'];?>"><?php echo $row['category'];?></font>
				</td>
                <!--td>
				<input type="text" value="<?php echo $row['subcategory'];?>" id="subcategory<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="subcategory form-control1">
							   
							   <font id="subcategory_font<?php echo $row['id'];?>"><?php echo $row['subcategory'];?></font>	
				</td-->
                <td class="text-right"><a  href='#!' id="save_category_<?php echo $row['id'];?>" onClick="save_edit('category',<?php echo $row['id'];?>);" style="display: none;" class='btn btn-simple btn-warning btn-icon edit' title='Click here to save this'>save</a>  
								<a  href='#!' id="edit_category_<?php echo $row['id'];?>" onClick="show_edit('category',<?php echo $row['id'];?>);" class='btn btn-simple btn-warning btn-icon edit' title='Click here to edit this'>edit</a>
					  <a href='#!' class='btn btn-simple btn-danger btn-icon delete' onClick="delete_row('category',<?php echo $row['id'];?>);" title='Click here to delete this'>delete</a>
					  </td>
            </tr>
			<?php
				}
			?>
        </tbody>
        <tfoot>
            <tr>
                <th>Sr No.</th>
                <th>Category</th>
                <!--th>Subcategory</th-->
                <th>Edit/Delete</th>
                
            </tr>
        </tfoot>
    </table>
</div>	
	
<div>
<h2>Insert new items</h2>	
<input type="text" name="category" id="category" value="" placeholder="Category">
<!--input type="text" name="subcategory" id="subcategory" value="" placeholder="Subcategory"-->
<input type="button" name="update_category" id="update_category" value="Update">	
<br><br>	
</div>	





<br><br><br><br>







<?php
	$sql='';
$sql="SELECT * FROM items_subcategory WHERE id!='0' AND project_id='$project_id' 

";

$sql.=" ORDER BY id DESC
";

$res=mysqli_query($con,$sql);
$rowcount=mysqli_num_rows($res);
?>	
<div class="response_subcategory"><h1 align="center">Subcategory table</h1>
<table id="example1" class="display nowrap" style="width:100%">
        <thead>
            <tr>
				<th>Sr No.</th>
                <th>Category</th>
                <th>Subcategory</th>
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
				<!--input type="text" value="<?php echo $row['category'];?>" id="category<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="category form-control1"-->
							   
					<select name="category_selects" id="category_selects<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;">
<!--option value="">Select category</option-->	
<?php
$cs_sql="SELECT * FROM items WHERE project_id='$project_id' ORDER BY id DESC";
$cs_res=mysqli_query($con,$cs_sql);
while($rowitems=mysqli_fetch_assoc($cs_res))
{
?>
<option value="<?php echo $rowitems['category'];?>" <?php if($rowitems['category']==$row['category']){ echo 'selected';}?>><?php echo $rowitems['category'];?></option>
<?php	
}
?>		
</select>
					
							   <font id="category1_font<?php echo $row['id'];?>"><?php echo $row['category'];?></font>
				</td>
                <td>
				<input type="text" value="<?php echo $row['subcategory'];?>" id="subcategory<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="subcategory form-control1">
							   
							   <font id="subcategory_font<?php echo $row['id'];?>"><?php echo $row['subcategory'];?></font>	
				</td>
                <td class="text-right"><a  href='#!' id="save_subcategory_<?php echo $row['id'];?>" onClick="save_edit('subcategory',<?php echo $row['id'];?>);" style="display: none;" class='btn btn-simple btn-warning btn-icon edit' title='Click here to save this'>save</a>  
								<a  href='#!' id="edit_subcategory_<?php echo $row['id'];?>" onClick="show_edit('subcategory',<?php echo $row['id'];?>);" class='btn btn-simple btn-warning btn-icon edit' title='Click here to edit this'>edit</a>
					  <a href='#!' class='btn btn-simple btn-danger btn-icon delete' onClick="delete_row('subcategory',<?php echo $row['id'];?>);" title='Click here to delete this'>delete</a>
					  </td>
            </tr>
			<?php
				}
			?>
        </tbody>
        <tfoot>
            <tr>
                <th>Sr No.</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Edit/Delete</th>
                
            </tr>
        </tfoot>
    </table>
</div>	
	
<div>
<h2>Insert new items</h2>	
<!--input type="text" name="category" id="category" value="" placeholder="Category"-->
<select name="category_select" id="category_select">
<option value="">Select category</option>	
<?php
$c_sql="SELECT * FROM items WHERE project_id='$project_id' ORDER BY id DESC";
$c_res=mysqli_query($con,$c_sql);
while($rowitem=mysqli_fetch_assoc($c_res))
{
?>
<option value="<?php echo $rowitem['category'];?>"><?php echo $rowitem['category'];?></option>
<?php	
}
?>		
</select>	
<input type="text" name="subcategory" id="subcategory" value="" placeholder="Subcategory">
<input type="button" name="update_subcategory" id="update_subcategory" value="Update">	
<br><br>	
</div>	




<br><br><br><br>


<script>
$('#update_category').click(function(){
	
	var category=$("#category").val();
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


function show_edit(type,id)
	{
		//alert(id);
		if(type=="category"){
			$("#category"+id).show();
			$("#category_font"+id).hide();
		}
		
		if(type=="subcategory"){
		$("#category_selects"+id).show();	
		$("#subcategory"+id).show();
			
		$("#category1_font"+id).hide();	
		$("#subcategory_font"+id).hide();	
		}
		
		$("#save_"+type+"_"+id).show();
		
		$("#edit_"+type+"_"+id).hide();
		
	}
	
	
	function save_edit(type,id)
	{
		//alert(id);
		var datastring="";
		
		if(type=="category"){
		var category=$("#category"+id).val();
		 datastring = 'id=' + id + '&category=' + category + '&type=' + type + '&action=save';	
		}
		
		if(type=="subcategory"){
		var category=$("#category_selects"+id).val();	
		var subcategory=$("#subcategory"+id).val();
		 datastring = 'id=' + id + '&category=' + category + '&subcategory=' + subcategory + '&type=' + type + '&action=save';	
		}
		
		
		//alert(datastring);
	         $.ajax({  
                     url:"settings_ajax.php",  
                     method:"POST",  
                     data:datastring,  
                     success:function(data)  
                     {  
                         //alert(data);
			if(type=="category"){			 
		$("#category"+id).hide();
		$("#category_font"+id).show();		
		$("#category_font"+id).html(category);		
			}
						 
			if(type=="subcategory"){	
		$("#category_selects"+id).hide();
		$("#category1_font"+id).show();
				
		$("#subcategory"+id).hide();
		$("#subcategory_font"+id).show();		
		
		$("#category1_font"+id).html(category);
		$("#subcategory_font"+id).html(subcategory);		
			}
		
		$("#save_"+type+"_"+id).hide();
						 		 						 
		$("#edit_"+type+"_"+id).show();
						 
								 
						 
					 }
					 });
		
		
	}
	
	var rd="";
	function delete_row(type,id)
	{
	
	if(confirm('Are you sure you want to delete?'))
	{
	
		
		var datastring = 'id=' + id + '&type=' + type + '&action=delete';
            
                $.ajax({  
                     url:"settings_ajax.php",  
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