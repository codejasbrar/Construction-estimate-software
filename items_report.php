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
<div class="response"><h1 align="center">Category table</h1>
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
				<th>Sr No.</th>
                <th>Category</th>
                <!--th>Subcategory</th-->
                <th>Modified Date</th>
                
                
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
                <td>
				<?php echo  date("d-m-Y",strtotime($row['modified']));?>
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
               <th>Modified Date</th>
                
            </tr>
        </tfoot>
    </table>
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
<div class="response"><h1 align="center">Subcategory table</h1>
<table id="example1" class="display nowrap" style="width:100%">
        <thead>
            <tr>
				<th>Sr No.</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Modified Date</th>
                
                
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
                <td>
				<input type="text" value="<?php echo $row['subcategory'];?>" id="subcategory<?php echo $row['id'];?>" style="width:100%; margin:0; color:#000000; display: none;" class="subcategory form-control1">
							   
							   <font id="subcategory_font<?php echo $row['id'];?>"><?php echo $row['subcategory'];?></font>	
				</td>
                <td>
				<?php echo  date("d-m-Y",strtotime($row['modified']));?>
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
               <th>Modified Date</th>
                
            </tr>
        </tfoot>
    </table>
</div>


<script>
	
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



</script>
</body>	
</html>