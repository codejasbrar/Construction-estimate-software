<?php
include 'header.php';
?>	
<?php
	$sql='';
$sql="SELECT * FROM jobexpenses WHERE id!='0' AND project_id='$project_id'

";

$sql.=" ORDER BY id ASC
";

$res=mysqli_query($con,$sql);
$rowcount=mysqli_num_rows($res);
?>	
<div class="response">
<?php	
$pass_sql = "SELECT current_balance FROM passbook WHERE project_id='$project_id'";
	$pass=mysqli_query($con,$pass_sql);
	$passbook=mysqli_fetch_assoc($pass);
	$bank_balance=$passbook['current_balance'];	
	
?>	
<h1>Current Balance : &pound;<?php echo number_format($bank_balance);?></h1>	
	
<div>
	From:<input type="date" name="from" id="from" value="<?php echo date("Y-m-d");?>">
	To:<input type="date" name="to" id="to" value="<?php echo date("Y-m-d");?>">	
	Item category:<select id="item_category_search" name="item_category_search">
		<option value="">Select</option>	
<?php
$cs_sql="SELECT DISTINCT(category) FROM items WHERE project_id='$project_id' ORDER BY id DESC";
$cs_res=mysqli_query($con,$cs_sql);
while($rowitems=mysqli_fetch_assoc($cs_res))
{
?>
<option value="<?php echo $rowitems['category'];?>"><?php echo $rowitems['category'];?></option>
<?php	
}
?>	
</select>

Item subcategory:<select id="item_subcategory_search" name="item_subcategory_search">
		<option value="">Select</option>	
<?php
$cs_sql="SELECT DISTINCT(subcategory) FROM items_subcategory WHERE project_id='$project_id' ORDER BY id DESC";
$cs_res=mysqli_query($con,$cs_sql);
while($rowitems=mysqli_fetch_assoc($cs_res))
{
?>
<option value="<?php echo $rowitems['subcategory'];?>"><?php echo $rowitems['subcategory'];?></option>
<?php	
}
?>	
</select>	
	
<input type="button" name="search" id="search" value="Search">	
	<a href="jobexpenses_report.php"><input type="button" name="reset" id="reset" value="Reset"></a>		

	</div>	
	<br>
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
				<th style="background-color:orange;">Date</th>
                <th style="background-color: yellow;">Details</th>
                <th style="background-color:lawngreen;">In</th>
				<th style="background-color:darkorange;">Outstanding</th>
                <th style="background-color: red;">Paid</th>
                <th style="background-color:deepskyblue;">Balance</th>
                
            </tr>
        </thead>
        <tbody>
		 <?php
				$i=0;
				$total_spent=0;
	             $total_outstanding=0; 
                while($row=mysqli_fetch_assoc($res))
				
                  {
					$i=$i+1;
					$money_in='';
					$money_out='';
					$money_outstanding='';
					
 						if($row['transaction_type'] == 'cr')
						{
 							//echo $clients[$statement['source_id']];
						
							$money_in="&pound;".number_format($row['amount']);
							
 						}
 						else if($row['transaction_type'] == 'dr')
 						{
 							//echo $candidates[$statement['source_id']];
							
							$money_out="&pound;".number_format($row['amount']);
							$total_spent=$total_spent + $row['amount'];
 						}
					    else if($row['transaction_type'] == 'outstanding')
 						{
 							//echo $candidates[$statement['source_id']];
							
							$money_outstanding="&pound;".number_format($row['amount']);
							$total_outstanding=$total_outstanding + $row['amount'];
 						}
				  ?>	
            <tr>
                <td><?php echo  date("d-m-Y",strtotime($row['transaction_date']));?></td>
               <td><?php //echo $row['item_details'];?>
					<?php echo $row['category'].' '.$row['subcategory'];?>
				<?php if($row['description']!=""){
					  echo '<br><small>'.$row['description'].'</small>';
				  }
					?>
				<?php if($row['photo']!=""){
					  echo '<br><span style="float: right;">
					  <a href="job_photos/'.$row['photo'].'" target="_blank">
					  <img src="job_photos/'.$row['photo'].'" style="max-width:50px;"></a></span>';
				  }
					?>	
				</td>
				<td align="right"><?php echo $money_in;?></td>
				<td align="right"><?php echo $money_outstanding;?></td>
				<td align="right"><?php echo $money_out;?></td>
				<td align="right">&pound;<?php echo number_format($row['balance']);?></td>
            </tr>
			<?php
				}
			?>
        </tbody>
        <tfoot>
            <tr>
                <th style="background-color:orange;">Date</th>
                <th style="background-color: yellow;">Details</th>
                <th style="background-color:lawngreen;">In</th>
				<th style="background-color:darkorange;">Outstanding</th>
                <th style="background-color: red;">Paid</th>
                <th style="background-color:deepskyblue;">Balance</th>
                
            </tr>
        </tfoot>
    </table>
</div>	
<br><br><br>		
<script>
$(document).ready(function() {
 
    $('#example').DataTable( {
        dom: 'Bfrtip',
		//"paging":   false,
        "ordering": false,
       // "info":     false,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );

	
$('#search').click(function(){
	
   var from=$('#from').val();
	var to=$('#to').val();
	var item_category_search=$('#item_category_search').val();
	var item_subcategory_search=$('#item_subcategory_search').val();
	var project_id=$('#project_id').val();
	
	var datastring = 'from=' + from + '&to=' + to + '&item_category_search=' + item_category_search + '&item_subcategory_search=' + item_subcategory_search + '&project_id=' + project_id + '&action=search';
		
	$.ajax({  
                     url:"jobexpenses_ajax.php",  
                     method:"POST",  
                     data:datastring,  
                     success:function(data)  
                     { 
						 //$('#example').prepend('<tr><td>1</td><td>sd</td><td>ffff</td><td>sd</td><td>xcx</td></tr>');
						 $('.response').html(data);
						
					 }
					 });
	
});	
	
</script>

</body>	
</html>