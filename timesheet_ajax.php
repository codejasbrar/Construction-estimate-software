<?php
include 'dbconfig.php';

if(isset($_POST["action"]) && $_POST["action"]=="insert_category")  
 { 
	
	$category=$_POST['category'];
	$user_id=$_POST['user_id'];
	$project_id=$_POST['project_id'];
	
	$qt_insert="INSERT INTO items(category,user_id,project_id)
	VALUES ('$category','$user_id','$project_id')";
 mysqli_query($con,$qt_insert);
	
	$sql='';
$sql="SELECT * FROM items WHERE id!='0' AND project_id='$project_id'
";

$sql.=" ORDER BY id DESC
";

$res=mysqli_query($con,$sql);
$rowcount=mysqli_num_rows($res);
?>	
	

<h1 align="center">Category table</h1>
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

<script>

	
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );

</script>
	
<?php	
}


if(isset($_POST["action"]) && $_POST["action"]=="insert_subcategory")  
 { 
	
	$category=$_POST['category'];
	$subcategory=$_POST['subcategory'];
	$user_id=$_POST['user_id'];
	$project_id=$_POST['project_id'];
	
	$qt_insert="INSERT INTO items_subcategory(category,subcategory,user_id,project_id)
	VALUES ('$category','$subcategory','$user_id','$project_id')";
 mysqli_query($con,$qt_insert);
	
	$sql='';
$sql="SELECT * FROM items_subcategory WHERE id!='0' AND project_id='$project_id'
";

$sql.=" ORDER BY id DESC
";

$res=mysqli_query($con,$sql);
$rowcount=mysqli_num_rows($res);
?>	
	

<h1 align="center">Subcategory table</h1>
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

<script>

	
$(document).ready(function() {
    $('#example1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );

</script>
	
<?php	
}




if(isset($_POST["action"]) && $_POST["action"]=="save")  
 { 
	$id=$_POST['id'];
	$details=$_POST['details'];
	$date=$_POST['date'];
	$start_time=$_POST['start_time'];
	$end_time=$_POST['end_time'];
	$hours=$_POST['hours'];
	$peoples=$_POST['peoples'];
	
		$qt_insert="UPDATE `timesheet` SET `details`='$details', `date`='$date',`start_time`='$start_time',`end_time`='$end_time',`hours`='$hours',`peoples`='$peoples' 
	WHERE id='$id'";
 mysqli_query($con,$qt_insert);
	
}


if(isset($_POST["action"]) && $_POST["action"]=="delete")  
 { 
	$id=$_POST['id'];
	
		$qt_insert="DELETE FROM `timesheet`
	WHERE id='$id'";
 mysqli_query($con,$qt_insert);
	
	
}
?>
